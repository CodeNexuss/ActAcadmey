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
        Log::info("BACKEND NOTIFICATION HETED HERE");
        Log::info($content);
       
        $response = $this->processPayment($content);
        return $response;
        // Thet
        $payment = Payment::whereLocalTransactionId($request->outTradeNo)->where('status','!=','success')->first();

        // $verified = $this->paypal_ipn_verify();
        if ($payment){
            //Payment success, we are ready approve your payment
            $payment->status = 'success';
            $payment->charge_id_or_token = $request->transactionNo;
            $payment->description = $request->tradeStatus;
            // // $payment->payer_email = $request->payer_email;
            $payment->payment_created = $request->tradeDate;
            $payment->save_and_sync();
            return "SUCCESS";
        }else{
            $payment->status = 'declined';
            $payment->description = trans('app.payment_declined_msg');
            $payment->save_and_sync();
            return "FAIL";
        }
        // // Reply with an empty 200 response to indicate to paypal the IPN was received correctly
        // header("HTTP/1.1 200 OK");
        
    }

    /**
     * Heleper function
     * process payment called decryptRSA which the decription the encrypted plane text 
     * 
     */

    private function processPayment($request_body)
    {
        // $content = file_get_contents('php://input');
        // header('Content-Type:application/json; charset=utf-8');
        $api = 'http://196.188.120.3:11443/service-openup/toTradeWebPay';
        $appkey = '835ea4bee622439a942e9566e24dcc60';
        $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmLAHu17fUEshx7xva1vPYLrJdU5GX9hSIEyMlap9QcChwDLDPVpD0RYTwHA7pvXE0HXmfVjfTEEogONpH9M+JWrvOePoUCUrplmonmovwgGbaiqXHbPw7sjHkO4bpkeGJ2vl7k8d8dGf6a8U/1W1H6Ee55HfTb+rkodD4FgbNvxHbEPWiqGnvbqenECAf7qieNnox9OgG5a7KkNJQOwo6KzvAfe+glqjlQEog3PJzVEAXHpAFl7EX1lSAg30RuiE0eacVwSiezNMMhaWW/cyr14VY0eBVndXoDCMyhJ1Z4nKxfK6O6oKs8FdQcpfMyfXareanuLP0qErdNrflF+V2wIDAQAB';
        
        $nofityData = $this->decryptRSA($request_body, $publicKey);
       
        return $nofityData;

    //     function decrypt_RSA($publickey, $data){
     
    // // function decrypt_RSA($data, $publickey){
    //         $decrypted = '';
    //         $data = str_split(base64_decode($data), 256);
    //         $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $publickey . "\n-----END PUBLIC KEY-----";
    //         $publicKey = openssl_pkey_get_public($pubPem); 
    //         foreach ($data as $xData) {
    //             $part = '';
    //             $tryDecrpt = openssl_public_decrypt($xData, $part, $publicKey, OPENSSL_PKCS1_PADDING);
    //             if ($tryDecrpt === false) {
    //                return false;
    //             }
    //             $decrypted .= $part;
    //         }
    //         return $decrypted;  
    // }

        // return response()->json(['code' => 0, 'msg' => 'success']);

        // $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmLAHu17fUEshx7xva1vPYLrJdU5GX9hSIEyMlap9QcChwDLDPVpD0RYTwHA7pvXE0HXmfVjfTEEogONpH9M+JWrvOePoUCUrplmonmovwgGbaiqXHbPw7sjHkO4bpkeGJ2vl7k8d8dGf6a8U/1W1H6Ee55HfTb+rkodD4FgbNvxHbEPWiqGnvbqenECAf7qieNnox9OgG5a7KkNJQOwo6KzvAfe+glqjlQEog3PJzVEAXHpAFl7EX1lSAg30RuiE0eacVwSiezNMMhaWW/cyr14VY0eBVndXoDCMyhJ1Z4nKxfK6O6oKs8FdQcpfMyfXareanuLP0qErdNrflF+V2wIDAQAB';
        // $appkey = 'fa945fad72e640edaaf816ddcd9e2866';
        // $data=[
        //     'subject' => "Buy Cocurce",
        //     'shortCode' => "222222",
        //     'appId' => "915470ae19bb4260a5218e7de6c3bb75",
        //     'timeoutExpress' => "120",
        //     'timestamp' => "123"
        // ];
        
        // ksort($data);
        // $ussd = $data;
        // $data['appKey'] = $appkey;
        // ksort($data);
        // $sign = $this->sign($data);
        // $encode = [
        //     'appid' => "915470ae19bb4260a5218e7de6c3bb75",
        //     'sign' => $sign["sha256"],
        //     'ussd' =>$this->encryptRSA(json_encode($ussd), $publicKey)
        // ];
        
        // // list($returnCode, $returnContent) = $this->httpPostJson($api, json_encode($encode));
        // return $encode;

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
            // print_r($decrypted);
            return $decrypted;  

        // $pubPem = chunk_split($key, 64, "\n");
        // $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
        
        // $public_key = openssl_pkey_get_public($pubPem); 
      
        // if (!$public_key) {
        //     die('invalid public key');
        // }
        // $decrypted = ''; // decode must be done before splitting for getting the binary String
        // $data = str_split($source, 256);
    
        // foreach ($data as $chunk) {
        //     $partial = ''; // be sure to match padding
        //     // $decryptionOK = openssl_public_decrypt($chunk, $partial, $public_key, OPENSSL_PKCS1_PADDING);
        //     $decryptionOK = openssl_public_decrypt($chunk, $partial, $public_key, OPENSSL_PKCS1_PADDING);
            
        //     if ($decryptionOK === false) {
        //         die('fail');
        //     }
        //     $decrypted .= $partial;
        // }
        // print_r($decrypted);
        // return $decrypted;
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
