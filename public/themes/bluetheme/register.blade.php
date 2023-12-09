<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8 col-12  cls_login">
            <div class="card">
                <div class="card-header text-center">
                <h2>{{ __t('register') }} </h2>
                    <h4>{{__t('have_an_accout')}} <a href="{{route('login')}}">{{__t('login')}}</a></h4>
                </div>
                <div class="card-body auth-form-wrap">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="login_type" value="{{ (isset($login_type) && !empty($login_type)) ? $login_type : 'email' }}">
                        <input type="hidden" name="provider_user_id" id="provider_user_id" value="{{ (isset($user) && !empty($user)) ? $user->provider_user_id : '' }}">

                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <!-- <label for="name" class="col-md-4 control-label">{{__t('name')}}</label> -->

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ (isset($user) && !empty($user)) ? $user->name : '' ?? old('name') }}" placeholder="{{__t('name')}}" required>                                

                                @if ($errors->has('name'))
                                <div class="mt-2">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                </div>                                  
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                            <!-- <label for="email" class="col-md-4 control-label">{{__t('email_address')}}</label> -->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" placeholder="{{__t('email_address')}}" value="{{ (isset($user) && !empty($user)) ? $user->email : '' ?? old('email') }}" required>

                                @if ($errors->has('email'))
                                <div class="mt-2">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                </div>
                                   
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }} {{ (isset($login_type) && $login_type!='email') ? 'hide' : '' }}">
                            <!-- <label for="password" class="col-md-4 control-label">{{__t('password')}}</label> -->

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" @if(! isset($login_type) || $login_type=='email') required @endif placeholder="{{__t('password')}}">

                                @if ($errors->has('password'))
                                <div class="mt-2">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                     </span>
                                </div>
                                         
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ (isset($login_type) && $login_type!='email') ? 'hide' : '' }}">
                            <!-- <label for="password-confirm" class="col-md-4 control-label">{{__t('confirm_password')}}</label> -->

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(! isset($login_type) || $login_type=='email') required @endif placeholder="{{__t('confirm_password')}}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="password-confirm" class="col-md-2 control-label"><strong>{{__t('i_am')}}</strong></label>

                            <div class="col-md-10">
                                <label class="mr-3"><input type="radio" name="user_as" value="student" {{old('user_as') ? (old('user_as') == 'student') ? 'checked' : '' : 'checked' }}> {{__t('student')}} </label>
                                <label><input type="radio" name="user_as" value="instructor" {{old('user_as') == 'instructor' ? 'checked' : ''}} > {{__t('instructor')}} </label>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="submit" class="btn cls_btn d-block w-100"> {{__t('register')}} </button>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="my-4 text-center">
                                    @if(get_option('social_login.facebook.enable') || get_option('social_login.google.enable') || get_option('social_login.twitter.enable') ||
                                    get_option('social_login.linkedin.enable'))
                                    <p class="m-0">{{__t('or_signup_with')}}</p>
                                    @endif
                                </div>

                                <div class="social-login-wrap mb-4 text-center">
                                    @if(get_option('social_login.facebook.enable'))
                                        <a href="{{ route('facebook_redirect') }}" class="social-login-item btn-facebook">
                                            <i class="la la-facebook"></i>
                                        </a>
                                    @endif

                                    @if(get_option('social_login.google.enable'))
                                        <a href="{{ route('google_redirect') }}" class="social-login-item btn-google">
                                            <i class="la la-google"></i>
                                        </a>
                                    @endif

                                    <!-- @if(get_option('social_login.twitter.enable'))
                                        <a href="{{ route('twitter_redirect') }}" class="social-login-item btn-twitter">
                                            <i class="la la-twitter"></i> -->
                                            <!-- <span class="hidden-xs"><i class="la la-twitter"></i> <strong> Continue with Twitter </strong></span> -->
                                        <!-- </a>
                                    @endif -->

                                    @if(get_option('social_login.linkedin.enable'))

                                        <a href="{{ route('linkedin_redirect') }}" class="social-login-item btn-linkedin">
                                            <i class="la la-linkedin-square"></i>

                                            <!-- <span class="hidden-xs"><i class="la la-linkedin-square"></i><strong> Continue with LinkedIn </strong></span> -->
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
