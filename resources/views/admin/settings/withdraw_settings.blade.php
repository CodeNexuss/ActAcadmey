@extends('layouts.admin')

@section('content')

    @php
        $withdraw_methods = withdraw_methods();
    @endphp

    <form action="{{route('save_settings')}}" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf

        <ul class="nav nav-tabs mb-5" id="pills-tab" role="tablist">

            @foreach($withdraw_methods as $method_key => $method)
                <li class="nav-item">
                    <a class="nav-link {{$loop->first ? 'active' : ''}}" id="{{$method_key}}-tab" data-toggle="pill" href="#{{$method_key}}-content">
                        {{array_get($method, 'method_name')}}
                    </a>
                </li>
            @endforeach

        </ul>

        <div class="tab-content" id="payment-settings-tab-wrap">


            @foreach($withdraw_methods as $method_key => $method)
                <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="{{$method_key}}-content">

                    <div class="form-group row">
                        <label class="col-md-4 control-label"> {{__a('enable_disable')}} </label>
                        <div class="col-md-8">
                            {!! switch_field("withdraw_methods[{$method_key}][enable]", '', get_option("withdraw_methods.{$method_key}.enable") ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 control-label"> {{__a('min_withdraw_amount')}} </label>
                        <div class="col-md-6">

                            <input type="number" class="form-control" name="withdraw_methods[{{$method_key}}][min_withdraw_amount]" value="{{get_option("withdraw_methods.{$method_key}.min_withdraw_amount")}}"  placeholder=" {{__a('min_withdraw_amount')}} " />

                        </div>
                    </div>

                    @php
                        $form_fields = array_get($method, 'admin_form_fields');
                    @endphp


                    @if(is_array($form_fields) && count($form_fields))
                        @foreach($form_fields as $field_key => $field)

                            <div class="form-group row">
                                <label class="col-md-4 control-label"> {{array_get($field, 'label')}} </label>
                                <div class="col-md-6">

                                    @if(array_get($field, 'type') === 'textarea')
                                        <textarea name="withdraw_methods[{{$method_key}}][{{$field_key}}]" class="form-control" >{{get_option("withdraw_methods.{$method_key}.{$field_key}")}}</textarea>
                                    @endif

                                    @if(array_get($field, 'desc'))
                                        <p class="text-muted">
                                            <small>{!! array_get($field, 'desc') !!}</small>
                                        </p>
                                    @endif

                                </div>
                            </div>

                        @endforeach
                    @endif


                </div>
            @endforeach


        </div>


        <hr />

        <div class="form-group row">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" id="settings_save_btn" class="btn btn-primary">
                    {{__a('save_settings')}}
                </button>
            </div>
        </div>

    </form>

@endsection
