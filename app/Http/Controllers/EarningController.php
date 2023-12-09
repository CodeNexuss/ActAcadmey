<?php

namespace App\Http\Controllers;

use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EarningController extends Controller
{

    /**
     * Earning
     */
    public function earning(){
        $title = __t('earnings');
        $user = Auth::user();

        /**
         * Format Date Name
         */
        $start_date = date("Y-m-01");
        $end_date = date("Y-m-t");

        $begin = new \DateTime($start_date);
        $end = new \DateTime($end_date.' + 1 day');
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        $datesPeriod = array();
        foreach ($period as $dt) {
            $datesPeriod[$dt->format("Y-m-d")] = 0;
        }

        /**
         * Query This Month
         */

        $sql = "SELECT SUM(instructor_amount) as total_earning,
              DATE(created_at) as date_format
              from earnings
              WHERE instructor_id = {$user->id} AND payment_status = 'success'
              AND (created_at BETWEEN '{$start_date}' AND '{$end_date}')
              GROUP BY date_format
              ORDER BY created_at ASC ;";
        $getEarnings = DB::select(DB::raw($sql));

        $total_earning = array_pluck($getEarnings, 'total_earning');
        $queried_date = array_pluck($getEarnings, 'date_format');


        $dateWiseSales = array_combine($queried_date, $total_earning);

        $chartData = array_merge($datesPeriod, $dateWiseSales);
        foreach ($chartData as $key => $salesCount){
            unset($chartData[$key]);
            //$formatDate = date('d M', strtotime($key));
            $formatDate = date('d', strtotime($key));
            $chartData[$formatDate] = $salesCount;
        }

        return view(theme('dashboard.earning.index'), compact('user', 'title', 'chartData'));
    }


    public function earningReport(Request $request){
        $title = __t('report_statements');
        $page_title = $title;
        $time_period = $request->time_period;

        $user = Auth::user();
        $statements = $user->earnings();

        if ( ! $time_period || $time_period === 'this_month'){

            $start_date = date("Y-m-01");
            $end_date = date("Y-m-t");

        }elseif ($time_period === 'last_month'){

            $start_date = date('Y-m-01 00:00:00', strtotime('last day of last month'));
            $end_date = date("Y-m-t 23:59:59", strtotime($start_date));

        } elseif( $time_period === 'last_week'){

            $previous_week = strtotime("-1 week +1 day");
            $start_date = strtotime("last sunday midnight",$previous_week);
            $end_date = strtotime("next saturday",$start_date);
            $start_date = date("Y-m-d 00:00:00",$start_date);
            $end_date = date("Y-m-d 23:59:59",$end_date);

        }elseif( $time_period === 'this_week') {

            $start_date = date("Y-m-d 00:00:00", strtotime("last sunday midnight"));
            $end_date = date("Y-m-d 23:59:59", strtotime("next saturday"));

        }elseif ($time_period === 'this_year'){
            $year = date('Y');
        }elseif ($time_period === 'last_year'){
            $year = date('Y', strtotime('-1 year'));
        }elseif ($time_period === 'date_range'){

            $start_date = $request->date_from." 00:00:00";
            $end_date = $request->date_to." 23:59:59";

        }

        /**
         * Query Results
         */
        if ($time_period === 'this_year' || $time_period === 'last_year'){

            $page_title = __t('showing_report_year_text')." <strong>$year</strong> ";

            $sql = "SELECT SUM(instructor_amount) as total_earning, SUM(amount) as total_amount, SUM(admin_amount) as commission,
              MONTHNAME(created_at)  as month_name
              from earnings
              WHERE instructor_id = {$user->id} AND payment_status = 'success'
              AND YEAR(created_at) = {$year}
              GROUP BY MONTH (created_at)
              ORDER BY MONTH(created_at) ASC ;";

            $getEarnings = DB::select(DB::raw($sql));

            $total_earning_arr = array_pluck($getEarnings, 'total_earning');
            $months = array_pluck($getEarnings, 'month_name');
            $monthWiseSales = array_combine($months, $total_earning_arr);

            $total_amount = array_sum(array_pluck($getEarnings, 'total_amount'));
            $total_earning = array_sum($total_earning_arr);
            $commission = array_sum(array_pluck($getEarnings, 'commission'));

            /**
             * Format yearly
             */
            $emptyMonths = array();
            for ($m=1; $m<=12; $m++) {
                $emptyMonths[date('F', mktime(0,0,0,$m, 1, date('Y')))] = 0;
            }
            $chartData = array_merge($emptyMonths, $monthWiseSales);

            $statements = $statements->whereYear('created_at', $year);

        }else{

            $startDateFormat = date(get_option('date_format'), strtotime($start_date));
            $endDateFormat = date(get_option('date_format'), strtotime($end_date));

            $page_title = __t('showing_report_text')." <strong>{$startDateFormat}</strong> - <strong>{$endDateFormat}</strong> ";

            $begin = new \DateTime($start_date);

            if ($time_period === 'date_range'){
                $end = new \DateTime($end_date);
            }else{
                $end = new \DateTime($end_date.' + 1 day');
            }

            $interval = \DateInterval::createFromDateString('1 day');
            $period = new \DatePeriod($begin, $interval, $end);

            $datesPeriod = array();
            foreach ($period as $dt) {
                $datesPeriod[$dt->format("Y-m-d")] = 0;
            }

            $sql = "SELECT SUM(instructor_amount) as total_earning, SUM(amount) as total_amount, SUM(admin_amount) as commission,
              DATE(created_at) as date_format
              from earnings
              WHERE instructor_id = {$user->id} AND payment_status = 'success'
              AND (created_at BETWEEN '{$start_date}' AND '{$end_date}')
              GROUP BY date_format
              ORDER BY created_at ASC ;";
            $getEarnings = DB::select(DB::raw($sql));


            $total_earning_arr = array_pluck($getEarnings, 'total_earning');
            $queried_date = array_pluck($getEarnings, 'date_format');

            $total_amount = array_sum(array_pluck($getEarnings, 'total_amount'));
            $total_earning = array_sum($total_earning_arr);
            $commission = array_sum(array_pluck($getEarnings, 'commission'));

            $dateWiseSales = array_combine($queried_date, $total_earning_arr);

            $chartData = array_merge($datesPeriod, $dateWiseSales);
            foreach ($chartData as $key => $salesCount){
                unset($chartData[$key]);
                //$formatDate = date('d M', strtotime($key));
                $formatDate = date('d', strtotime($key));
                $chartData[$formatDate] = $salesCount;
            }

            $statements = $statements->whereBetween('created_at', [$start_date, $end_date]);
        }

        $statements = $statements->with('course', 'payment', 'payment.user', 'payment.user.country')->paginate(20);

        return view(theme('dashboard.earning.report'), compact('user', 'title', 'page_title', 'total_amount', 'total_earning', 'commission', 'chartData', 'statements'));
    }


    /**
     * Withdraw Balance from the instructor
     *
     */
    public function withdraw(){
        $title = __t('withdraw');
        $user = Auth::user();
        return view(theme('dashboard.earning.withdraw'), compact('title', 'user'));
    }
    public function withdrawPost(Request $request){
        $rules = [
            'amount' => 'required|numeric',
        ];
        $this->validate($request, $rules);

        $user = Auth::user();

        if ($request->amount > $user->earning->balance){
            return back()->withInput($request->input())->with('error', __t('no_balance_msg'));
        }

        $data = [
            'user_id' => $user->id,
            'amount' => $request->amount,
            'method_data' => json_encode($user->withdraw_method),
            'description' => $request->description,
            'status' => 'pending',
        ];

        $min_amount = array_get($user->withdraw_method->admin_form_fields, 'min_withdraw_amount');
        if ($min_amount > $request->amount){
            return back()->withInput($request->input())->with('error', __t('min_amount_msg'));
        }

        Withdraw::create($data);

        return back()->with('success', __t('withdraw_success_msg'));

    }

    public function withdrawPreference(){
        $title = __t('withdraw_preference');
        $user = Auth::user();
        return view(theme('dashboard.earning.withdraw_preference'), compact('title', 'user'));
    }

    public function withdrawPreferencePost(Request $request){
        $user = Auth::user();
        $user->update_option('withdraw_preference', $request->withdraw_preference);
        return back()->with('success', __t('withdraw_preference_saved'));
    }


}
