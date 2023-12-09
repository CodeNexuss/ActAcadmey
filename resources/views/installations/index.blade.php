<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{theme_url('favicon.png')}}"/>

    <!-- Udify Version -->
    <meta name="generator" content="Udify v.{{config('app.version')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @if(! empty($title)) {{$title}} @else {{ get_option('site_title') }} @endif</title>

    <!-- all css here -->

    <style type="text/css">
        .installations-requirements-check{
            font-size: 14px;
        }
        .installations-logo img{
            max-height: 50px; width: auto;
        }
    </style>
    <!-- bootstrap v4.3.1 css -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">


</head>
<body>



<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <div class="installations-header my-4 text-center">

                <div class="installations-logo">
                    <h4 class="mt-3 d-flex justify-content-center">
                        <img src="{{asset('assets/images/udify-logo.svg')}}" />
                        <span class="ml-3">Installations Wizard</span>
                    </h4>
                </div>
                <h5 class="text-info my-3">Server Requirements for the Udify</h5>
            </div>

            <div class="installations-requirements-check">
                @include('installations.requirements')
            </div>

            <div class="text-center mb-5">
                <a href="{{route('installations_step_two')}}" class="btn btn-primary btn-lg">Continue Installation</a>
            </div>

        </div>
    </div>
</div>





<!-- all js here -->
<!-- jquery latest version -->
<script src="{{asset('assets/js/vendor/jquery-1.12.0.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
