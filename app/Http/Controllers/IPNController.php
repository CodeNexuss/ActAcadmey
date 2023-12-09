<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class IPNController extends Controller
{

    /**
     * @param Request $request
     * @param $transaction_id
     *
     * Payment IPN
     */
    public function paypalNotify(Request $request, $transaction_id){
        $payment = Payment::whereLocalTransactionId($transaction_id)->where('status','!=','success')->first();

        $verified = $this->paypal_ipn_verify();
        if ($verified){
            //Payment success, we are ready approve your payment
            $payment->status = 'success';
            $payment->charge_id_or_token = $request->txn_id;
            $payment->description = $request->item_name;
            $payment->payer_email = $request->payer_email;
            $payment->payment_created = strtotime($request->payment_date);
            $payment->save_and_sync();
        }else{
            $payment->status = 'declined';
            $payment->description = trans('app.payment_declined_msg');
            $payment->save_and_sync();
        }
        // Reply with an empty 200 response to indicate to paypal the IPN was received correctly
        header("HTTP/1.1 200 OK");
    }

    public function paypal_ipn_verify(){
        $paypal_action_url = "https://www.paypal.com/cgi-bin/webscr";
        if (get_option('enable_paypal_sandbox'))
            $paypal_action_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";

        // STEP 1: read POST data
        // Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
        // Instead, read raw POST data from the input stream.
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }

        // STEP 2: POST IPN data back to PayPal to validate
        $ch = curl_init($paypal_action_url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        if( !($res = curl_exec($ch)) ) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);

        // STEP 3: Inspect IPN validation result and act accordingly
        if (strcmp ($res, "VERIFIED") == 0) {
            return true;
        } else if (strcmp ($res, "INVALID") == 0) {
            return false;
        }
    }


}
