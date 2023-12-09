@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="la la-check-circle"></i> {!! session('success') !!}
        <button class="close" data-dismiss="alert"><i class="la la-close"></i></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="la la-info-circle"></i> {!! session('error') !!}
         <button class="close" data-dismiss="alert"><i class="la la-close"></i></button>
    </div>
@endif

@if($errors->count() > 0)
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="la la-info-circle"></i> 
        @if(request()->is('admin*'))
            {{ __a('form_error') }}
        @else
            {{ __t('form_error') }}
        @endif
         <button class="close" data-dismiss="alert"><i class="la la-close"></i></button>
    </div>
@endif

