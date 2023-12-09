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

            <form action="" id="installation-form" class="form-horizontal mb-5" method="post">
                @csrf
                <hr />

                <div class="form-group row {{ $errors->has('hostname')? 'has-error':'' }}">
                    <label for="hostname" class="col-sm-4 control-label">Hostname</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="hostname" name="hostname" placeholder="Hostname" value="{{ old('hostname')? old('hostname') : '127.0.0.1' }}">
                        {!! $errors->has('hostname')? '<p class="invalid-feedback">'.$errors->first('hostname').'</p>':'' !!}
                        <p class="text-muted">This is usually "127.0.0.1" <p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('dbport')? 'has-error':'' }}">
                    <label for="dbport" class="col-sm-4 control-label">Database port</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="dbport" name="dbport" placeholder="Database Port" value="{{ old('dbport')? old('dbport') : '3306' }}">
                        {!! $errors->has('dbport')? '<p class="invalid-feedback">'.$errors->first('dbport').'</p>':'' !!}
                        <p class="text-muted">In case of different, usually its "3306" <p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('username')? 'has-error':'' }}">
                    <label for="username" class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" value="{{ old('username')? old('username') : 'root' }}">
                        {!! $errors->has('username')? '<p class="invalid-feedback">'.$errors->first('username').'</p>':'' !!}
                        <p class="text-muted">Either something as "root" or a username given by the host <p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('password')? 'has-error':'' }}">
                    <label for="password" class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                        {!! $errors->has('password')? '<p class="invalid-feedback">'.$errors->first('password').'</p>':'' !!}
                        <p class="text-muted">Your database password <p>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('database_name')? 'has-error':'' }}">
                    <label for="database_name" class="col-sm-4 control-label">Database Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="database_name" name="database_name" placeholder="Database Name" value="{{ old('database_name') }}">
                        {!! $errors->has('database_name')? '<p class="invalid-feedback">'.$errors->first('database_name').'</p>':'' !!}
                        <p class="text-muted">Place a Database name to connect with database <p>
                    </div>
                </div>
                <hr />

                <button type="submit" class="btn btn-primary btn-block btn-lg">Install</button>

            </form>


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
