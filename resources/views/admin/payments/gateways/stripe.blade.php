
<div class="form-group row">
    <label class="col-md-4 control-label">{{__a('enable_disable')}} </label>
    <div class="col-md-6">
        {!! switch_field('enable_stripe', '', get_option('enable_stripe') ) !!}
    </div>
</div>


<div class="form-group row">
    <label class="col-md-4 control-label">{{__a('test_mode')}} </label>
    <div class="col-md-6">
        {!! switch_field('stripe_test_mode', '', get_option('stripe_test_mode') ) !!}
    </div>
</div>


<div class="form-group row">
    <label for="stripe_test_secret_key" class="col-sm-4 control-label">
        {{__a('test_secret_key')}} 
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stripe_test_secret_key" value="{{get_option('stripe_test_secret_key')}}" name="stripe_test_secret_key" placeholder="{{__a('test_secret_key')}}">
    </div>
</div>


<div class="form-group row">
    <label for="stripe_test_publishable_key" class="col-sm-4 control-label">
        {{__a('test_publishable_key')}} 
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stripe_test_publishable_key" value="{{get_option('stripe_test_publishable_key')}}" name="stripe_test_publishable_key" placeholder="{{__a('test_publishable_key')}}">

    </div>
</div>

<div class="form-group row">
    <label for="stripe_live_secret_key" class="col-sm-4 control-label">
        {{__a('live_secret_key')}} 
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stripe_live_secret_key" value="{{ get_option('stripe_live_secret_key')}}" name="stripe_live_secret_key" placeholder="{{__a('live_secret_key')}}">

    </div>
</div>

<div class="form-group row">
    <label for="stripe_live_publishable_key" class="col-sm-4 control-label">
        {{__a('live_publishable_key')}} 
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="stripe_live_publishable_key" value="{{get_option('stripe_live_publishable_key')}}" name="stripe_live_publishable_key" placeholder="{{__a('live_publishable_key')}}">
    </div>
</div>
