<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Stripe\Stripe;

class GatewayController extends Controller
{

    /**
     * @param Request $request
     * @return array
     * @throws \Stripe\Exception\ApiErrorException
     *
     * Stripe Charge
     */
    public function stripeCharge(Request $request){
        $stripeToken = $request->stripeToken;
        Stripe::setApiKey(get_stripe_key('secret'));

        // Create the charge on Stripe's servers - this will charge the user's card
        try {
            $cart = cart();
            $amount = $cart->total_amount;
            $user = Auth::user();

            $currency = get_option('currency_sign');

            //Charge from card
            $charge = Charge::create(array(
                "amount"        => get_stripe_amount($amount), // amount in cents, again
                "currency"      => $currency,
                "source"        => $stripeToken,
                "description"   => get_option('site_name')."'s course enrolment"
            ));

            if ($charge->status == 'succeeded'){
                //Save payment into database
                $data = [
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'user_id'           => $user->id,
                    'amount'            => $cart->total_price,
                    'payment_method'        => 'stripe',
                    'total_amount'      => get_stripe_amount($charge->amount, 'to_dollar'),

                    'currency'              => $currency,
                    'charge_id_or_token'    => $charge->id,
                    'description'           => $charge->description,
                    'payment_created'       => $charge->created,

                    //Card Info
                    'card_last4'        => $charge->source->last4,
                    'card_id'           => $charge->source->id,
                    'card_brand'        => $charge->source->brand,
                    'card_country'      => $charge->source->US,
                    'card_exp_month'    => $charge->source->exp_month,
                    'card_exp_year'     => $charge->source->exp_year,

                    'status'                    => 'success',
                ];

                Payment::create_and_sync($data);
                $request->session()->forget('cart');

                return ['success'=> 1, 'message_html' => $this->payment_success_html()];
            }
        } catch(CardException $e) {
            // The card has been declined
            return ['success'=>0, 'msg'=> __t('payment_declined_msg'), 'response' => $e];
        }
    }

    public function payment_success_html(){
        $html = ' <div class="payment-received text-center">
                            <h1> <i class="fa fa-check-circle-o"></i> '.__t('payment_thank_you').'</h1>
                            <p>'.__t('payment_receive_successfully').'</p>
                            <a href="'.route('home').'" class="btn btn-dark">'.__t('home').'</a>
                        </div>';
        return $html;
    }



    public function bankPost(Request $request){
        $cart = cart();
        $amount = $cart->total_amount;

        $user = Auth::user();
        $currency = get_option('currency_sign');

        //Create payment in database
        $transaction_id = 'tran_'.time().str_random(6);
        // get unique recharge transaction id
        while( ( Payment::whereLocalTransactionId($transaction_id)->count() ) > 0) {
            $transaction_id = 'reid'.time().str_random(5);
        }
        $transaction_id = strtoupper($transaction_id);

        $payments_data = [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'user_id'               => $user->id,
            'amount'                => $amount,
            'payment_method'        => 'bank_transfer',
            'status'                => 'pending',
            'currency'              => $currency,
            'local_transaction_id'  => $transaction_id,

            'bank_swift_code'       => clean_html($request->bank_swift_code),
            'account_number'        => clean_html($request->account_number),
            'branch_name'           => clean_html($request->branch_name),
            'branch_address'        => clean_html($request->branch_address),
            'account_name'          => clean_html($request->account_name),
            'iban'                  => clean_html($request->iban),
        ];
        //Create payment and clear it from session
        Payment::create_and_sync($payments_data);

        $request->session()->forget('cart');

        return redirect(route('payment_thank_you_page'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Redirect to PayPal for the Payment
     */
    public function paypalRedirect(Request $request){
        if ( ! session('cart')){
            return redirect(route('checkout'));
        }

        $cart = cart();
        $amount = $cart->total_amount;

        $user = Auth::user();
        $currency = get_option('currency_sign');

        //Create payment in database
        $transaction_id = 'tran_'.time().str_random(6);
        // get unique recharge transaction id
        while( ( Payment::whereLocalTransactionId($transaction_id)->count() ) > 0) {
            $transaction_id = 'reid'.time().str_random(5);
        }
        $transaction_id = strtoupper($transaction_id);

        $payments_data = [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'user_id'               => $user->id,
            'amount'                => $amount,
            'payment_method'        => 'paypal',
            'status'                => 'initial',
            'currency'              => $currency,
            'local_transaction_id'  => $transaction_id,
        ];
        //Create payment and clear it from session
        $payment = Payment::create_and_sync($payments_data);
        $request->session()->forget('cart');

        // PayPal settings
        $paypal_action_url = "https://www.paypal.com/cgi-bin/webscr";
        if (get_option('enable_paypal_sandbox'))
            $paypal_action_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";

        $paypal_email = get_option('paypal_receiver_email');
        $return_url = route('payment_thank_you_page', $transaction_id);
        $cancel_url = route('checkout');
        $notify_url = route('paypal_notify', $transaction_id);

        $item_name = get_option('site_name')."'s course enrolment";

        $querystring = '';
        // Firstly Append paypal account to querystring
        $querystring .= "?cmd=_xclick&business=".urlencode($paypal_email)."&";
        $querystring .= "item_name=".urlencode($item_name)."&";
        $querystring .= "amount=".urlencode($amount)."&";
        $querystring .= "currency_code=".urlencode($currency)."&";
        $querystring .= "item_number=".urlencode($payment->local_transaction_id)."&";
        // Append paypal return addresses
        $querystring .= "return=".urlencode(stripslashes($return_url))."&";
        $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
        $querystring .= "notify_url=".urlencode($notify_url);

        // Redirect to paypal IPN
        $URL = $paypal_action_url.$querystring;
        return redirect($URL);
    }

     /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Redirect to telebirr for the Payment
     */
    public function telebirrRedirect(Request $request){
        if ( ! session('cart')){
            return redirect(route('checkout'));
        }

        $cart = cart();
        $amount = $cart->total_amount;

        $user = Auth::user();
        $currency = get_option('currency_sign');
       
        //Create payment in database
        $transaction_id = 'tran_'.time().str_random(6);
        
        // get unique recharge transaction id
        while( ( Payment::whereLocalTransactionId($transaction_id)->count() ) > 0) {
            $transaction_id = 'reid'.time().str_random(5);
        }
        $transaction_id = strtoupper($transaction_id);
        $payments_data = [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'user_id'               => $user->id,
            'amount'                => $amount,
            'payment_method'        => 'telebirr',
            'status'                => 'initial', // pending | success | failed
            // 'currency'              => $currency,
            'currency'              => "ETB",
            'local_transaction_id'  => $transaction_id,
        ];
        
        //Create payment and clear it from session
        $payment = Payment::create_and_sync($payments_data);
        $request->session()->forget('cart');

        // Telebirr settings
        // header('Content-Type: application/json; charset=utf-8');
        $api = 'http://196.188.120.3:11443/service-openup/toTradeWebPay';
        $appkey = 'fa945fad72e640edaaf816ddcd9e2866';
        $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmLAHu17fUEshx7xva1vPYLrJdU5GX9hSIEyMlap9QcChwDLDPVpD0RYTwHA7pvXE0HXmfVjfTEEogONpH9M+JWrvOePoUCUrplmonmovwgGbaiqXHbPw7sjHkO4bpkeGJ2vl7k8d8dGf6a8U/1W1H6Ee55HfTb+rkodD4FgbNvxHbEPWiqGnvbqenECAf7qieNnox9OgG5a7KkNJQOwo6KzvAfe+glqjlQEog3PJzVEAXHpAFl7EX1lSAg30RuiE0eacVwSiezNMMhaWW/cyr14VY0eBVndXoDCMyhJ1Z4nKxfK6O6oKs8FdQcpfMyfXareanuLP0qErdNrflF+V2wIDAQAB';
        $data=[
            'outTradeNo' => $this->generateUUID(),
            'subject' => "Goods Name",
            'totalAmount' => $amount,
            'shortCode' => "222222",
            'notifyUrl' => route('telebirr_notify'),
            'returnUrl' => route('telebirr_notify'),
            'receiveName' => $user->name,
            'appId' => "915470ae19bb4260a5218e7de6c3bb75",
            'timeoutExpress' => "120",
            'nonce' => $this->generateUUID(),
            // 'nonce' => "2021062421280000018",
            'timestamp' => "1233"
        ];
       
        ksort($data);
        $ussd = $data;
        $data['appKey'] = $appkey;
        ksort($data);
        $sign = $this->sign($data);
     
        $encode = [
            'appid' => "915470ae19bb4260a5218e7de6c3bb75",
            'sign' => $sign["sha256"],
            'ussd' =>$this->encryptRSA(json_encode($ussd), $publicKey)
        ];
        list($returnCode, $returnContent) = $this->httpPostJson($api, json_encode($encode));
        
        if ($returnCode == 200) {
            $rsp = json_decode($returnContent, true);
            // dd($rsp);
            return redirect()->away($rsp['data']['toPayUrl']);
        } else {
            return 'Fail:' . $returnCode . '   ' . $sign['values'];
        }
    }

    public function payOffline(Request $request){
        $cart = cart();
        $amount = $cart->total_amount;

        $user = Auth::user();
        $currency = get_option('currency_sign');

        //Create payment in database
        $transaction_id = 'tran_'.time().str_random(6);
        // get unique recharge transaction id
        while( ( Payment::whereLocalTransactionId($transaction_id)->count() ) > 0) {
            $transaction_id = 'reid'.time().str_random(5);
        }
        $transaction_id = strtoupper($transaction_id);

        $payments_data = [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'user_id'               => $user->id,
            'amount'                => $amount,
            'payment_method'        => 'offline',
            'status'                => 'onhold',
            'currency'              => $currency,
            'local_transaction_id'  => $transaction_id,
            'payment_note'          => clean_html($request->payment_note),
        ];
        //Create payment and clear it from session
        Payment::create_and_sync($payments_data);
        $request->session()->forget('cart');

        return redirect(route('payment_thank_you_page'));
    }

    /**
     * Heleper function
     * 
     */

    private function sign($params){
        $signPars = '';
        foreach ($params as $k => $v) {
            if ($signPars == '') {
                $signPars = $k . '=' . $v;
            } else {
                $signPars = $signPars . '&' . $k . '=' . $v;
            }
        }

        $sign = [
            'sha256' => hash("sha256", $signPars),
            'values' => $signPars,
        ];
        return $sign;
    }

    private function encryptRSA($data, $public)
    {
        $pubPem = chunk_split($public, 64, "\n");
        $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
        $public_key = openssl_pkey_get_public($pubPem);
        if (!$public_key) {
            die('invalid public key');
        }
        $crypto = '';
        foreach (str_split($data, 117) as $chunk) {
            $return = openssl_public_encrypt($chunk, $cryptoItem, $public_key);
            if (!$return) {
                return 'fail';
            }
            $crypto .= $cryptoItem;
        }

        $ussd = base64_encode($crypto);
        return $ussd;
    }

    private function httpPostJson($url, $jsonStr)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr),
            )
        );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array($httpCode, $response);
    }

    private function generateUUID() {
        $s = [];
        $hexDigits = "0123456789abcdef";
        for ($i = 0; $i < 36; $i++) {
            $s[$i] = $hexDigits[mt_rand(0, 15)];
        }
        $s[14] = "4"; // bits 12-15 of the time_hi_and_version field to 0010
        $s[19] = $hexDigits[(hexdec($s[19]) & 0x3) | 0x8]; // bits 6-7 of the clock_seq_hi_and_reserved to 01
        $s[8] = $s[13] = $s[18] = $s[23] = "-";

        $uuid = implode("", $s);
        return str_replace("-", "", $uuid);
    }
}
