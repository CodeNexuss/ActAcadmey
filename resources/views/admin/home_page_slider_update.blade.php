@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('home_page_sliders')}}" class="btn btn-secondary btn-xl mr-1" data-toggle="tooltip" title="@lang('admin.home_page_sliders')"> <i class="la la-folder-open"></i> </a>

    <button type="submit" form="form-home_page_slider" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> </button>
@endsection

@section('content')

    <form action="{{ route('home_page_slider_update') }}" id="form-home_page_slider" method="post" enctype="multipart/form-data"> @csrf
        <input type="hidden" name="id" id="id" value="{{ ($slider) ? $slider->id : '' }}">

        <div class="row">

            <div class="col-md-12">


                <div class="form-group row {{ $errors->has('name')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="name">@lang('admin.name') <em>*</em></label>
                    <div class="col-sm-7">
                        <input type="text" name="name" value="{{ ($slider) ? $slider->title : old('name') }}" placeholder="@lang('admin.name')" id="name" class="form-control">
                        {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('description')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="name">@lang('admin.description') <em>*</em></label>
                    <div class="col-sm-7">
                        <textarea name="description" placeholder="@lang('admin.description')" id="description" class="form-control">{{ ($slider) ? $slider->description : old('description') }}</textarea>
                        {!! $errors->has('description')? '<p class="help-block">'.$errors->first('description').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('image')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label">{{__a('image')}} <em>*</em></label>
                    <div class="col-sm-7">
                        @php
                            $id = ($slider && intval($slider->image) > 0) ? $slider->image : null;
                        @endphp
                        {!! image_upload_form('image', $id, [1920,422]) !!}
                        {!! $errors->has('image')? '<p class="help-block">'.$errors->first('image').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('url')? 'has-error':'' }}">
                    <label class="col-sm-3 control-label" for="url">@lang('admin.url')</label>
                    <div class="col-sm-7">
                        <input type="url" name="url" value="{{ ($slider) ? $slider->url : '' }}" placeholder="@lang('admin.url')" id="url" class="form-control">
                        {!! $errors->has('url')? '<p class="help-block">'.$errors->first('url').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('order')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="order">@lang('admin.order') <em>*</em></label>
                    <div class="col-sm-7">
                        <input type="number" name="order" value="{{ ($slider) ? $slider->order : $last_order }}" placeholder="@lang('admin.order')" id="order" class="form-control" @if($slider && $total_sliders <= 1) readonly="readonly" @endif />
                        {!! $errors->has('order')? '<p class="help-block">'.$errors->first('order').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('status')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="url">@lang('admin.status') <em>*</em></label>
                    <div class="col-sm-7">
                        <select name="status" id="status" class="form-control select2">
                            <option value="1" @if( $slider && $slider->status==1 ) selected="selected" @endif>@lang('admin.active')</option>
                            <option value="0" @if( $slider && $slider->status==0 ) selected="selected" @endif>@lang('admin.inactive')</option>
                        </select>
                        {!! $errors->has('status')? '<p class="help-block">'.$errors->first('status').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-7 offset-3">
                        <button type="submit" form="form-home_page_slider" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> {{__a('save')}} </button>

                        <a href="{{ route('home_page_sliders') }}" class="btn btn-dark btn-xl" data-toggle="tooltip" title="@lang('admin.cancel')"> <i class="la la-cancel"></i> {{__a('cancel')}} </a>
                    </div>
                </div>


            </div>

        </div>

    </form>

@endsection
