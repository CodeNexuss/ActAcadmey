<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Section extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function items(){
        if (Auth::check()){
            return $this->hasMany(Content::class)->orderBy('sort_order', 'asc')->with('is_completed');
        }
        return $this->hasMany(Content::class)->orderBy('sort_order', 'asc');
    }

    public function getDripAttribute(){
        $data = [
            'is_lock' => false,
            'message' => null,
        ];

        $time = Carbon::now()->timestamp;

        if ($this->unlock_date && strtotime($this->unlock_date) > $time ){
            $unlock_date = Carbon::createFromTimeString($this->unlock_date)->format(get_option('date_format'));

            $data['is_lock'] = true;
            $data['message'] = ' The content will become available at '.$unlock_date;
        }

        /**
         * If Lock by Days
         */
        if ($this->unlock_days && $this->unlock_days > 0 ){
            if (Auth::check()){
                $user = Auth::user();

                $isEnrol = $user->isEnrolled($this->course_id);

                if ( $isEnrol ) {
                    // $unlock_date = Carbon::parse( $isEnrol->enrolled_at )->addDays( $this->unlock_days );
                    $unlock_date = date('Y-m-d', strtotime( date('Y-m-d', strtotime($isEnrol->enrolled_at))  . ' + '.$this->unlock_days.' days'));
                } else {
                    // $unlock_date = Carbon::now()->addDays( $this->unlock_days );
                    $unlock_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$this->unlock_days.' days'));
                }
                // $now = Carbon::now();
                $now = date('Y-m-d');

                $unlock_date = new \DateTime($unlock_date);
                $now = new \DateTime($now);
                $interval = $now->diff($unlock_date);
                $interval = (int) $interval->format("%r%a");

                if ( $interval > 0 ){
                    // $diffDays = $unlock_date->diffInDays($now);
                    $data['is_lock'] = true;
                    $data['message'] = "The content will become available in ".$interval." days";
                }
            }
        }

        return (object) $data;
    }

}
