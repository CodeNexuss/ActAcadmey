@extends(theme('layout-full'))
@php
    $option = (array) array_get(json_decode($course->video_src, true), 'live_class');
    $schedule = array_get($option, 'schedule');
    $note = array_get($option, 'note_to_student');
    $force_join = (bool) request('force_join');
@endphp

@section('content')
    <nav id="nav-tool" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header" style="padding: 0px !important;">
                <a class="navbar-brand" href="{{$course->continue_url}}">
                    @php
                        $logoUrl = media_file_uri(get_option('site_logo'));
                    @endphp

                    @if($logoUrl)
                        <img src="{{media_file_uri(get_option('site_logo'))}}" alt="{{get_option('site_title')}}" />
                    @else
                        <img src="{{asset('assets/images/udify-logo.svg')}}" alt="{{get_option('site_title')}}" />
                    @endif

                    Live Class: {{$course->title}}
                </a>

            </div>
            <div id="navbar">
                <form class="navbar-form navbar-right" id="meeting_form">
                    <div class="form-group">
                        <button type="button" class="btn btn-info" onclick="stop_zoom()">
                            <svg style="height:20px; vertical-align: middle;" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-3x"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path></svg>
                        </button>
                    </div>
                </form>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>




    @if($schedule && strtotime($schedule) > time() )

        <div class="container" style="margin-top: 80px;">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="live-class-schedule-wrap mt-5">

                        <h3> <i class="la la-calendar-check-o"></i> Live Class Schedule</h3>

                        <h5 class="mt-5">Live Class will be start at <strong>{{date(date_time_format(), strtotime($schedule))}}</strong></h5>

                        @if($note)
                        <div class="alert alert-info mt-2">
                            {!! clean_html($note) !!}
                        </div>
                        @endif

                        <p id="count_down" class="my-5"></p>


                        <a href="{{route('live_class_stream', [$course->slug, 'force_join' => true])}}" class="btn btn-primary btn-lg"> <i class="la la-calendar-check-o"></i> Join Live Class Now</a>

                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection



@section('page-css')
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/react-select.css"/>

    <style type="text/css">
        .navbar-brand img{
            height: 25px;
            width: auto;
        }
        #count_down{
            font-size: 25px;
            text-align: center;
            border: 1px solid #eeeeee;
            padding: 20px;
        }
    </style>
@endsection

@if( ($schedule &&  time() > strtotime($schedule) )  || $force_join)


@section('page-js')

    <script src="https://source.zoom.us/1.7.7/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.7.7.min.js"></script>

    <script>

        function stop_zoom() {
            if (confirm("Do you want to leave the live video class? you can join them later if the video class remains live")) {
                ZoomMtg.leaveMeeting();
            }
        }

        $( document ).ready(function() {
            start_zoom();
        });

        function start_zoom() {

            ZoomMtg.preLoadWasm();
            ZoomMtg.prepareJssdk();

            var API_KEY        = "{{get_option('liveclass.zoom_api_key')}}";
            var API_SECRET     = "{{get_option('liveclass.secret_key')}}";
            var USER_NAME      = "{{$auth_user->name}}";
            var MEETING_NUMBER = "{{array_get($option, 'zoom_meeting_id' )}}";
            var PASSWORD       = "{{array_get($option, 'zoom_meeting_password' )}}";

            testTool = window.testTool;

            var meetConfig = {
                apiKey: API_KEY,
                apiSecret: API_SECRET,
                meetingNumber: MEETING_NUMBER,
                userName: USER_NAME,
                passWord: PASSWORD,
                leaveUrl: "{{$course->url}}",
                role: 0
            };


            var signature = ZoomMtg.generateSignature({
                meetingNumber: meetConfig.meetingNumber,
                apiKey: meetConfig.apiKey,
                apiSecret: meetConfig.apiSecret,
                role: meetConfig.role,
                success: function(res){
                    console.log(res.result);
                }
            });

            ZoomMtg.init({
                leaveUrl: "{{$course->url}}",
                isSupportAV: true,
                success: function () {
                    ZoomMtg.join(
                        {
                            meetingNumber: meetConfig.meetingNumber,
                            userName: meetConfig.userName,
                            signature: signature,
                            apiKey: meetConfig.apiKey,
                            passWord: meetConfig.passWord,
                            success: function(res){
                                console.log('join meeting success');
                            },
                            error: function(res) {
                                console.log(res);
                            }
                        }
                    );
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
    </script>
@endsection


@else

    <script src="https://source.zoom.us/1.7.7/lib/vendor/jquery.min.js"></script>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{$schedule}}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="count_down"
            document.getElementById("count_down").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("count_down").innerHTML = "It's time to join";
            }
        }, 1000);
    </script>


@endif
