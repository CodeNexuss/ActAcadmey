@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form action="{{route('save_settings')}}" method="post"> @csrf

            <div class="form-group row">
                <label for="additional_css" class="col-sm-4 control-label">@lang('admin.company_name') </label>
                <div class="col-sm-8">

                    <input type="text" class="form-control" value="{{get_option('invoice_company_name', get_option('site_name'))}}" name="invoice_company_name" placeholder="@lang('admin.company_name')"/>

                </div>
            </div>
            <div class="form-group row">
                <label for="additional_css" class="col-sm-4 control-label">@lang('admin.phone') </label>
                <div class="col-sm-8">

                    <input type="text" class="form-control" value="{{get_option('invoice_company_phone')}}" name="invoice_company_phone" placeholder="@lang('admin.phone')" />

                </div>
            </div>
            <div class="form-group row">
                <label for="additional_css" class="col-sm-4 control-label">@lang('admin.email') </label>
                <div class="col-sm-8">

                    <input type="text" class="form-control" value="{{get_option('invoice_company_email', get_option('email_address'))}}" name="invoice_company_email" placeholder="@lang('admin.email')" />

                </div>
            </div>

            <div class="form-group row">
                <label for="additional_css" class="col-sm-4 control-label">@lang('admin.company_name') </label>
                <div class="col-sm-8">

                    <input type="text" class="form-control" value="{{get_option('invoice_company_name', get_option('site_name'))}}" name="invoice_company_name" placeholder="@lang('admin.company_name')" />

                </div>
            </div>


            <div class="form-group row">
                <label for="invoice_company_address" class="col-sm-4 control-label">@lang('admin.company_address') </label>
                <div class="col-sm-8">
                    <textarea name="invoice_company_address" class="form-control" placeholder="@lang('admin.company_address')">{{ get_option('invoice_company_address') }}</textarea>
                </div>
            </div>



            <div class="form-group row">
                <label for="additional_css" class="col-sm-4 control-label">@lang('admin.notice') </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{get_option('invoice_notice')}}" name="invoice_notice" placeholder="@lang('admin.notice')" />
                </div>
            </div>

            <div class="form-group row">
                <label for="additional_css" class="col-sm-4 control-label">@lang('admin.footer_text') </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{get_option('invoice_footer_text')}}" name="invoice_footer_text" placeholder="@lang('admin.footer_text')" />
                </div>
            </div>



            <hr />
            <div class="form-group row">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" id="settings_save_btn" class="btn btn-primary">@lang('admin.save_settings')</button>
                </div>
            </div>

            </form>

        </div>
    </div>

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

            /**
             * show or hide stripe and paypal settings wrap
             */
            $('#enable_facebook_login').click(function(){
                if ($(this).prop('checked')){
                    $('#facebook_login_api_wrap').slideDown();
                }else{
                    $('#facebook_login_api_wrap').slideUp();
                }
            });
            $('#enable_google_login').click(function(){
                if ($(this).prop('checked')){
                    $('#google_login_api_wrap').slideDown();
                }else{
                    $('#google_login_api_wrap').slideUp();
                }
            });

        });
    </script>
@endsection
