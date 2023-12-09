@extends('layouts.theme')

<!-- Main Content -->
@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 offset-md-3 cls_login">
            <div class="card ">

                <div class="card-body p-5">

                    <h2 class="mb-4 reset_pass_title">{{__t('reset_your_password')}}</h2>

                    @include('inc.flash_msg')

                    <form action="" class="form-horizontal" method="post">
                        @csrf

                        <div class="form-group {{ $errors->has('password')? 'has-error':'' }} ">
                            <!-- <label class="control-label">{{__t('password')}}</label> -->

                            <input type="password" name="password" id="password" class="form-control"  value="{{ old('password') }}" placeholder="{{__t('password')}}">
                            {!! $errors->has('password')? '<p class="help-block">'.$errors->first('password').'</p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation')? 'has-error':'' }} ">
                            <!-- <label class="control-label">{{__t('confirm_password')}}</label> -->

                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  value="{{ old('password_confirmation') }}" placeholder="{{__t('confirm_password')}}">
                            {!! $errors->has('password_confirmation')? '<p class="help-block">'.$errors->first('password_confirmation').'</p>':'' !!}
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn cls_btn mt-2"><i class="la la-unlock"></i> {{__t('reset_password')}}</button>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>
</div>

@endsection
