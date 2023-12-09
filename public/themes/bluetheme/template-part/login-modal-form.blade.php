
<!-- Modal -->
<div class="modal fade" id="loginFormModal{{old('_request_from') === 'login_modal'? 'ShouldOpen':''}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content login_modal_bg">
            <div class="modal-header border-0 p-0 ml-auto">
                
                <button type="button" class="close m-3 p-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal_login pt-0 px-4">

                @include('inc.flash_msg')
                <h5 class="modal-title login_title mb-4" id="exampleModalLabel"><i class="la la-sign-in"></i> {{__t('login')}} </h5>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="hidden" name="_redirect_back_to" value="{{request()->url()}}">
                    <input type="hidden" name="_request_from" value="login_modal">

                    <div class="form-group">
                        <!-- <label>{{ __t('email_address') }}</label> -->

                        <input id="email" type="email" class="login_input_modal form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <!-- <label>{{ __t('password') }}</label> -->
                        <input id="password" type="password" class="login_input_modal form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="checkbox col-md-6">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __t('remember_me') }}
                            </label>
                        </div>

                        <div class="col-md-6">
                            <a class="float-right" href="{{route('register')}}"> {{__t('signup_for_free')}}</a>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-block login_btn_popup">
                            {{ __t('login') }}
                        </button>
                    </div>
                    <div class="text-center mt-2">
                        <a class="btn btn-link" style="color:#5022C3;" href="{{ route('forgot_password') }}">
                            {{ __t('forgot_ur_password') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
