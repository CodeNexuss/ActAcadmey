<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses(){
        return $this->belongsToMany(Course::class, 'enrolls');
    }

    public function do_enroll($cart_course){
        $carbon = Carbon::now()->toDateTimeString();
        $data = [
            'course_id'     => $cart_course['course_id'],
            'user_id'       => $this->user_id,
            'course_price'  => $cart_course['price'],
            'payment_id'    => $this->id,
            'status'        => $this->status,
            'enrolled_at'   => $carbon
        ];
        DB::table('enrolls')->insert($data);
        DB::table('courses')->where('id', $cart_course['course_id'])->update(['total_sales' => DB::raw('total_sales + 1')]);

        return $this;
    }

    public function distribute_earning(){
        $enable_instructors_earning = (bool) get_option('enable_instructors_earning');

        if ( $enable_instructors_earning) {
            $enrolls = DB::table('enrolls')->wherePaymentId($this->id)->get();

            if ($enrolls->count()) {
                foreach ($enrolls as $enroll) {
                    $course_price = $enroll->course_price;

                    $course = Course::find($enroll->course_id);

                    $admin_share = get_option('admin_share');
                    $instructor_share = get_option('instructor_share');

                    $admin_amount = ($course_price * $admin_share) / 100;
                    $instructor_amount = ($course_price * $instructor_share) / 100;

                    $data = [
                        'instructor_id' => $course->user_id,
                        'course_id' => $course->id,
                        'payment_id' => $this->id,
                        'payment_status' => $this->status,
                        'amount' => $enroll->course_price,
                        'instructor_amount' => $instructor_amount,
                        'admin_amount' => $admin_amount,
                        'instructor_share' => $instructor_share,
                        'admin_share' => $admin_share,
                    ];

                    Earning::create($data);
                }
            }
        }
        return $this;
    }

    /**
     * @param $data
     * @return mixed
     *
     * Create Payment, Share Earning and enroll to the course
     */
    public static function create_and_sync($data){
        $cart = cart();

        //If any fees, add it to Payment
        if ($cart->enable_charge_fees){
            $data['fees_name']   = $cart->fees_name;
            $data['fees_amount'] = $cart->fees_amount;
            $data['fees_type']   = $cart->fees_type;
            $data['fees_total']   = $cart->fees_total;
        }

        $payment = Payment::create($data);
        if (is_array($cart->courses) && count($cart->courses)) {
            foreach ($cart->courses as $course) {
                $payment->do_enroll($course)->distribute_earning();
            }
        }
        $payment->user->enroll_sync();

        return $payment;
    }

    /**
     * @param array $data
     * @return $this
     *
     * Update payment and update to enroll, related earnings.
     */

    public function save_and_sync($data = []){

        if (is_array($data) && count($data)){
            $this->update($data);
        }else{
            $this->save();
        }

        DB::table('earnings')->where('payment_id', $this->id)->update(['payment_status' => $this->status]);
        DB::table('enrolls')->where('payment_id', $this->id)->update(['status' => $this->status]);

        $this->user->enroll_sync();

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     *
     * Delete the Payment and delete all data related this payment
     */
    public function delete_and_sync(){
        DB::table('earnings')->where('payment_id', $this->id)->delete();
        DB::table('enrolls')->where('payment_id', $this->id)->delete();
        $this->delete();
        return $this;
    }

    public function getStatusContextAttribute(){
        $statusClass = "";
        $iclass = "";
        switch ($this->status){
            case 'initial':
                $statusClass .= "secondary";
                $iclass = "clock-o";
                break;
            case 'pending':
                $statusClass .= "dark";
                $iclass = "clock-o";
                break;
            case 'onhold':
                $statusClass .= "warning";
                $iclass = "hourglass";
                break;
            case 'success':
                $statusClass .= "success";
                $iclass = "check-circle";
                break;
            case 'failed':
            case 'declined':
            case 'dispute':
            case 'expired':
                $statusClass .= "danger";
                $iclass = "exclamation-circle";
                break;
        }

        $html = "<span class='badge p-2 px-3 payment-status-{$this->status} badge-{$statusClass}' style='font-size:16px'> <i style='font-size:16px;vertical-align: middle;' class='la la-{$iclass} mr-1'></i> {$this->status}</span>";
        return $html;
    }


}
