<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstallationController extends Controller
{

    public function installations(){
        if ( file_exists(base_path('.env')) ) {
            return redirect(route('home'));
        }

        $title = "Installations";

        return view('installations.index',  compact('title'));
    }

    public function installationsTwo(){
        if ( file_exists(base_path('.env')) ) {
            return redirect(route('home'));
        }

        $title = "Installations Step Two";
        return view('installations.step_two',  compact('title'));
    }


    public function installationPost(Request $request){
        define('STDIN',fopen("php://stdin","r"));

        if ( file_exists(base_path('.env')) ) {
            return redirect(route('home'));
        }

        $rules = [
            'hostname' => 'required',
            'dbport' => 'required',
            'username' => 'required',
           // 'password' => 'required',
            'database_name' => 'required'
        ];
        $this->validate($request, $rules);

        $dbname = $request->database_name;

        try{
            $mysqli_link = mysqli_connect($request->hostname, $request->username, $request->password, $request->database_name);

            mysqli_close($mysqli_link);

        } catch (\Exception $e) {

            $conn = new \mysqli($request->hostname, $request->username, $request->password);

            if ( ! $conn->connect_error) {
                mysqli_query($conn, "DROP DATABASE IF EXISTS {$dbname} ;");
                mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS {$dbname} ;");
                mysqli_close($conn);

            }else{
                return back()->with('error', $e->getMessage());
            }
        }

        $default_value = $this->env_default_value();
        $default_value['APP_URL'] = route('home');

        $default_value['DB_HOST'] = $request->hostname;
        $default_value['DB_PORT'] = $request->dbport;
        $default_value['DB_DATABASE'] = $request->database_name;
        $default_value['DB_USERNAME'] = $request->username;
        $default_value['DB_PASSWORD'] = $request->password."\n";

        $conf = "";
        foreach ($default_value as $convKey => $confVal){
            $conf .= "{$convKey}={$confVal}\n";
        }

        $unable_to_open = "Unable to open file! <br /> please create a <b>.env</b> file manually in your document root with below configuration, save below configuration to .env file, place it at <code>".base_path()."</code> <br /><br />";

        $unable_to_open .= "<pre>{$conf}</pre>";

        $open_env_file = fopen(base_path(".env"), "w") or die($unable_to_open);
        fwrite($open_env_file, $conf);
        fclose($open_env_file);
        chmod(base_path(".env"), 0777);


        return redirect(route('installation_final'));

        /*
                Artisan::call('migrate:install');
                Artisan::call('migrate');
                Artisan::call('db:seed');*/
    }

    public function installationFinal(){
        if ( file_exists(base_path('.env')) ) {
            try {
                $option = Option::query()->where('option_name', 'site_title')->first();
            } catch (\Exception $e) {
                if ($e->getCode() === '42S02') {
                    Artisan::call('migrate:install');
                    Artisan::call('migrate');
                    Artisan::call('db:seed');
                }
            }
        }else{
            return redirect(route('installations'));
        }

        $title = 'Installation Successful';
        return view('installations.successful', compact('title'));
    }

    public function env_default_value(){

        $envValue = [
            'APP_NAME' => 'Udify',
            'APP_ENV' => 'local',
            'APP_KEY' => 'base64:ncl0ff7LnuMWRtndahBiGKYDfkHSviLSFQiwgdWtS1A=',
            'APP_URL' => 'http://localhost/',
            'APP_DEBUG' => 'false',
            'IS_DEMO' => 'false'."\n",

            'LOG_CHANNEL' => 'stack'."\n",

            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => '127.0.0.1',
            'DB_PORT' => '3306',
            'DB_DATABASE' => 'udify',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '',

            'BROADCAST_DRIVER' => 'log',
            'CACHE_DRIVER' => 'file',
            'QUEUE_CONNECTION' => 'sync',
            'SESSION_DRIVER' => 'file',
            'SESSION_LIFETIME' => '120'."\n",

            'REDIS_HOST' => '127.0.0.1',
            'REDIS_PASSWORD' => 'null',
            'REDIS_PORT' => '6379'."\n",

            'MAIL_MAILER' => 'mail',
            'MAIL_HOST' => 'smtp.mailtrap.io',
            'MAIL_PORT' => '2525',
            'MAIL_USERNAME' => 'null',
            'MAIL_PASSWORD' => 'null',
            'MAIL_ENCRYPTION' => 'null',
            'MAIL_FROM_ADDRESS' => 'null',
            'MAIL_FROM_NAME' => '"${APP_NAME}"'."\n",

            'AWS_ACCESS_KEY_ID' => '',
            'AWS_SECRET_ACCESS_KEY' => '',
            'AWS_DEFAULT_REGION' => 'us-east-1',
            'AWS_BUCKET' => ''."\n",

            'PUSHER_APP_ID' => '',
            'PUSHER_APP_KEY' => '',
            'PUSHER_APP_SECRET' => '',
            'PUSHER_APP_CLUSTER' => 'mt1'."\n",

            'MIX_PUSHER_APP_KEY' => '"${PUSHER_APP_KEY}"',
            'MIX_PUSHER_APP_CLUSTER' => '"${PUSHER_APP_CLUSTER}"',
        ];

        return $envValue;
    }

}
