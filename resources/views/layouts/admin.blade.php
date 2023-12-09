<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{get_option('enable_rtl')? 'rtl' : 'auto'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ media_file_uri(get_option('site_favicon')) }}"/>

    <!-- Udify Version -->
    <meta name="generator" content="Udify v.{{config('app.version')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @if(! empty($title)) {{$title}} @else {{ get_option('site_title') }} @endif</title>

    <!-- all css here -->

    <!-- bootstrap v4.3.1 css -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css').'?version='.time()}}">
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css').'?version='.time()}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css').'?version='.time()}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.3/css/select2.css').'?version='.time()}}">

    @yield('page-css')

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css').'?version='.time()}}">

    <script type="text/javascript">
        var pageData = @json(pageJsonData())
    </script>
    <style type="text/css">
        .dataTables_paginate {
            float: right;
        }
        .dataTables_paginate li.paginate_button {
            padding-left: 4%;
            padding-right: 4%;
        }
        label.error, p.error, span.error {
            color: red;
        }
        .hide {
            display: none;
        }
    </style>

</head>
<body class="{{get_option('enable_rtl')? 'rtl' : ''}}">


<nav class="navbar navbar-expand-lg navbar-light dashboard-top-nav">
    <!-- <div class="dashboard-top-navbar-brand">
        <a class="navbar-brand" href="{{route('home')}}">
            @php
                $logoUrl = media_file_uri(get_option('site_logo'));
            @endphp

            @if($logoUrl)
                <img src="{{media_file_uri(get_option('site_logo'))}}" alt="{{get_option('site_title')}}" />
            @else
                <img src="{{asset('assets/images/udify-logo.svg')}}" alt="{{get_option('site_title')}}" />
            @endif
        </a>
    </div> -->


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav dashboard-navbar-icons mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}" data-toggle="tooltip" data-original-title="{{__a('dashboard')}}"><i class="la la-dashboard"></i> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}" target="_blank" data-toggle="tooltip" data-original-title="{{__a('site_home')}}"><i class="la la-home"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('payments')}}" data-toggle="tooltip" data-original-title="{{__a('payments')}}">
                    <i class="la la-file-invoice-dollar"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav dashboard-user-nav ml-auto">
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle nav-user-profile">
                    {!! $auth_user->get_photo !!}
                    <span class="user-name">{{$auth_user->name}}</span>
                </a>

                <div role="menu" class="dropdown-menu">
                    <a href="{{route('profile_settings')}}" class="dropdown-item" target="_blank"><i class="la la-user"></i> {{__a('profile')}}</a>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                        <i class="la la-sign-out"></i> {{ __t('logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

    </div>


</nav>




<div class="dashboard-wrap">
    <div class="container-fluid">

        <div id="wrapper">
            @include('admin.menu')

            <div id="page-wrapper">
                @if( ! empty($title))
                    <div class="page-header px-4">
                        <h6 class="page-header-left"> @yield('title-before') {{$title}} @yield('title-after') </h6>
                        @yield('page-header-right')
                    </div>
                @endif

                <div id="admin-page-body">
                    @php
                        do_action( 'admin_notices' );
                    @endphp

                    @include('inc.flash_msg')
                    @yield('content')
                </div>
                <div class="admin-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="m-0">
                                    <span class="float-left">Copyright © {{ get_option('copyright_year') }}<a href="{{ get_option('copyright_url') ?? '' }}" target="_blank"> {{ get_option('copyright_name') }}</a>. All rights reserved.</span>
                                    <span class="float-right">Version {{config('app.version')}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- all js here -->
<!-- jquery latest version -->
<script src="{{asset('assets/js/vendor/jquery-1.12.0.min.js').'?version='.time()}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js').'?version='.time()}}"></script>
<!-- bootstrap js -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js').'?version='.time()}}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js').'?version='.time()}}"></script>
<script src="{{ asset('assets/plugins/select2-4.0.3/js/select2.min.js').'?version='.time()}}"></script>
<script src="{{ asset('assets/js/admin.js').'?version='.time()}}"></script>

<script src="{{ asset('assets/js/jquery.validate.min.js').'?version='.time()}}"></script>
<script>
    var toastr_options = {closeButton : true};
</script>
@yield('page-js')

<script src="{{ asset('assets/js/filemanager.js').'?version='.time()}}"></script>


@if(env('Live_Chat') == "true")
<script>
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/57223b859f07e97d0da57cae/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>
@endif
</body>
</html>
