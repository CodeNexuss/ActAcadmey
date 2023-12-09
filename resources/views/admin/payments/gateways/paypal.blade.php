
<div class="form-group row">
    <label class="col-md-4 control-label">{{__a('enable_disable')}} </label>
    <div class="col-md-8">
        {!! switch_field('enable_paypal', __a('enable_paypal'), get_option('enable_paypal') ) !!}
    </div>
</div>


<div class="form-group row {{ $errors->has('enable_paypal_sandbox')? 'has-error':'' }}">
    <label class="col-md-4 control-label">{{__a('enable_paypal_sandbox')}} </label>
    <div class="col-md-8">
        {!! switch_field('enable_paypal_sandbox', '', get_option('enable_paypal_sandbox') ) !!}
    </div>
</div>

<div class="form-group row">
    <label for="paypal_receiver_email" class="col-sm-4 control-label">{{__a('paypal_receiver_email')}}</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="paypal_receiver_email" value="{{ get_option('paypal_receiver_email')}}" name="paypal_receiver_email" placeholder="{{__a('paypal_receiver_email')}}">

        <p class="text-info">{{__a('paypal_receiver_email_help_text')}}</p>
    </div>
</div>
