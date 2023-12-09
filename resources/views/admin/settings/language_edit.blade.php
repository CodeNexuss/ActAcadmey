@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('language_settings')}}" class="ml-1 btn btn-secondary btn-xl" data-toggle="tooltip" title="{{__a('languages')}}"> <i class="la la-folder-open"></i> </a>

    <button type="submit" form="form-language" class="ml-1 btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> </button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <form action="" id="form-language" method="post"> @csrf

                <div class="form-group row {{ $errors->has('name')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="category_name">{{__a('name')}}<em>*</em></label>
                    <div class="col-sm-7">
                        <input type="text" name="name" value="{{$language->name}}" placeholder="{{__a('name')}}" id="name" class="form-control">
                        {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('value')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="value">{{__a('value')}}<em>*</em></label>
                    <div class="col-sm-7">
                        <input type="text" name="value" value="{{$language->value}}" placeholder="{{__a('value')}}" id="value" class="form-control" readonly="readonly">
                        <small>{{__a('note')}} : <span class="text-muted">{{ __a('cant_change_lang_value') }}</span></small>
                        {!! $errors->has('value')? '<p class="help-block">'.$errors->first('value').'</p>':'' !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 control-label">@lang('admin.status')</label>
                    <div class="col-sm-7">
                        <label><input type="radio" name="status" value="1" @if($language->status == 1)checked="checked" @endif> {{__a('active')}}</label> <br />
                        <label><input type="radio" name="status" value="0"  @if($language->status == 0)checked="checked" @endif> {{__a('inactive')}}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">{{__a('default')}}</label>
                    <div class="col-sm-7">
                        <label><input type="radio" name="default_language" value="1" @if($language->default_language == 1)checked="checked" @endif> {{__a('yes')}}</label> <br />
                        <label><input type="radio" name="default_language" value="0"  @if($language->default_language == 0)checked="checked" @endif> {{__a('no')}}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-7 offset-3">
                        <button type="submit" form="form-language" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> {{__a('save')}} </button>
                    </div>
                </div>

            </form>


        </div>


    </div>



@endsection
