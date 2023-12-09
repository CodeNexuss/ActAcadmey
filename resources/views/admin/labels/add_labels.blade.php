@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('manage_labels')}}" class="btn btn-secondary btn-xl mr-1" data-toggle="tooltip" title="Manage Labels"> <i class="la la-folder-open"></i> </a>
@endsection

@section('content')

    <form action="{{route('add_labels')}}" id="form-label" method="post"> @csrf

        <div class="row">
            <div class="col-md-12">

                <div class="form-row shadow-sm p-3 mb-3">
                    <div class="form-group col-md-6">
                        <label>Label Name <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="label_name" placeholder="Label Name" value="{{ old('label_name') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Number of Sales</label>
                        <input type="number" class="form-control" name="number_of_sales" placeholder="Number of Sales" value="{{ old('number_of_sales') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Minimum Average Ratings</label>
                        <input type="number" class="form-control" name="min_avg_ratings" placeholder="Minimum Average Ratings" value="{{ old('min_avg_ratings') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Number of Recent Days</label>
                        <input type="number" class="form-control" name="number_of_recent_days" placeholder="Number of Recent Days" value="{{ old('number_of_recent_days') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Minimum Ratings Count</label>
                        <input type="number" class="form-control" name="min_ratings_count" placeholder="Minimum Ratings Count" value="{{ old('min_ratings_count') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Number of days from Arrived</label>
                        <input type="number" class="form-control" name="number_of_days_from_arrived" placeholder="Number of days from Arrived" value="{{ old('number_of_days_from_arrived') }}">
                    </div>
                    <div class="form-group col-md-6 @if($errors->first('order')) has-error @endif">
                        <label>Order <em class="text-danger">*</em></label>
                        <input type="number" class="form-control" name="order" placeholder="Order" value="{{ old('order') }}">
                        @if($errors->first('order')) <p class="text-danger">{{ $errors->first('order') }}</p> @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Label Color <em class="text-danger">*</em></label>
                        <input type="color" class="form-control" name="label_color" value="{{ old('label_color') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <button type="submit" form="form-label" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> {{__a('save')}} </button>

                            <a href="{{ route('manage_labels') }}" class="btn btn-dark btn-xl" data-toggle="tooltip" title="@lang('admin.cancel')"> <i class="la la-save"></i> {{__a('cancel')}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection

@section('page-js')
    <script type="text/javascript">
        $(function(){

            

        });
    </script>
@endsection
