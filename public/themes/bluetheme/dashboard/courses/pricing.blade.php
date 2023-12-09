@extends(theme('dashboard.layout'))


@section('content')

    @include(theme('dashboard.courses.course_nav'))

    <form action="" method="post">
        @csrf

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="course-pricing-selection-wrap">

                    <div class="course-price-type-wrap d-flex justify-content-center bg-white border py-3 mb-5">

                        <label class="mr-5">
                            <input type="radio" name="price_plan" value="free" {{checked($course->price_plan, 'free')}} >
                            <span>
                                <img src="{{asset('assets/images/free.svg')}}" />
                                <strong>{{__t('free')}}</strong>
                            </span>
                        </label>

                        <label>
                            <input type="radio" name="price_plan" value="paid" {{checked($course->price_plan, 'paid')}}>
                            <span>
                                <img src="{{asset('assets/images/paid.svg')}}" />
                                <strong>{{__t('paid')}}</strong>
                            </span>
                        </label>

                    </div>

                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div id="course-pricing-form-wrap" class="text-center">


                    <div class="course-pricing-wrap price_plan_free text-center" id="course-free-pricing-wrap" style="display: {{$course->price_plan == 'free' || old('price_plan') == 'free' ? 'block' : 'none'}};" >


                        <div class="form-group row">
                            <div class="col-md-10">
                                <label for="price" class="col-form-label text-md-right">{{__t('require_login')}}</label>
                                <label class="switch ml-3" style="vertical-align:text-top;">
                                    <input type="checkbox" name="require_login" value="1" {{checked(1, $course->require_login)}} >
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                            <label for="price" class="col-form-label text-md-right">{{__t('require_enroll')}}</label>
                                <label class="switch ml-3" style="vertical-align:text-top;">
                                    <input type="checkbox" name="require_enroll" value="1" {{checked(1, $course->require_enroll)}} >
                                    <span></span>
                                </label>
                            </div>
                        </div>


                        <div class="text-muted my-4">
                            {{__t('course_pricing_sub_text')}}
                        </div>


                    </div>


                    <div class="course-pricing-wrap price_plan_paid paid-input" id="course-onetime-pricing-wrap" style="display: {{$course->price_plan == 'paid' || old('price_plan') == 'paid' ? 'block' : 'none'}};" >

                        <div class="form-group row {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-sm-4 col-form-label text-md-right">{{__t('regular_price')}}</label>

                            <div class="col-md-6">
                                <div class="input-group border border-dark mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{!! get_currency_symbol() !!}</span>
                                    </div>
                                    <input type="text" id="price" class="border-0 form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $course->price }}">
                                </div>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('sale_price') ? ' has-error' : '' }}">
                            <label for="sale_price" class="col-sm-4 col-form-label text-md-right">{{__t('sale_price')}}</label>

                            <div class="col-md-6">

                                <div class="input-group mb-3 border border-dark">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{!! get_currency_symbol() !!}</span>
                                    </div>
                                    <input type="text" id="sale_price" class="border-0 form-control{{ $errors->has('sale_price') ? ' is-invalid' : '' }}" name="sale_price" value="{{ $course->sale_price }}">
                                </div>

                                @if ($errors->has('sale_price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sale_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-info">{{__t('set_pricing')}}</button>

                </div>

            </div>
        </div>

    </form>

@endsection
