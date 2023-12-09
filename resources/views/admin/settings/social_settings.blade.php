@extends('layouts.admin')

@section('content')



    <form action="{{route('save_settings')}}" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf

        <ul class="nav nav-tabs mb-5" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="facebook-login-tab" data-toggle="pill" href="#facebook-login">
                    <i class="lab la-facebook"> </i> Facebook
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="google-login-tab" data-toggle="pill" href="#google-login">
                    <i class="la la-google"></i> Google
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" id="twitter-login-tab" data-toggle="pill" href="#twitter-login">
                    <i class="la la-twitter"></i> Twitter
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" id="linkedin-login-tab" data-toggle="pill" href="#linkedin-login">
                    <i class="la la-linkedin"></i> LinkedIn
                </a>
            </li>
        </ul>

        <div class="tab-content" id="payment-settings-tab-wrap">
            <div class="tab-pane fade show active" id="facebook-login">

                <div class="form-group row">
                    <label class="col-md-4 control-label">{{__a('enable_facebook_login')}} </label>
                    <div class="col-md-6">
                        {!! switch_field('social_login[facebook][enable]', '', get_option('social_login.facebook.enable') ) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fb_app_id" class="col-sm-4 control-label">@lang('admin.facebook') @lang('admin.app_id')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="fb_app_id" value="{{ get_option('social_login.facebook.app_id') }}" name="social_login[facebook][app_id]" placeholder="@lang('admin.facebook') @lang('admin.app_id')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fb_app_secret" class="col-sm-4 control-label">@lang('admin.facebook') @lang('admin.app_secret')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="fb_app_secret" value="{{ get_option('social_login.facebook.app_secret') }}" name="social_login[facebook][app_secret]" placeholder="@lang('admin.facebook') @lang('admin.app_secret')">
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="google-login">

                <div class="form-group row">
                    <label class="col-md-4 control-label">{{__a('enable_google_login')}} </label>
                    <div class="col-md-6">
                        {!! switch_field('social_login[google][enable]', '', get_option('social_login.google.enable') ) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="google_client_id" class="col-sm-4 control-label">@lang('admin.google') @lang('admin.client_id')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="google_client_id" value="{{ get_option('social_login.google.client_id') }}" name="social_login[google][client_id]" placeholder="@lang('admin.google') @lang('admin.client_id')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="google_client_secret" class="col-sm-4 control-label">@lang('admin.google') @lang('admin.client_secret')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="google_client_secret" value="{{ get_option('social_login.google.client_secret') }}" name="social_login[google][client_secret]" placeholder="@lang('admin.google') @lang('admin.client_secret')">
                    </div>
                </div>


            </div>

            <div class="tab-pane fade" id="twitter-login">

                <div class="form-group row">
                    <label class="col-md-4 control-label">{{__a('enable_twitter_login')}} </label>
                    <div class="col-md-6">
                        {!! switch_field('social_login[twitter][enable]', '', get_option('social_login.twitter.enable') ) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="twitter_consumer_key" class="col-sm-4 control-label">@lang('admin.twitter') @lang('admin.consumer_key')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="twitter_consumer_key" value="{{ get_option('social_login.twitter.consumer_key') }}" name="social_login[twitter][consumer_key]" placeholder="@lang('admin.twitter') @lang('admin.consumer_key')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="twitter_consumer_secret" class="col-sm-4 control-label">@lang('admin.twitter') @lang('admin.consumer_secret')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="twitter_consumer_secret" value="{{ get_option('social_login.twitter.consumer_secret') }}" name="social_login[twitter][consumer_secret]" placeholder="@lang('admin.twitter') @lang('admin.consumer_secret')">
                    </div>
                </div>

            </div>


            <div class="tab-pane fade" id="linkedin-login">

                <div class="form-group row">
                    <label class="col-md-4 control-label">{{__a('enable_linkedin_login')}} </label>
                    <div class="col-md-6">
                        {!! switch_field('social_login[linkedin][enable]', '', get_option('social_login.linkedin.enable') ) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="linkedin_client_id" class="col-sm-4 control-label">@lang('admin.linkedin') @lang('admin.client_id')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="linkedin_client_id" value="{{ get_option('social_login.linkedin.client_id') }}" name="social_login[linkedin][client_id]" placeholder="@lang('admin.linkedin') @lang('admin.client_id')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="linkedin_client_secret" class="col-sm-4 control-label">@lang('admin.linkedin') @lang('admin.client_secret')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="linkedin_client_secret" value="{{ get_option('social_login.linkedin.client_secret') }}" name="social_login[linkedin][client_secret]" placeholder="@lang('admin.linkedin') @lang('admin.client_secret')">
                    </div>
                </div>

            </div>


        </div>

        <hr />

        <div class="form-group row">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" id="settings_save_btn" class="btn btn-primary">
                    {{__a('save_settings')}}
                </button>
            </div>
        </div>

    </form>

@endsection


@section('page-js')
    <script>
        $(document).ready(function(){

            $('input[type="checkbox"], input[type="radio"]').click(function(){
                var input_name = $(this).attr('name');
                var input_value = 0;
                if ($(this).prop('checked')){
                    input_value = $(this).val();
                }
                $.ajax({
                    url : '{{ route('save_settings') }}',
                    type: "POST",
                    data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' }
                });
            });
        });
    </script>
@endsection
