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

    <!-- bootstrap v4.3.1 css -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">

    <style type="text/css">
        .invalid-feedback{
            display: block;
        }
        .has-error{
            border: 1px solid #ff7274;
            padding-top: 20px;
        }
        .installation-success-text{
            font-size: 18px;
        }
        .installation-success-icon{
            font-size: 40px; line-height: 1;
        }
        .installations-logo img{
            max-height: 50px; width: auto;
        }
    </style>


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

            </div>


            @include('inc.flash_msg')


            <div class="alert alert-success d-flex">
                <span class="installation-success-icon mr-3">
                    <i class="la la-check-circle"></i>
                </span>
                <div>

                    <h2>Installations Done</h2>
                    <p class="installation-success-text">Installations has been successfully finished, Your LMS is now ready to use.</p>
                </div>
            </div>

            <a href="{{route('home')}}" class="btn btn-success">
                <i class="la la-check-circle"></i> Go Home
            </a>
            <a href="{{route('login')}}" class="btn btn-info">
                <i class="la la-sign-in"></i> Log In
            </a>

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
