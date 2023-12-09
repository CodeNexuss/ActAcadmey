
<div class="form-group row">
    <label class="col-md-4 control-label"> {{__a('enable_disable')}} </label>
    <div class="col-md-8">
        {!! switch_field('bank_gateway[enable_bank_transfer]', '', get_option('bank_gateway.enable_bank_transfer') ) !!}
    </div>
</div>

<div class="form-group row">
    <label for="bank_name" class="col-sm-4 control-label"> {{__a('bank_name')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="bank_name" value="{{ get_option('bank_gateway.bank_name') }}" placeholder="{{__a('bank_name')}}" name="bank_gateway[bank_name]">
    </div>
</div>

<div class="form-group row">
    <label for="bank_swift_code" class="col-sm-4 control-label"> {{__a('bank_swift_code')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control"  placeholder="{{__a('bank_swift_code')}}" id="bank_swift_code" value="{{ get_option('bank_gateway.bank_swift_code') }}" name="bank_gateway[bank_swift_code]">
    </div>
</div>

<div class="form-group row">
    <label for="account_number" class="col-sm-4 control-label"> {{__a('account_number')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" placeholder="{{__a('account_number')}}" id="account_number" value="{{ get_option('bank_gateway.account_number') }}" name="bank_gateway[account_number]">
    </div>
</div>

<div class="form-group row">
    <label for="branch_name" class="col-sm-4 control-label"> {{__a('branch_name')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="branch_name" placeholder="{{__a('branch_name')}}" value="{{ get_option('bank_gateway.branch_name') }}" name="bank_gateway[branch_name]">
    </div>
</div>

<div class="form-group row {{ $errors->has('branch_address')? 'has-error':'' }}">
    <label for="branch_address" class="col-sm-4 control-label"> {{__a('branch_address')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="branch_address" value="{{ get_option('bank_gateway.branch_address') }}" name="bank_gateway[branch_address]" placeholder="{{__a('branch_address')}}">
    </div>
</div>

<div class="form-group row">
    <label for="account_name" class="col-sm-4 control-label"> {{__a('account_name')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="account_name" value="{{ get_option('bank_gateway.account_name') }}" name="bank_gateway[account_name]" placeholder="{{__a('account_name')}}">
    </div>
</div>

<div class="form-group row">
    <label for="iban" class="col-sm-4 control-label"> {{__a('iban')}} </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="iban" value="{{ get_option('bank_gateway.iban') }}" name="bank_gateway[iban]">
    </div>
</div>

