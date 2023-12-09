@extends(theme('dashboard.layout'))

@section('content')


    <div class="dashboard-inline-submenu-wrap mb-4 border-bottom">
        <a href="{{route('withdraw')}}" class="">{{__t('withdraw')}}</a>
        <a href="{{route('withdraw_preference')}}" class="active">{{__t('withdraw_preference')}}</a>
    </div>

    <h4 class="mb-4">{{__t('select_withdraw_method')}}</h4>


    @php
        $withdraw_methods = active_withdraw_methods();
        $saved_preference = (array) $user->get_option('withdraw_preference');
    @endphp

    <div class="withdraw-method-preference-wrap bg-white p-4">
        <form action="" method="post">

            @csrf

            <div class="withdraw-method-selection-wrap mb-4 row">
                @foreach($withdraw_methods as $method_key => $method)
                    <div class="select-withdraw-method-name col-lg-4">
                        <input type="radio" class="withdraw-method-input" id="withdraw-method-{{$method_key}}-input" name="withdraw_preference[method]" value="{{$method_key}}" {{checked($method_key, array_get($saved_preference, 'method'))}} style="display: none;">

                        <label for="withdraw-method-{{$method_key}}-input" class="withdraw-preference-method-name border border-dark w-100 p-4 mr-3" data-target="withdraw-method-{{$method_key}}-form">
                            <p class="mb-0">{{array_get($method, 'method_name')}}</p>
                            <p class="text-muted mb-0">
                                <small>{{__t('min_withdraw_amount')}}: {!! price_format(get_option("withdraw_methods.{$method_key}.min_withdraw_amount")) !!}</small>
                            </p>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="withdraw-method-preference-form-wrap">

                @foreach($withdraw_methods as $method_key => $method)

                    <div id="withdraw-method-{{$method_key}}-form" class="withdraw-method-form" style="display: {{array_get($saved_preference, 'method') == $method_key ? 'block' : 'none'}};">

                        @php
                            $notes = get_option("withdraw_methods.{$method_key}.notes");
                            $form_fields = array_get($method, 'form_fields');
                        @endphp

                        @if($notes)
                            <div class="alert alert-info">
                                {!! $notes !!}
                            </div>
                        @endif


                        @if(is_array($form_fields) && count($form_fields))
                            <div class="form-row">

                                @foreach($form_fields as $field_key => $field)
                                    <div class="col-md-6 mb-3">
                                        <label> {{array_get($field, 'label')}} <span style="color:red;">*</span> </label>

                                        @if(array_get($field, 'type') === 'text')

                                            <input type="text" class="form-control" name="withdraw_preference[{{$method_key}}][{{$field_key}}]" value="{{array_get($saved_preference, $method_key.'.'.$field_key )}}"  >

                                        @elseif(array_get($field, 'type') === 'email')

                                            <input type="email" class="form-control" name="withdraw_preference[{{$method_key}}][{{$field_key}}]" value="{{array_get($saved_preference, $method_key.'.'.$field_key )}}" >

                                        @elseif(array_get($field, 'type') === 'textarea')
                                            <textarea name="withdraw_preference[{{$method_key}}][{{$field_key}}]" class="form-control" >{{array_get($saved_preference, $method_key.'.'.$field_key )}}</textarea>
                                        @endif



                                        @if(array_get($field, 'desc'))
                                            <p class="text-muted font-italic">
                                                <small>{!! array_get($field, 'desc') !!}</small>
                                            </p>
                                        @endif

                                    </div>
                                @endforeach
                            </div>

                        @endif


                        @if(array_get($method, 'desc'))
                            <div class="withdraw-form-desc text-info font-italic">
                                {!! array_get($method, 'desc') !!}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-purple btn-lg mt-5"> <i class="la la-save"></i> {{ __t('save_withdraw_preference') }}</button>

                    </div>

                @endforeach




            </div>
        </form>


    </div>


@endsection


