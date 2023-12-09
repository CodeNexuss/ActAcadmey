@extends('layouts.theme')

<!-- Main Content -->
@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8 col-12 cls_login">
            <div class="card">
                <div class="card-header text-center pt-4">
                    <h2>{{__t('reset_your_password')}}</h2>
                    <h4>{{__t('not_registered')}}<a href="{{route('register')}}"> {{__t('signup')}}</a></h4>
                </div>

                <div class="card-body">

                    @include('inc.flash_msg')

                    <form action="" class="form-horizontal" method="POST">
                        @csrf

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!-- <label for="email" class=" control-label">E-Mail Address</label> -->

                            <input id="email" type="email" class="form-control" placeholder="{{__t('email_address')}}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <div class="mt-2">
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                               
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn cls_btn btn-block btn-lg">
                                {{__t('send_pass_reset_link')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
