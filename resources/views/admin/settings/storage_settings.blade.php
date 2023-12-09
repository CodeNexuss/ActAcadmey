@extends('layouts.admin')

@section('content')

    <form action="{{route('save_settings')}}" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf
        <div class="form-group {{ $errors->has('default_storage')? 'has-error':'' }}">
            <label for="default_storage" class="col-sm-4 control-label">@lang('admin.default_storage')</label>
            <div class="col-sm-8">
                <label>
                    <input type="radio" name="default_storage" value="public" {{ get_option('default_storage') == 'public'? 'checked' :'' }} /> @lang('admin.local_server') <small class="text-info"> (@lang('admin.local_server_help_text')) </small>
                </label> <br />
                <label>
                    <input type="radio" name="default_storage" value="s3" {{ get_option('default_storage') == 's3'? 'checked' :'' }} /> @lang('admin.amazon_s3') <small class="text-info"> (@lang('admin.amazon_s3_help_text')) </small>
                </label>

            </div>
        </div>


        <div class="amazon_s3_settings_wrap" style="display: {{ get_option('default_storage') == 's3' ? 'block':'none' }};">

            <hr />
            <div class="form-group">
                <label for="amazon_key" class="col-sm-4 control-label">@lang('admin.amazon_key')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="amazon_key" value="{{ get_option('amazon_key') }}" name="amazon_key" placeholder="@lang('admin.amazon_key')" placeholder="@lang('admin.amazon_key')">
                </div>
            </div>

            <div class="form-group">
                <label for="amazon_secret" class="col-sm-4 control-label">@lang('admin.amazon_secret')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="amazon_secret" value="{{ get_option('amazon_secret') }}" name="amazon_secret" placeholder="@lang('admin.amazon_secret')" >
                </div>
            </div>

            <div class="form-group">
                <label for="amazon_region" class="col-sm-4 control-label">@lang('admin.amazon_region')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="amazon_region" value="{{ get_option('amazon_region') }}" name="amazon_region" placeholder="@lang('admin.amazon_region')">
                    <a href="http://docs.aws.amazon.com/general/latest/gr/rande.html" target="_blank">@lang('admin.amazon_region_help')</a>
                </div>
            </div>

            <div class="form-group">
                <label for="bucket" class="col-sm-4 control-label">@lang('admin.bucket')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="bucket" value="{{ get_option('bucket') }}" name="bucket" placeholder="@lang('admin.bucket')">
                </div>
            </div>


        </div>


        <hr />

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" id="settings_save_btn" class="btn btn-primary">@lang('admin.save_settings')</button>
            </div>
        </div>

    </form>

@endsection


@section('page-js')
    <script>
        $(document).ready(function(){

            // $('input[type="checkbox"], input[type="radio"]').click(function(){
            //     var input_name = $(this).attr('name');
            //     var input_value = 0;
            //     if ($(this).prop('checked')){
            //         input_value = $(this).val();
            //     }
            //     $.ajax({
            //         url : '{{ route('save_settings') }}',
            //         type: "POST",
            //         data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' },
            //         success : function (data) {
            //             if (data.success == 1){
            //                 toastr.success(data.msg, '@lang('admin.success')', toastr_options);
            //             }else {
            //                 toastr.warning(data.msg, '@lang('admin.failed')', toastr_options);
            //             }
            //             this_btn.removeAttr('disabled');
            //         }
            //     });
            // });


            $('input[name="default_storage"]').click(function(){
                var default_storage = $(this).val();

                if (default_storage == 's3'){
                    $('.amazon_s3_settings_wrap').slideDown('slow');
                } else {
                    $('.amazon_s3_settings_wrap').slideUp();
                }
            });

            /**
             * Send settings option value to server
             */
            // $('#settings_save_btn').click(function(e){
            //     e.preventDefault();

            //     var this_btn = $(this);
            //     this_btn.attr('disabled', 'disabled');

            //     var form_data = this_btn.closest('form').serialize();
            //     $.ajax({
            //         url : '{{ route('save_settings') }}',
            //         type: "POST",
            //         data: form_data,
            //         success : function (data) {
            //             if (data.success == 1){
            //                 toastr.success(data.msg, '@lang('admin.success')', toastr_options);
            //             }else {
            //                 toastr.warning(data.msg, '@lang('admin.error')', toastr_options);
            //             }
            //             this_btn.removeAttr('disabled');
            //         }
            //     });
            // });

        });
    </script>
@endsection
