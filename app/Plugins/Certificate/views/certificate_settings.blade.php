@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form action="{{route('save_settings')}}" method="post"> @csrf

                <div class="form-group row">
                    <label class="col-sm-4 control-label">Authorise Name <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="certificate[authorise_name]" value="{{get_option('certificate.authorise_name') }}" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site_name" class="col-sm-4 control-label"> Company Name <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="certificate[company_name]" value="{{get_option('certificate.company_name') }}" >
                    </div>
                </div>


                <div class="form-group row">
                    <label for="site_name" class="col-sm-4 control-label"> Upload Signature <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        {!! image_upload_form('certificate[signature_id]', get_option('certificate.signature_id')) !!}
                        <small class="text-info"> preferable size: w-80px X h-80px </small>
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
                    data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' },
                });
            });


            $('input[name="date_format"]').click(function(){
                $('#date_format_custom').val($(this).val());
            });
            $('input[name="time_format"]').click(function(){
                $('#time_format_custom').val($(this).val());
            });

        });
    </script>
@endsection
