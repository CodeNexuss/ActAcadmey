@php($hasGateways = get_option('enable_stripe') || get_option('enable_paypal') || get_option('enable_telebirr') || get_option('bank_gateway.enable_bank_transfer') || get_option('enable_offline_payment'))

@if($hasGateways)
    <div class="section-payment-methods-wrap">
        <h4>{{__t('payment_information')}}</h4>

        <p class="text-muted"> <i class="la la-lock"></i> {{__t('payment_secure_text')}}</p>

        <div class="checkout-section checkout-payment-methods-wrap bg-white p-4 mt-3">

            <ul class="nav cls_payment_view nav-pills mb-3" role="tablist">

                <?php do_action('checkout_available_gateways_nav_before', $cart); ?>


                @if(get_option('enable_stripe'))
                    <li class="nav-item mr-lg-3 mr-0 mb-3 mb-lg-0">
                        <a class="nav-link active" data-toggle="pill" href="#payment-tab-card">
                            <i class="la la-credit-card"></i> {{__t('credit_card')}}
                        </a>
                    </li>
                @endif

                @if(get_option('enable_paypal'))
                    <li class="nav-item mr-lg-3 mr-0 mb-3 mb-lg-0">
                        <a class="nav-link" data-toggle="pill" href="#payment-tab-paypal">
                            <i class="la la-paypal"></i> {{__t('paypal')}}
                        </a>
                    </li>
                @endif

                 @if(get_option('enable_telebirr'))
                    <li class="nav-item mr-lg-3 mr-0 mb-3 mb-lg-0">
                        <a class="nav-link" data-toggle="pill" href="#payment-tab-telebirr">
                            <i class="la la-paypal"></i> {{__t('telebirr')}}
                        </a>
                    </li>
                @endif

                @if(get_option('bank_gateway.enable_bank_transfer'))
                    <li class="nav-item mr-lg-3 mr-0 mb-3 mb-lg-0">
                        <a class="nav-link" data-toggle="pill" href="#payment-tab-bank">
                            <i class="la la-university"></i>  {{__t('bank_transfer')}}
                        </a>
                    </li>
                @endif


                @if(get_option('enable_offline_payment'))
                    <li class="nav-item mr-lg-3 mr-0 mb-3 mb-lg-0">
                        <a class="nav-link" data-toggle="pill" href="#payment-tab-offline">
                            <i class="la la-wallet"></i>  {{__t('offline_payment')}}
                        </a>
                    </li>
                @endif

                <?php do_action('checkout_available_gateways_nav_after', $cart); ?>

            </ul>



            <div class="tab-content">

                <?php do_action('checkout_available_gateways_tab_content_before', $cart); ?>

                @if(get_option('enable_stripe'))
                    <div class="tab-pane fade show active" id="payment-tab-card">
                        <div class="stripe-credit-card-form-wrap mr-auto py-5 text-center">
                            <form action="/charge" method="post" id="payment-form">
                                <div class="form-group">
                                    <label for="card-element"> {{__t('pay_with_credit_or_debit')}}</label>
                                    <div id="card-element" class="form-control">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" class="text-danger mb-3" role="alert"></div>

                                <button type="submit" class="btn cls_gray_btn" id="stripe-payment-form-btn">
                                    <span class="enroll-course-btn-text mr-lg-4 mr-2 border-right pr-0 pr-lg-4">{{__t('enroll_in_course')}}</span>
                                    <span class="enroll-course-btn-price">{!! price_format($cart->total_amount) !!}</span>
                                </button>
                            </form>
                        </div>
                    </div> <!-- tab-pane.// -->
                @endif

                {{-- @if(get_option('enable_paypal'))
                    <div class="tab-pane fade" id="payment-tab-paypal">

                        <div class="paypal-payment-form-wrap py-5 text-left">

                            <form action="{{route('paypal_redirect')}}" method="post">
                                @csrf
                                <p>
                                    <button type="submit" class="btn cls_gray_btn btn-lg" id="paypal-payment-form-btn">
                                        <span class="enroll-course-btn-text mr-lg-4 mr-2 border-right pr-0 pr-lg-4">
                                            <i class="la la-paypal"></i> {{__t('pay_with_paypal')}}
                                        </span>
                                        <span class="enroll-course-btn-price">
                                            {!! price_format($cart->total_amount) !!}
                                        </span>
                                    </button>
                                </p>
                            </form>

                        </div>

                    </div>
                @endif --}}

                /**
                *telebirr option
                */

                 @if(get_option('enable_telebirr'))
                    <div class="tab-pane fade" id="payment-tab-telebirr">

                        <div class="paypal-payment-form-wrap py-5 text-left">

                            <form action="{{route('telebirr_redirect')}}" method="post">
                                @csrf
                                <p>
                                    <button type="submit" class="btn cls_gray_btn btn-lg" id="paypal-payment-form-btn">
                                        <span class="enroll-course-btn-text mr-lg-4 mr-2 border-right pr-0 pr-lg-4">
                                            <i class="la la-paypal"></i> {{__t('pay_with_telebirr')}}
                                        </span>
                                        <span class="enroll-course-btn-price">
                                            {!! price_format($cart->total_amount) !!}
                                        </span>
                                    </button>
                                </p>
                            </form>

                        </div>

                    </div>
                @endif

                @if(get_option('bank_gateway.enable_bank_transfer'))
                    <div class="tab-pane fade" id="payment-tab-bank">
                        @include(theme('template-part.gateways.bank-transfer'))
                    </div> <!-- tab-pane.// -->
                @endif

                @if(get_option('enable_offline_payment'))

                    <div class="tab-pane fade" id="payment-tab-offline">
                        <div class="offline-payment-form-wrap pt-2 pb-5">

                            <form action="{{route('pay_offline')}}" method="post">
                                @csrf

                                <div class="form-group">

                                    <label>{{__t('write_about_ur_pay_method')}} </label>

                                    <textarea class="form-control" name="payment_note"></textarea>
                                    <p class="text-muted">
                                        <small>
                                            {{__t('write_about_ur_pay_method_desc')}}
                                        </small>
                                    </p>

                                </div>


                                <p>
                                    <button type="submit" class="btn cls_gray_btn btn-lg" id="offline-payment-form-btn">
                                        <span class="enroll-course-btn-text mr-lg-4 mr-2 border-right pr-0 pr-lg-4">
                                            <i class="la la-wallet"></i> {{__t('pay_with_offline')}}
                                        </span>
                                        <span class="enroll-course-btn-price">
                                            {!! price_format($cart->total_amount) !!}
                                        </span>
                                    </button>
                                </p>
                            </form>

                        </div>

                    </div>
                @endif

                <?php do_action('checkout_available_gateways_tab_content_after', $cart); ?>


            </div> <!-- tab-content .// -->

        </div>
    </div>

@else
    <div class="alert alert-warning">
        <i class="la la-exclamation-circle"></i> {{__t('no_payment_gateways_available')}}
    </div>
@endif
