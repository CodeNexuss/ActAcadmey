@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form id="general_settings_form" action="{{route('save_settings')}}" method="post"> @csrf


                <div class="form-group row {{ $errors->has('site_name')? 'has-error':'' }}">
                    <label for="site_name" class="col-sm-4 control-label">@lang('admin.site_name') <span style="color:red;">*</span> </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="site_name" value="{{ old('site_name')? old('site_name') : get_option('site_name') }}" name="site_name" placeholder="@lang('admin.site_name')">
                        {!! $errors->has('site_name')? '<p class="help-block">'.$errors->first('site_name').'</p>':'' !!}
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="site_name" class="col-sm-4 control-label">@lang('admin.site_url')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="{{route('home')}}" name="site_url" placeholder="@lang('admin.site_url')">
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('site_title')? 'has-error':'' }}">
                    <label for="site_title" class="col-sm-4 control-label">@lang('admin.site_title')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="site_title" value="{{ old('site_title')? old('site_title') : get_option('site_title') }}" name="site_title" placeholder="@lang('admin.site_title')">
                        {!! $errors->has('site_title')? '<p class="help-block">'.$errors->first('site_title').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('email_address')? 'has-error':'' }}">
                    <label for="email_address" class="col-sm-4 control-label">@lang('admin.email_address')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email_address" value="{{ old('email_address')? old('email_address') : get_option('email_address') }}" name="email_address" placeholder="@lang('admin.email_address')">
                        {!! $errors->has('email_address')? '<p class="help-block">'.$errors->first('email_address').'</p>':'' !!}
                        <p class="text-info"> @lang('admin.email_address_help_text')</p>
                    </div>
                </div> -->



                <div class="form-group row">
                    <label for="default_timezone" class="col-sm-4 control-label">
                        @lang('admin.default_timezone')
                    </label>
                    <div class="col-sm-8 {{ $errors->has('default_timezone')? 'has-error':'' }}">
                        <select class="form-control select2" name="default_timezone" id="default_timezone">
                            @php $saved_timezone = get_option('default_timezone'); @endphp
                            @foreach(timezone_identifiers_list() as $key=>$value)
                                <option value="{{ $value }}" {{ $saved_timezone == $value? 'selected':'' }}>{{ $value }}</option>
                            @endforeach

                        </select>


                        {!! $errors->has('default_timezone')? '<p class="help-block">'.$errors->first('default_timezone').'</p>':'' !!}
                        <p class="text-info">@lang('admin.default_timezone_help_text')</p>
                    </div>
                </div>



                <div class="form-group row {{ $errors->has('date_format')? 'has-error':'' }}">
                    <label for="email_address" class="col-sm-4 control-label">@lang('admin.date_format')</label>
                    <div class="col-sm-8">
                        <fieldset>
                            @php $saved_date_format = get_option('date_format'); @endphp

                            <label><input type="radio" value="F j, Y" name="date_format" {{ $saved_date_format == 'F j, Y'? 'checked':'' }}> {{ date('F j, Y') }}<code>F j, Y</code></label> <br />
                            <label><input type="radio" value="Y-m-d" name="date_format" {{ $saved_date_format == 'Y-m-d'? 'checked':'' }}> {{ date('Y-m-d') }}<code>Y-m-d</code></label> <br />

                            <label><input type="radio" value="m/d/Y" name="date_format" {{ $saved_date_format == 'm/d/Y'? 'checked':'' }}> {{ date('m/d/Y') }}<code>m/d/Y</code></label> <br />

                            <label><input type="radio" value="d/m/Y" name="date_format" {{ $saved_date_format == 'd/m/Y'? 'checked':'' }}> {{ date('d/m/Y') }}<code>d/m/Y</code></label> <br />

                            <label><input type="radio" value="custom" name="date_format" {{ $saved_date_format == 'custom'? 'checked':'' }}> Custom:</label>
                            <input type="text" class="form-control" value="{{ get_option('date_format_custom') }}" id="date_format_custom" name="date_format_custom" />
                            <span>example: {{ date(get_option('date_format_custom')) }}</span>
                        </fieldset>
                        <p class="text-info"> @lang('admin.date_format_help_text')</p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('time_format')? 'has-error':'' }}">
                    <label for="email_address" class="col-sm-4 control-label">@lang('admin.time_format')</label>
                    <div class="col-sm-8">
                        <fieldset>
                            <label><input type="radio" value="g:i a" name="time_format" {{ get_option('time_format') == 'g:i a'? 'checked':'' }}> {{ date('g:i a') }}<code>g:i a</code></label> <br />
                            <label><input type="radio" value="g:i A" name="time_format" {{ get_option('time_format') == 'g:i A'? 'checked':'' }}> {{ date('g:i A') }}<code>g:i A</code></label> <br />

                            <label><input type="radio" value="H:i" name="time_format" {{ get_option('time_format') == 'H:i'? 'checked':'' }}> {{ date('H:i') }}<code>H:i</code></label> <br />

                            <label><input type="radio" value="custom" name="time_format" {{ get_option('time_format') == 'custom'? 'checked':'' }}> {{__a('custom')}}:</label>
                            <input type="text" class="form-control" value="{{ get_option('time_format_custom') }}" id="time_format_custom" name="time_format_custom" />
                            <span>{{__a('example')}}: {{ date(get_option('time_format_custom')) }}</span>
                        </fieldset>
                        <p ><a class="text-info" href="http://php.net/manual/en/function.date.php" target="_blank">@lang('admin.date_time_read_more')</a> </p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('currency_sign')? 'has-error':'' }}">
                    <label for="currency_sign" class="col-sm-4 control-label">@lang('admin.currency_sign')</label>
                    <div class="col-sm-8">

                        <?php $current_currency = get_option('currency_sign'); ?>
                        <select name="currency_sign" class="form-control select2">
                            @foreach(get_currencies() as $code => $name)
                                <option value="{{ $code }}"  {{ $current_currency == $code? 'selected':'' }}> {{ $code }} </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group row {{ $errors->has('currency_position')? 'has-error':'' }}">
                    <label for="currency_position" class="col-sm-4 control-label">@lang('admin.currency_position')</label>
                    <div class="col-sm-8">
                        <?php $currency_position = get_option('currency_position'); ?>
                        <select name="currency_position" class="form-control select2">
                            <option value="left" @if($currency_position == 'left') selected="selected" @endif >@lang('admin.left')</option>
                            <option value="right" @if($currency_position == 'right') selected="selected" @endif >@lang('admin.right')</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('logo_settings')? 'has-error':'' }}">
                    <label for="email_address" class="col-sm-4 control-label">@lang('admin.logo_settings')</label>
                    <div class="col-sm-8">
                        <fieldset>
                            <label><input type="radio" value="show_site_name" name="logo_settings" {{ get_option('logo_settings') == 'show_site_name'? 'checked':'' }}> @lang('admin.show_site_name') </label> <br />
                            <label><input type="radio" value="show_image" name="logo_settings" {{ get_option('logo_settings') == 'show_image'? 'checked':'' }}> @lang('admin.show_image') </label> <br />
                        </fieldset>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('copyright_year')? 'has-error':'' }}">
                    <label for="copyright_year" class="col-sm-4 control-label">Copyright Year <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <fieldset>
                            <input type="text" class="form-control" id="copyright_year" value="{{ old('copyright_year')? old('copyright_year') : get_option('copyright_year') }}" name="copyright_year" placeholder="Copyright Year">
                            {!! $errors->has('copyright_year')? '<p class="help-block">'.$errors->first('copyright_year').'</p>':'' !!}
                        </fieldset>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('copyright_url')? 'has-error':'' }}">
                    <label for="copyright_url" class="col-sm-4 control-label">Copyright URL <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <fieldset>
                            <input type="text" class="form-control" id="copyright_url" value="{{ old('copyright_year')? old('copyright_url') : get_option('copyright_url') }}" name="copyright_url" placeholder="Copyright URL">
                            {!! $errors->has('copyright_url')? '<p class="help-block">'.$errors->first('copyright_url').'</p>':'' !!}
                        </fieldset>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('copyright_name')? 'has-error':'' }}">
                    <label for="copyright_name" class="col-sm-4 control-label">Copyright Name <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <fieldset>
                            <input type="text" class="form-control" id="copyright_name" value="{{ old('copyright_name')? old('copyright_name') : get_option('copyright_name') }}" name="copyright_name" placeholder="Copyright Name">
                            {!! $errors->has('copyright_name')? '<p class="help-block">'.$errors->first('copyright_name').'</p>':'' !!}
                        </fieldset>
                    </div>
                </div>


                <div class="form-group row {{ $errors->has('allowed_file_types')? 'has-error':'' }}">
                    <label for="allowed_file_types" class="col-sm-4 control-label">@lang('admin.allowed_file_types')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="allowed_file_types" value="{{ old('allowed_file_types')? old('allowed_file_types') : get_option('allowed_file_types') }}" name="allowed_file_types" placeholder="@lang('admin.allowed_file_types')">
                        <!-- <p class="my-2"><code>jpeg,png,jpg,pdf,zip,doc,docx,xls,ppt,pptx</code></p> -->
                        {!! $errors->has('allowed_file_types')? '<p class="help-block">'.$errors->first('allowed_file_types').'</p>':'' !!}
                    </div>
                </div>


                
                <!-- <div class="form-group row {{ $errors->has('enable_rtl')? 'has-error':'' }}">
                    <label for="enable_rtl" class="col-sm-4 control-label">{{__a('enable_rtl')}}</label>
                    <div class="col-sm-8">
                        {!! switch_field('enable_rtl', '', get_option('enable_rtl')) !!}
                    </div>
                </div> -->
                <input type="hidden" value="0" id="enable_rtl" name="enable_rtl">


                <hr />
                <div class="form-group row">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" id="general_settings_save_btn" class="btn btn-primary">@lang('admin.save_settings')</button>
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
