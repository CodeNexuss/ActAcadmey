@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form id="general_settings_form" action="{{route('save_settings')}}" method="post"> @csrf


                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">Facebook</label>
                    <div class="col-sm-8">
                        <input type="url" class="form-control" value="{{ old('facebook_joinus_link') ? old('facebook_joinus_link') : get_option('facebook_joinus_link') }}" name="facebook_joinus_link" id="facebook_joinus_link" placeholder="Facebook Join Us Link">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">Twitter</label>
                    <div class="col-sm-8">
                        <input type="url" class="form-control" value="{{ old('twitter_joinus_link') ? old('twitter_joinus_link') : get_option('twitter_joinus_link') }}" name="twitter_joinus_link" id="twitter_joinus_link" placeholder="Twitter Join Us Link">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">Youtube</label>
                    <div class="col-sm-8">
                        <input type="url" class="form-control" value="{{ old('youtube_joinus_link') ? old('youtube_joinus_link') : get_option('youtube_joinus_link') }}" name="youtube_joinus_link" id="youtube_joinus_link" placeholder="Youtube Join Us Link">
                    </div>
                </div>

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

