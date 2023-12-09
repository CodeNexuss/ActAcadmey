@extends('layouts.theme')

@section('content')

    <div class="payment-thankyou-wrap bg-light-sky">

        <div class="container">

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="payment-thankyou-wrap text-center py-5">
                        <img src="{{theme_url('images/payment-success.svg')}}" class="img-fluid" />

                        <h1 class="my-4" style="color: #5022C3"> <i class="la la-check-circle"></i> {{__t('thank_you')}}</h1>
                        <div class="thankyou-payment-text-details my-4">
                            {{__t('payment_receive_successfully')}}
                        </div>
                        <div class="error-actions">
                            <a href="{{route('home')}}" class="btn btn-purple btn-lg">
                                <span class="la la-home"></span>
                                {{__t('take_me_home')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
