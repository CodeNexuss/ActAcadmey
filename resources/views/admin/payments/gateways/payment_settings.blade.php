@extends('layouts.admin')


@section('page-header-right')
    <a href="{{route('payment_gateways')}}" class="btn btn-outline-info">{{__a('payment_gateways')}}</a>
@endsection

@section('content')




    <div class="payment-settings-wrap">

        <form method="post">
            @csrf


            <div class="form-group row">
                <label for="enable_instructors_earning" class="col-sm-3 col-form-label">{{__a('inst_earnings')}}</label>
                <div class="col-sm-6">
                    {!! switch_field('enable_instructors_earning', __a('enable'), get_option('enable_instructors_earning') ) !!}
                    <p class="text-muted"> <small>{{__a('if_dis_admin_get_pay')}}</small> </p>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 col-form-label">{{__a('admin_share')}} %</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="admin_share_input" name="admin_share" placeholder="{{__a('admin_share')}} %" value="{{get_option('admin_share')}}">
                    <p class="text-muted"> <small>{{__a('admin_share_text')}} </small> </p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">{{__a('inst_share')}} %</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Instructor Share %" id="instructor_share_input" name="instructor_share" value="{{get_option('instructor_share')}}">
                    <p class="text-muted"> <small> {{__a('inst_share_text')}} </small> </p>

                    <div id="share_input_response"></div>
                </div>
            </div>

            <hr />

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">{{__a('fees')}}</label>
                <div class="col-sm-6">

                    <div class="d-flex">
                        <div>
                            {!! switch_field('enable_charge_fees', '', get_option('enable_charge_fees')) !!}
                            {{__a('enable')}}
                        </div>

                        <div>
                            <p class="mb-1 mr-2"><input type="text" class="form-control" name="charge_fees_name" value="{{get_option('charge_fees_name')}}" ></p>
                            {{__a('fees_name')}}
                        </div>
                        <div>
                            <p class="mb-1 mr-2">
                                <input type="text" class="form-control" name="charge_fees_amount" placeholder="Fees Name" value="{{get_option('charge_fees_amount')}}" >
                            </p>
                            {{__a('fees_amount')}}
                        </div>
                        <div>
                            <p class="mb-1 mr-2">
                                <select class="form-control" name="charge_fees_type">
                                    <option value="">{{__a('select_fee_type')}}</option>
                                    <option value="percent" {{selected('percent', get_option('charge_fees_type'))}} >{{__a('percent')}}</option>
                                    <option value="fixed" {{selected('fixed', get_option('charge_fees_type'))}}>{{__a('fixed')}}</option>
                                </select>
                            </p>
                            {{__a('fee_type')}}
                        </div>
                    </div>


                    <p class="text-muted my-3"> <small> {{__a('admin_additional_charge_text')}}. </small> </p>
                </div>
            </div>




            <div class="form-group row">
                <div class="offset-sm-3">
                    <button type="submit" id="settings_save_btn" class="btn btn-primary">
                        <i class="la la-save"></i> {{__a('save_settings')}}
                    </button>
                </div>
            </div>

        </form>


    </div>




@endsection



@section('page-js')
    <script>
        $(document).ready(function(){
            $('input[type="checkbox"], input[type="radio"]').click(function(){
                var input_name = $(this).attr('name');
                var input_value = 0;
                if ($(this).prop('checked')){
                    input_value = $(this).val();
                }
                $.ajax({
                    url : '{{ route('save_settings') }}',
                    type: "POST",
                    data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' },
                });
            });
        });
    </script>
@endsection
