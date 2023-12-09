@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form id="theme_settings_form" action="{{route('save_settings')}}" method="post"> @csrf

                @php
                    $pages = get_pages();
                @endphp

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">@lang('admin.logo') </label>
                    <div class="col-sm-8">
                        {!! image_upload_form('site_logo', get_option('site_logo')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">Favicon <em class="text-danger">*</em></label>
                    <div class="col-sm-8">
                        {!! image_upload_form('site_favicon', get_option('site_favicon'), [16, 16], true) !!}
                        <p class="text-danger invalid-img-error hide">Please upload a valid image file</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">Email Logo <em class="text-danger">*</em></label>
                    <div class="col-sm-8">
                        {!! image_upload_form('site_email_logo', get_option('site_email_logo'), [123, 55], true) !!}
                        <p class="text-danger invalid-img-error hide">Please upload a valid image file</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">{!! __a('about_us_page') !!} </label>
                    <div class="col-sm-8">

                        <select name="about_us_page" class="form-control">
                            <option value="">{{__a('select_page')}}</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{selected($page->id, get_option('about_us_page'))}} >{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">{!! __a('privacy_policy_page') !!} </label>
                    <div class="col-sm-8">
                        <select name="privacy_policy_page" class="form-control">
                            <option value="">{{__a('select_page')}}</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{selected($page->id, get_option('privacy_policy_page'))}} >{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">{!! __a('terms_of_use_page') !!} </label>
                    <div class="col-sm-8">
                        <select name="terms_of_use_page" class="form-control">
                            <option value="">{{__a('select_page')}}</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{selected($page->id, get_option('terms_of_use_page'))}} >{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <legend class="my-4">@lang('admin.cookie_settings')</legend>

                <div class="form-group row {{ $errors->has('enable_cookie_alert')? 'has-error':'' }}">
                    <label class="col-md-4 control-label">@lang('admin.enable_disable') </label>
                    <div class="col-md-8">
                        <label for="enable_cookie_alert" class="checkbox-inline">
                            <input type="checkbox" value="1" id="enable_cookie_alert" name="cookie_alert[enable]" {{checked(1, get_option('cookie_alert.enable'))}} placeholder="@lang('admin.enable_disable')">
                            @lang('admin.enable_cookie_alert')
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cookie_message" class="col-sm-4 control-label">@lang('admin.cookie_message')</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="cookie_message" name="cookie_alert[message]" rows="6">{!! get_option('cookie_alert.message') !!}</textarea>
                        <p class="text-muted my-3"> <small>{{__a('variable')}} <code>{privacy_policy_url}</code> {{__a('will_print_pp_link')}}</small> </p>
                    </div>
                </div>

                <legend class="my-4">Footer Settings</legend>

                <div class="form-group row">
                    <label for="about_us_content" class="col-sm-4 control-label">About Us Content <em class="text-danger">*</em></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="about_us_content" name="about_us_content" rows="3" placeholder="About Us Content">{!! get_option('about_us_content') !!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site_address" class="col-sm-4 control-label">Address <em class="text-danger">*</em></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="site_address" name="site_address" placeholder="Address">{!! get_option('site_address') !!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site_phone_number" class="col-sm-4 control-label">Phone Number <em class="text-danger">*</em></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="site_phone_number" name="site_phone_number" placeholder="Phone Number" value="{{ get_option('site_phone_number') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="site_email" class="col-sm-4 control-label">Email <em class="text-danger">*</em></label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="site_email" name="site_email" placeholder="Email" value="{{ get_option('site_email') }}" />
                    </div>
                </div>


                <hr />
                <div class="form-group row">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" id="theme_settings_save_btn" class="btn btn-primary">@lang('admin.save_settings')</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection
