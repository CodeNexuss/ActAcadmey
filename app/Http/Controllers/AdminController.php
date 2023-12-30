<?php

namespace App\Http\Controllers;

use App\Course;
use App\Withdraw;
use App\HomepageSlider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     *
     * Landing page of dashboard
     */
    public function index(){
        $title = __a('dashboard');

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

        $sql = "SELECT SUM(total_amount) as total_amount,
              DATE(created_at) as date_format
              from payments
              WHERE status = 'success'
              AND (created_at BETWEEN '{$start_date}' AND '{$end_date}')
              GROUP BY date_format
              ORDER BY created_at ASC ;";
        $getEarnings = DB::select(DB::raw($sql));

        $total_amount = array_pluck($getEarnings, 'total_amount');
        $queried_date = array_pluck($getEarnings, 'date_format');

        $dateWiseSales = array_combine($queried_date, $total_amount);

        $chartData = array_merge($datesPeriod, $dateWiseSales);
        foreach ($chartData as $key => $salesCount){
            unset($chartData[$key]);

            $formatDate = date('d M', strtotime($key));
            //$formatDate = date('d', strtotime($key));
            $chartData[$formatDate] = $salesCount ? $salesCount : 0;
        }

        $extendCTRL = new ExtendController();
        $extended_products = (array) $extendCTRL->extended_products();
        $extended_plugins = array_get($extended_products, 'plugin');

        return view('admin.dashboard', compact('title', 'chartData', 'extended_plugins'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     * Show all courses to the admin.
     */
    public function adminCourses(Request $request){
        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();

        if ($request->bulk_action_btn){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
        }

        //Update
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)){
            $data = ['status' => $request->status];

            if ($request->status == 1){
                $data['published_at'] = $now;
            }

            if($request->status > 1) {
                foreach ($ids as $id){
                    $enrolled = \App\Enroll::where('course_id', $id)->first();
                    if($enrolled) {
                        return back()->with('error', 'Some courses already enrolled by the users. So unable to change the status.');
                    }
                }
            }

            Course::whereIn('id', $ids)->update($data);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'mark_as_popular' && is_array($ids) && count($ids)){
            Course::whereIn('id', $ids)->update(['is_popular' => 1, 'popular_added_at' => $now]);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'mark_as_feature' && is_array($ids) && count($ids)){
            Course::whereIn('id', $ids)->update(['is_featured' => 1, 'featured_at' => $now]);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'mark_as_top' && is_array($ids) && count($ids)){
            Course::whereIn('id', $ids)->update(['is_top' => 1]);
            return back()->with('success', __a('bulk_action_success'));
        }

        if ($request->bulk_action_btn === 'remove_from_popular' && is_array($ids) && count($ids)){
            Course::whereIn('id', $ids)->update(['is_popular' => null, 'popular_added_at' => null]);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'remove_from_feature' && is_array($ids) && count($ids)){
            Course::whereIn('id', $ids)->update(['is_featured' => null, 'featured_at' => null]);
            return back()->with('success', __a('bulk_action_success'));
        }
        if ($request->bulk_action_btn === 'remove_from_top' && is_array($ids) && count($ids)){
            Course::whereIn('id', $ids)->update(['is_top' => null]);
            return back()->with('success', __a('bulk_action_success'));
        }

        //Delete
        if ($request->bulk_action_btn === 'delete' && is_array($ids) && count($ids)){
            foreach ($ids as $id){
                $enrolled = \App\Enroll::where('course_id', $id)->first();
                if($enrolled) {
                    return back()->with('error', 'Deletion is aborted. Some courses already enrolled by the users.');
                }
            }
            foreach($ids as $id) {
                Course::find($id)->delete_and_sync();
            }
            return back()->with('success', __a('bulk_action_success'));
        }

        $title = __a('courses');
        $courses = Course::query()->where('status', '>', 0);
        if ($request->filter_status){
            $courses = $courses->whereStatus($request->filter_status);
        }
        if ($request->q){
            $courses = $courses->where('title', 'LIKE', "%{$request->q}%");
        }

        if ($request->filter_by === 'popular'){
            $courses = $courses->where('is_popular', 1);
            $courses = $courses->orderBy('popular_added_at', 'desc');
        }elseif($request->filter_by === 'featured'){
            $courses = $courses->where('is_featured', 1);
            $courses = $courses->orderBy('featured_at', 'desc');
        }else{
            $courses = $courses->orderBy('id', 'asc');
        }
        $courses = $courses->paginate(20);

        return view('admin.courses.courses', compact('title', 'courses'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     * Withdraw requests
     */
    public function withdrawsRequests(Request $request){
               
        $id_approved = $request->bulk_ids;

        if ($request->bulk_action_btn){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
        }

        if ($request->bulk_action_btn === 'update_status' && $request->update_status){
            
            $withdraw = Withdraw::whereIn('id', $id_approved)->where('status', 'approved')->first();
            if($withdraw) {
                return back()->with('error', 'Approved withdraws not allowed to delete or update');
            }
            /**
             * In the given array structure, the telebirr_phone value is nested within the form_fields array. To access it, you need to chain the array indexes accordingly.
             */
            $InstAccountNumber = Withdraw::whereIn('id', $id_approved)->first()->method_data;
            $telebirrPhone = $InstAccountNumber['form_fields']['telebirr_phone']['value'];

            $amount = Withdraw::whereIn('id', $id_approved)->first()->amount;

            //passing telebirrPhone and amount to withdrawAdminandChargeInstructure 
            $withdrawAdminandChargeInstructure = $this->sendHttpRequest($telebirrPhone, $amount);
            dd($withdrawAdminandChargeInstructure);

            Withdraw::whereIn('id', [$id_approved])->update(['status' => $request->update_status]);
            return back();
        }

        // if ($request->bulk_action_btn === 'update_status' && $request->update_status){
           
        //     $withdraw = Withdraw::whereIn('id', $request->bulk_ids)->where('status', 'approved')->first();
        //     if($withdraw) {
        //         return back()->with('error', 'Approved withdraws not allowed to delete or update');
        //     }

        //     Withdraw::whereIn('id', $request->bulk_ids)->update(['status' => $request->update_status]);
        //     return back();
        // }
        if ($request->bulk_action_btn === 'delete'){
            $withdraw = Withdraw::whereIn('id', $request->bulk_ids)->where('status', 'approved')->first();
            if($withdraw) {
                return back()->with('error', 'Approved withdraws not allowed to delete or update');
            }

            Withdraw::whereIn('id', $request->bulk_ids)->delete();
            return back();
        }


        $title = __a('withdraws');
        $withdraws = Withdraw::query();

        if ($request->status){
            if ($request->status !== 'all'){
                $withdraws = $withdraws->where('status', $request->status);
            }
        }else{
            $withdraws = $withdraws->where('status', 'pending');
        }

        $withdraws = $withdraws->orderBy('created_at', 'desc')->paginate(50);

        return view('admin.withdraws', compact('title', 'withdraws'));
    }

    private function sendHttpRequest($phoneNumber, $orderAmount) {
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://cps.huawei.com/cpsinterface/common" xmlns:api="http://cps.huawei.com/cpsinterface/api_requestmgr" xmlns:req="http://cps.huawei.com/cpsinterface/request">
                <soapenv:Header/>
                <soapenv:Body>
                    <api:Request>
                        <req:Header>
                            <req:Version>1.0</req:Version>
                            <req:CommandID>InitTrans_2003</req:CommandID>
                            <req:OriginatorConversationID>5634410eed0c42a6a85e76b1581fca51</req:OriginatorConversationID>
                            <req:Caller>
                            <req:CallerType>2</req:CallerType>
                            <req:ThirdPartyID>ACT</req:ThirdPartyID>
                            <req:Password>kKBWAInWDoW82SsoVqtwJS5NAnKidRtCAkpmJlpALdY=</req:Password>
                            <req:ResultURL>http://demo.actamericancollege.com/</req:ResultURL>
                            </req:Caller>
                            <req:KeyOwner>1</req:KeyOwner>
                            <req:Timestamp>20210914160116</req:Timestamp>
                        </req:Header>
                        <req:Body>
                            <req:Identity>
                            <req:Initiator>
                                <req:IdentifierType>12</req:IdentifierType>
                                <req:Identifier>22222201</req:Identifier>
                                <req:SecurityCredential>D2mTmkX6kqdMi4Llyxk412ipWdz63neglqcXHmxpDTE=</req:SecurityCredential>
                            <req:ShortCode>222222</req:ShortCode>
                            </req:Initiator>
                            <req:ReceiverParty>
                                <req:IdentifierType>1</req:IdentifierType>
                                <req:Identifier>'.$phoneNumber.'</req:Identifier>
                            </req:ReceiverParty>
                            </req:Identity>
                            <req:TransactionRequest>
                            <req:Parameters>
                                <req:Amount>'.$orderAmount.'</req:Amount>
                                <req:Currency>ETB</req:Currency>
                            </req:Parameters>
                            </req:TransactionRequest>
                            <req:ReferenceData>
                            <req:ReferenceItem>
                                <com:Key>Remarks</com:Key>
                                <com:Value>test1</com:Value>
                            </req:ReferenceItem>
                            </req:ReferenceData>
                        </req:Body>
                    </api:Request>
                </soapenv:Body>
                </soapenv:Envelope>';

        // $url = 'http://10.180.79.13:30001/payment/services/APIRequestMgrService';
        $url = 'http://196.188.120.3:10001/payment/services/APIRequestMgrService';
        // $url = 'http://196.188.120.3:11443/service-openup/toTradeWebPay';
        
        $headers = array(
            'Content-Type: text/xml',
            'Content-Length: ' . strlen($xml)
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function home_page_sliders(Request $request) {
        $data['title'] = __a('home_page_sliders');
        $data['sliders'] = HomepageSlider::orderBy('order', 'desc')->paginate(10);
        return view('admin.home_page_sliders', $data);
    }

    public function home_page_slider_edit($id=null) {
        $data['title'] = __a('home_page_sliders');
        $data['slider'] = '';
        $data['total_sliders'] = HomepageSlider::count();
        $order = HomepageSlider::orderBy('order', 'desc')->first();
        $data['last_order'] = ($order) ? ($order->order + 1) : 1;
        if($id) {
            $data['slider'] = HomepageSlider::findOrFail($id);
        }
        return view('admin.home_page_slider_update', $data);
    }

    public function home_page_slider_update(Request $request) {
        if(is_live_env()) return back()->with('error', __a('demo_restriction'));
        $rules = [
            'name' => 'required|max:50',
            'description' => 'required|max:250',
            'image' => 'required',
            'status' => 'required',
            'order' => 'numeric|unique:homepage_sliders,order,'.$request->id,
        ];

        $this->validate($request, $rules);
        $data = [
            'title' => clean_html($request->name),
            'description' => clean_html($request->description),
            'image' => $request->image,
            'status' => $request->status,
            'url' => $request->url,
            'order' => $request->order
        ];
        if($request->id > 0) {
            HomepageSlider::where('id', $request->id)->update($data);
            $msg = __a('slider_updated');
        } else {
            HomepageSlider::create($data);
            $msg = __a('slider_created');
        }
        return redirect(route('home_page_sliders'))->with('success', $msg);
        
    }

    public function home_page_slider_delete(Request $request) {
        if(is_live_env()) return ['success' => false, 'message' => __a('demo_restriction')];

        if (count($request->slider_ids)){
            HomepageSlider::whereIn('id', $request->slider_ids)->delete();
            return ['success' => true, 'message' => __a('slider_deleted')];
        }
        return ['success' => false, 'message' => __a('action_failed')];
    }

}
