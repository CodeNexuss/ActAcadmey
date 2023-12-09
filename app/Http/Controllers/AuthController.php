<?php

namespace App\Http\Controllers;

use App\Mail\SendPasswordResetLink;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function login(){
        $title = __t('login');
        return view_template('login', compact('title'));
    }

    public function loginPost(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $this->validate($request, $rules);

        $credential = [
            'email'     => $request->email,
            'password'     => $request->password
        ];

        if ( Auth::attempt($credential, $request->remember_me)){
            $auth = Auth::user();
            if($auth->active_status==2) {
                Auth::logout();
                return redirect()->route('login')->with('error', __t('login_failed_user_blocked'));
            }

            if ($request->_redirect_back_to){
                return redirect($request->_redirect_back_to);
            }

            if ($auth->isAdmin()){
                return redirect()->intended(route('admin'));
            }else{
                return redirect()->intended(route('dashboard'));
            }
        }

        return redirect()->back()->with('error', __t('login_failed'))->withInput($request->input());
    }


    public function register(){
        $title = __t('signup');
        return view_template('register', compact('title'));
    }

    public function registerPost(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|min:6|confirmed',
        ];
        if($request->login_type=='email') {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $this->validate($request, $rules);

        $user_data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => $request->user_as,
            'active_status' => 1,
            'provider_user_id' => $request->provider_user_id,
            'provider' => $request->login_type ?? $request->provider,
        ];
        // if($request->has('login_type') && $request->login_type!='email') {
        //     $user_data['provider_user_id'] = $request->provider_user_id;
        //     $user_data['provider'] = $request->provider;
        // }

        $user = User::create($user_data);

        if($request->has('login_type') && $request->login_type!='email') {
            auth()->login($user);
            return redirect()->intended(route('dashboard'));
        }

        if ($user){
            $this->loginPost($request);
        }
        return back()->with('error', __t('failed_try_again'))->withInput($request->input());
    }

    public function logoutPost(){
        Auth::logout();
        return redirect('login');
    }

    public function forgotPassword(){
        $title = __t('forgot_password');
        return view(theme('auth.forgot_password'), compact('title'));
    }

    public function sendResetToken(Request $request){
        $this->validate($request, ['email' => 'required']);

        $email = $request->email;

        $user = User::whereEmail($email)->first();
        if ( ! $user){
            return back()->with('error', __t('email_not_found'));
        }

        $user->reset_token = str_random(32);
        $user->save();

        try {
            Mail::to($email)->send(new SendPasswordResetLink($user));
        }catch (\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', __t('forgot_password_mail_sent'));
    }

    public function passwordResetForm(){
        $title = __t('reset_your_password');
        return view(theme('auth.reset_form'), compact('title'));
    }

    public function passwordReset(Request $request, $token){
        if(is_live_env()){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
        }
        $rules = [
            'password'  => 'required|confirmed',
            'password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $user = User::whereResetToken($token)->first();
        if ( ! $user){
            return back()->with('error', __t('invalid_reset_token'));
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('login'))->with('success', __t('password_reset_success'));
    }

    /**
     * Social Login Settings
     */

    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function redirectTwitter(){
        return Socialite::driver('twitter')->redirect();
    }
    public function redirectLinkedIn(){
        return Socialite::driver('linkedin')->redirect();
    }

    public function callbackFacebook(){
        try {
            $socialUser = Socialite::driver('facebook')->user();
            $user = $this->getSocialUser($socialUser, 'facebook');
            if(isset($user['login_type']) && $user['login_type']=='facebook') {
                $selUser = User::find($user['user']->id);
                if($selUser) {
                    auth()->login($selUser);
                }
                // dd($user['user'], $selUser);
                return view_template('register', $user);
            }
            auth()->login($user['user']);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e){
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }

    public function callbackGoogle(){
        try {
            $socialUser = Socialite::driver('google')->user();
            $user = $this->getSocialUser($socialUser, 'google');
            if(isset($user['login_type']) && $user['login_type']=='google') {
                return view_template('register', $user);
            }
            auth()->login($user['user']);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e){
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }
    public function callbackTwitter(){
        try {
            $socialUser = Socialite::driver('twitter')->user();
            $user = $this->getSocialUser($socialUser, 'twitter');
            auth()->login($user);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e){
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }
    public function callbackLinkedIn(){
        try {
            $socialUser = Socialite::driver('linkedin')->user();
            $user = $this->getSocialUser($socialUser, 'linkedin');
            if(isset($user['login_type']) && $user['login_type']=='linkedin') {
                $selUser = User::find($user['user']->id);
                if($selUser) {
                    auth()->login($selUser);
                }
                return view_template('register', $user);
            }
            auth()->login($user['user']);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e){
            return redirect(route('login'))->with('error', $e->getMessage());
        }
    }

    public function getSocialUser($providerUser, $provider = ''){
        $user = User::whereProvider($provider)->whereProviderUserId($providerUser->getId())->first();

        if ($user) {
            $data['user'] = $user;
            return $data;
        } else {

            $user = User::whereEmail($providerUser->getEmail())->first();
            if ($user) {

                $user->provider_user_id = $providerUser->getId();
                $user->provider = $provider;
                $user->save();
                $data['user'] = $user;
                $data['login_type'] = $provider;

            }else{
                $data['title'] = __t('signup');
                $data['user'] = $providerUser;
                $data['user']->provider_user_id = $providerUser->getId();
                $data['login_type'] = $provider;                

                // $user = User::create([
                //     'email'             => $providerUser->getEmail(),
                //     'name'              => $providerUser->getName(),
                //     'user_type'         => 'user',
                //     'active_status'     => 1,
                //     'provider_user_id'  => $providerUser->getId(),
                //     'provider'          => $provider,
                // ]);
            }

            return $data;
        }
    }

}
