<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8 col-12 cls_login">

            <div class="card">
                <div class="card-header text-center">
                <h2>{{ __t('login') }}</h2>
                <h4>{{__t('dont_have_an_account_yet')}}<a href="{{route('register')}}"> {{__t('signup_for_free')}}</a></h4>
            </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">

                            @include('inc.flash_msg')

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <!-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __t('email_address') }}</label> -->

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __t('email_address') }}" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __t('password') }}</label> -->

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __t('password') }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <div class="checkbox mr-auto">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __t('remember_me') }}
                                            </label>
                                        </div>
                                        <div class="formget ml-auto">
                                             <a class="btn btn-link" href="{{ route('forgot_password') }}">
                                                {{ __t('forgot_ur_password') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn cls_btn d-block w-100">
                                            {{ __t('login') }}
                                        </button>

                                       
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="col-md-12">
                            <div class="my-4 text-center">
                                @if(get_option('social_login.facebook.enable') || get_option('social_login.google.enable') || get_option('social_login.twitter.enable') ||
                                get_option('social_login.linkedin.enable'))
                                <p class="m-0">{{__t('or_login_with')}}</p>
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

                                <!-- @if(get_option('social_login.twitter.enable')) -->
                                    <!-- <a href="{{ route('twitter_redirect') }}" class="social-login-item btn-twitter">
                                        <i class="la la-twitter"></i> -->
                                        <!-- <span class="hidden-xs"><i class="la la-twitter"></i> <strong> Continue with Twitter </strong></span> -->
                                    <!-- </a> -->
                                <!-- @endif -->

                                @if(get_option('social_login.linkedin.enable'))

                                    <a href="{{ route('linkedin_redirect') }}" class="social-login-item btn-linkedin">
                                        <i class="la la-linkedin-square"></i>

                                        <!-- <span class="hidden-xs"><i class="la la-linkedin-square"></i><strong> Continue with LinkedIn </strong></span> -->
                                    </a>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    @if(is_live_env())
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="demo-credential-box-wrapper">
                    <h4 class="my-4">{{__t('demo_login_credentials')}}:</h4>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <strong>{{__t('admin')}}</strong>
                                </div>
                                <div class="card-body">
                                    <p class="m-0">{{__t('email')}}: <code>admin@demo.com</code></p>
                                    <p class="m-0">{{__t('password')}}: <code>123456</code></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <strong>{{__t('instructor')}}</strong>
                                </div>
                                <div class="card-body">
                                    <p class="m-0">{{__t('email')}}: <code>instructor@demo.com</code></p>
                                    <p class="m-0">{{__t('password')}}: <code>123456</code></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <strong>{{__t('student')}}</strong>
                                </div>
                                <div class="card-body">
                                    <p class="m-0">{{__t('email')}}: <code>student@demo.com</code></p>
                                    <p class="m-0">{{__t('password')}}: <code>123456</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
