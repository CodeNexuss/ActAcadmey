<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use DateTime;
use DB;
use Validator;
use App;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;

class ApiAuthController extends Controller
{
    public function signup(Request $request) {
        $rules = array(
            'name'      => 'required|min:2|max:255',
            'email'     => 'required|max:255|email|unique:users',
            'password'  => 'required|min:8',
            'user_type' => 'required|in:student,instructor',
        );

        $attributes = array(
            'name'          => 'Name',
            'email'         => 'Email',
            'password'      => 'Password',
            'user_type'     => 'User Type',
        );

        $messages = array('required' => ':attribute is required.');
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => '0',
                'success_message' => $validator->messages()->first(),
            ]);
        }

        $user = new User;
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->password         = bcrypt($request->password);
        $user->user_type        = $request->user_type;
        $user->active_status    = 1;
        $user->save();

        if($user){
            return $this->login($request);
        }
        return response()->json([
            'status_code' => '0',
            'success_message' => 'Signup failed. Try again',
        ]);
    }

    public function login(Request $request){
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        $attributes = array(
            'email'         => 'Email',
            'password'      => 'Password'
        );

        $messages = array('required' => ':attribute is required.');
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => '0',
                'success_message' => $validator->messages()->first(),
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json([
                        'status_code' => '0',
                        'success_message' => 'Wrong credentials',
                    ]);
                }
            }
            catch (JWTException $e) {
                return response()->json([
                    'status_code' => '0',
                    'success_message' => 'Could not create Token',
                ]);
            }

            $user = User::whereEmail($request->email)->first();

            // if ($user->active_status != 1) {
            //     return response()->json([
            //         'status_code' => '0',
            //         'success_message' => 'User not active',
            //     ]);
            // }

            $return_data = array(
                'status_code' => '1',
                'success_message' => 'You are logged in',
                'access_token' => $token,
            );

            $user_details = $this->getUserDetails($user);

            return response()->json(array_merge($return_data,$user_details));
        }

        return response()->json([
            'status_code' => '0',
            'success_message' => 'Wrong credentials',
        ]);
    }

    protected function getUserDetails($user)
    {
        $user_data = array(
            'id'                => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
            'photo'             => $user->photo,
            'gender'            => $user->gender,
            'job_title'         => $user->job_title,
            'user_type'         => $user->user_type,
            'active_status'     => $user->active_status,
        );

        return $user_data;
    }

    public function dashboard(Request $request) {
        echo 'hello'; exit;
    }

    public function logout(Request $request) {
        $user_details = JWTAuth::parseToken()->authenticate();
        JWTAuth::invalidate($request->bearerToken());
        auth()->logout();
        return response()->json([
            'status_code' => '1',
            'success_message' => 'Logout Success',
        ], 200);
    }
}
