<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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

     /**
     * Telebirr notification hit here
     * It decript and accept the request notify
     * @param Request $request
     *
     * Payment IPN
     */
    public function telebirrNotify(Request $request){
        $content = $request->getContent();
        Log::info("CALLBACK NOTIFICATION HITED HERE");
        Log::info($content);
       /**
        * callback response interface
        * {"msisdn":"251900000032","outTradeNo":"b6e12f97a42145f98a336a2795f835be","totalAmount":"104","tradeDate":1702519773000,"tradeNo":"202312140507431735119347085897730","tradeStatus":2,"transactionNo":"ALE40OKU0U"}
        */
        $response = $this->processPayment($content);
        if($response){
            $data = json_decode($response, true);
            $outTradeNo = $data['outTradeNo'];
            $tradeNo = $data['tradeNo'];
            $description = $data['tradeNo'];
            $transactionNo = $data['transactionNo'];
            $tradeDate = $data['tradeDate'];
            $msisdn = $data['msisdn'];
            
            $payment = Payment::whereLocalTransactionId($outTradeNo)->where('status','!=','success')->first();
    
            // $verified = $this->paypal_ipn_verify();
            if ($payment){
                //Payment success, we are ready approve your payment
                $payment->status = 'success';
                $payment->charge_id_or_token = $transactionNo;
                $payment->description = $description;
                $payment->payer_email = $msisdn;
                $payment->payment_created = $tradeDate;
                $payment->save_and_sync();
                dd(outTradeNo);
                return "SUCCESS";
            }else{
                $payment->status = 'declined';
                $payment->description = trans('app.payment_declined_msg');
                $payment->save_and_sync();
                return "FAIL";
            }
        }
    }

    /**
     * Heleper function
     * process payment called decryptRSA which the decription the encrypted plane text 
     * 
     */

    private function processPayment($request_body)
    {
        $api = 'http://196.188.120.3:11443/service-openup/toTradeWebPay';
        $appkey = '835ea4bee622439a942e9566e24dcc60';
        $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmLAHu17fUEshx7xva1vPYLrJdU5GX9hSIEyMlap9QcChwDLDPVpD0RYTwHA7pvXE0HXmfVjfTEEogONpH9M+JWrvOePoUCUrplmonmovwgGbaiqXHbPw7sjHkO4bpkeGJ2vl7k8d8dGf6a8U/1W1H6Ee55HfTb+rkodD4FgbNvxHbEPWiqGnvbqenECAf7qieNnox9OgG5a7KkNJQOwo6KzvAfe+glqjlQEog3PJzVEAXHpAFl7EX1lSAg30RuiE0eacVwSiezNMMhaWW/cyr14VY0eBVndXoDCMyhJ1Z4nKxfK6O6oKs8FdQcpfMyfXareanuLP0qErdNrflF+V2wIDAQAB';
        
        $nofityData = $this->decryptRSA($request_body, $publicKey);
        return $nofityData;
    }
    
    private function decryptRSA($data, $publickey)
    {   
            $decrypted = '';
            $data = str_split(base64_decode($data), 256);
            $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $publickey . "\n-----END PUBLIC KEY-----";
            $publicKey = openssl_pkey_get_public($pubPem); 
        
            foreach ($data as $xData) {
                $part = '';
                $tryDecrpt = openssl_public_decrypt($xData, $part, $publicKey, OPENSSL_PKCS1_PADDING);
                if ($tryDecrpt === false) {
                   print_r("FALSE");
                   return false;
                }
                $decrypted .= $part;
            }
            return $decrypted; 
    }

    /**
     * For encription test
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

}
