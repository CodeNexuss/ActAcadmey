<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(Request $request){
        $ids = $request->bulk_ids;

        //Update
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            $payment = Payment::whereIn('id', $ids)->where('status', 'success')->first();
            if($payment) {
                return back()->with('error', 'Success payments not allowed to delete or update');
            }
            foreach ($ids as $id){
                Payment::find($id)->save_and_sync(['status' => $request->status]);
            }

            return back()->with('success', __a('bulk_action_success'));
        }
        //Delete
        if ($request->bulk_action_btn === 'delete' && is_array($ids) && count($ids)){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            $payment = Payment::whereIn('id', $ids)->where('status', 'success')->first();
            if($payment) {
                return back()->with('error', 'Success payments not allowed to delete or update');
            }

            foreach ($ids as $id){
                Payment::find($id)->delete_and_sync();
            }
            return back()->with('success', __a('bulk_action_success'));
        }
        //END Bulk Actions

        $title = __a('payments');

        $payments = Payment::query();
        if ($request->q){
            $payments = $payments->where(function($q)use($request) {
                $q->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            });
        }
        if ($request->filter_status){
            $payments = $payments->where('status', $request->filter_status);
        }
        $payments = $payments->orderBy('id', 'desc')->paginate(20);

        return view('admin.payments.payments', compact('title', 'payments'));
    }

    public function view($id){
        $title = __a('payment_details');
        $payment = Payment::find($id);
        return view('admin.payments.payment_view', compact('title', 'payment'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * Delete the Payment
     */
    public function delete($id){
        if(is_live_env()) return back()->with('error', __a('demo_restriction'));

        $payment = Payment::find($id);
        if ($payment){
            $payment->delete_and_sync();
        }
        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * Update the payment status, and it's related data
     */

    public function updateStatus(Request $request, $id){
        $payment = Payment::find($id);
        if ($payment){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
            $payment->status = $request->status;
            $payment->save_and_sync();
        }

        return back()->with('success', __a('success'));
    }

    public function PaymentGateways(){
        $title = __a('payment_gateways');
        return view('admin.payments.gateways.payment_gateways', compact('title'));
    }

    public function PaymentSettings(){
        $title = __a('payment_settings');
        return view('admin.payments.gateways.payment_settings', compact('title'));
    }

    public function thankYou( $transaction_id = null ){
        $title = __t('payment_thank_you');

        do_action('payment_thankyou', $transaction_id);

        return view(theme('payment-thank-you'), compact('title'));
    }

}

