<div id="checkoutBankPaymentWrap">

    <p>{{__t('bank_acc_details')}}</p>

    <div class="row">
        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('bank')}}: </dt>
            <dd> {{get_option('bank_gateway.bank_name') }}</dd>
        </dl>
        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('account_number')}}: </dt>
            <dd> {{get_option('bank_gateway.account_number') }} </dd>
        </dl>
        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('branch_name')}}:</dt>
            <dd>{{get_option('bank_gateway.branch_name') }}</dd>
        </dl>

        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('branch_address')}}:</dt>
            <dd>{{get_option('bank_gateway.branch_address') }}</dd>
        </dl>

        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('account_name')}}:</dt>
            <dd>{{get_option('bank_gateway.account_name') }}</dd>
        </dl>

        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('iban')}}: </dt>
            <dd> {{get_option('bank_gateway.iban') }}</dd>
        </dl>

        <dl class="param mb-2 col-sm-6">
            <dt>{{__t('bank_swift_code')}}: </dt>
            <dd> {{get_option('bank_gateway.bank_swift_code') }}</dd>
        </dl>
    </div>

    <div class="bank-payment-instruction-wrap mt-2 mb-3 p-4">
        <p><strong>{{__t('note')}}:</strong> {{__t('write_about_bank_info_text')}} </p>
        <h5 class="text-muted">{{__t('bank_payment_instruction')}}</h5>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form action="{{route('bank_transfer_submit')}}" id="bankTransferForm" class="form-horizontal cls_form_view" method="post" enctype="multipart/form-data" > @csrf

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bank_swift_code"> {{__t('bank_swift_code')}} </label>
                            <input type="text" class="form-control" id="bank_swift_code" value="{{ old('bank_swift_code') }}" name="bank_swift_code">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_number"> {{__t('account_number')}} </label>
                            <input type="text" class="form-control" id="account_number" value="{{ old('account_number') }}" name="account_number">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="branch_name"> {{__t('branch_name')}} </label>
                            <input type="text" class="form-control" id="branch_name" value="{{ old('branch_name') }}" name="branch_name" >

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="branch_address"> {{__t('branch_address')}} </label>
                            <input type="text" class="form-control" id="branch_address" value="{{ old('branch_address') }}" name="branch_address">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_name" >{{__t('account_name')}} </label>

                            <input type="text" class="form-control" id="account_name" value="{{ old('account_name') }}" name="account_name">

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iban" >{{__t('iban')}}</label>
                            <input type="text" class="form-control" id="iban" value="{{ old('iban') }}" name="iban">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn cls_gray_btn btn-lg" id="bank-payment-form-btn">
                        <span class="enroll-course-btn-text mr-4 border-right pr-4">I paid</span>
                        <span class="enroll-course-btn-price">{!! price_format($cart->total_amount) !!}</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>


