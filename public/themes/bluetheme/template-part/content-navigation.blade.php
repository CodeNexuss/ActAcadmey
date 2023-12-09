@php
    $completed_percent = $course->completed_percent();
@endphp

<div class="lecture-header d-flex px-5">
    <div class="lecture-header-left d-flex ">
        <!-- <a href="{{route('course', $course->slug)}}" class="back-to-curriculum" data-toggle="tooltip" title="{{__t('go_to_course')}}">
            <i class="la la-angle-left"></i>
        </a> -->

        <!-- <a href="javascript:;" class="nav-icon-list d-sm-block d-md-none d-lg-none"><i class="la la-list"></i> </a> -->
         <a class="navbar-brand site-main-logo" href="{{route('home')}}" style="color: #000;">
                @php
                    $logoUrl = media_file_uri(get_option('site_logo'));
                @endphp

                @if(get_option('logo_settings')=='show_site_name')
                    <div class=""><h3>{{get_option('site_name')}}</h3></div>
                @elseif($logoUrl)
                    <img src="{{media_file_uri(get_option('site_logo'))}}" alt="{{get_option('site_title')}}" />
                @else
                    <img src="{{asset('assets/images/udify-logo.svg')}}" alt="{{get_option('site_title')}}" />
                @endif
            </a>

        @if($auth_user && ! $auth_user->is_completed_course($course->id) && $auth_user->is_evaluated_course($course->id) && $completed_percent==100)
            <form action="{{route('course_complete', $course->id)}}" method="post" class="ml-auto d-none d-lg-block">
                @csrf
                <button type="submit" href="javascript:;" class="nav-icon-complete-course btn btn-success mr-3 ml-auto" data-toggle="tooltip" title="{{__t('complete_course')}}" >
                    <i class="la la-check-circle"></i>
                </button>
            </form>
        @endif
    </div>
    <div class="lecture-header-right d-lg-flex align-items-center d-none">
        <h2 class="lecture-title w-50 mb-0">{{$title}}</h2>
         @if($auth_user)
        @php
            $drip_items = $course->drip_items;
            $review = has_review($auth_user->id, $course->id);
        @endphp

        @php do_action('lecture_single_before_progressbar', $course, $content); @endphp

        <div class="lecture-page-course-progress px-4 text-center ml-auto" style="width:280px">
            <div class="progress mb-1">
                <div class="progress-bar bg-info" style="width: {{$completed_percent}}%"></div>
            </div>
            <div class="course-progress-percentage text-info d-flex justify-content-between">
                <p class="m-0" style="color:#1C1D1F">
                <span class="percentage">
                    {{$completed_percent}}%
                </span>
                    {{__t('complete')}}
                </p>
               
            </div>
        </div>

         @if($auth_user && $auth_user->is_completed_course($course->id) && $completed_percent==100)
                <a href="#" class="text-center cls_gray_btn write-review-text" data-toggle="modal" data-target="#writeReviewModal">
                    <i class="la la-comment"></i> {{ $review ? __t('update_review') : __t('write_review')}}
                </a>
            @endif

        @php do_action('lecture_single_after_progressbar', $course, $content); @endphp

    @endif

    </div>
</div>
