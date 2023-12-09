@extends('layouts.theme')

@section('content')


    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="error-page-wrap text-center py-5">

                    <div class="error-page-img">
                        <img src="{{asset('assets/images/no-data404.svg')}}" class="img-fluid" />
                    </div>

                    <h3 class='no-data-title text-danger'>{{__t('404_title_text')}}</h3>
                    <h5 class='no-data-subtitle'>{{__t('404_desc_text')}}</h5>

                    @if($exception->getMessage())
                        <h3 class="mb-3">{{$exception->getMessage()}}</h3>
                    @endif

                    <div class="error-actions">
                        <a href="{{route('home')}}" class="btn btn-theme-primary btn-lg">
                            <span class="la la-home"></span> {{__t('back_to_home')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
