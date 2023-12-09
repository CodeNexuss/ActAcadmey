@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form action="{{route('save_settings')}}" method="post"> @csrf

                <div class="form-group row">
                    <label class="col-sm-4 control-label">Zoom api key <span class="text-danger">*</span> </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="liveclass[zoom_api_key]" value="{{get_option('liveclass.zoom_api_key') }}" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site_name" class="col-sm-4 control-label"> Zoom secret key <span class="text-danger">*</span> </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="liveclass[secret_key]" value="{{get_option('liveclass.secret_key') }}" >
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
