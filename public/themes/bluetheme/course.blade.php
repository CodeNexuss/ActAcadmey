@extends('layouts.theme')

@section('content')

@php
$contine_url = $course->continue_url;
@endphp

<div class="page-header-jumborton">

    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="row align-items-center">

                <div class="col-lg-8 col-md-12">
                    <div class="page-header-left py-5">
                        <h1>{{clean_html($course->title)}}</h1>
                        @if($course->short_description)
                        <p class="page-header-subtitle m-0" style="word-break:break-word;">
                            {{clean_html($course->short_description)}}</p>
                        @endif

                        <p class="mt-3 course-head-meta-wrap">
                            <span class="label-html">{!! labelHtml($course->id) !!}</span>
                            <span><i class="la la-signal"></i> {{course_levels($course->level)}} </span>
                        </p>

                        <p>
                            <span class="created-by mr-3">
                                <i class="la la-user"></i> {{__t('created_by')}} {{$course->author->name}}
                            </span>

                            <span class="last-updated-at">
                                <i class="la la-clock"></i>
                                {{__t('last_updated')}} {{$course->last_updated_at->format(date_time_format())}}
                            </span>
                        </p>

                    </div>
                </div>

                <div class="col-lg-4 col-md-12 pt-5 mb-5">

                    <div class="page-header-right-enroll-box p-2 pb-3 mt-sm-4 mt-md-0">

                        <div class="cls_vidoe set_width mb-4">
                            @if($course->video_info())
                            @include(theme('video-player'), ['model' => $course, 'video_caption' => __t('preview')])
                            @else
                            <img src="{{media_image_uri($course->thumbnail_id)->image_md}}" class="img-fluid" />
                            @endif
                        </div>

                        @if( $isEnrolled)
                        <p class="text-muted"><strong>{{__t('enrolled_at')}}</strong> :
                            {{date('F d, Y', strtotime($isEnrolled->enrolled_at))}} </p>

                        <a href="{{$contine_url}}" class="btn btn-info btn-lg btn-block"><i
                                class="la la-play-circle"></i> {{__t('continue_course')}}</a>

                        @else
                        @if($course->paid)

                        <div class="course-landing-page-price-wrap">
                            {!! $course->price_html(false, true) !!}
                        </div>

                        <form action="{{route('add_to_cart')}}" class="add_to_cart_form" method="post">
                            @csrf

                            <input type="hidden" name="course_id" value="{{$course->id}}">

                            <div class="enroll-box-btn-group mt-3">

                                <?php
                                        $in_cart = cart($course->id)

                                        ?>
                                <button type="button"
                                    class="btn btn-lg btn-theme-primary btn-block mb-3 add-to-cart-btn add-to-cart-btn-{{$course->id}}"
                                    data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}"
                                    name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}}
                                    data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                    @if($in_cart)
                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                    @else
                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                    @endif
                                </button>
                                <button type="submit" class="btn btn-lg btn-outline-dark btn-block" name="cart_btn"
                                    value="buy_now">{{__t('buy_now')}}</button>
                            </div>
                        </form>

                        @elseif($course->free)
                        <div class="course-landing-page-price-wrap">
                            {!! $course->price_html(false, true) !!}
                        </div>
                        <form action="{{route('free_enroll')}}" class="course-free-enroll" method="post">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <button type="submit"
                                class="btn btn-warning btn-lg btn-block">{{__t('enroll_now')}}</button>
                        </form>
                        @endif
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


<div class="container my-4">

    <div class="row">
        <div class="col-md-10 offset-md-1">


            <div class="course-details-wrap">


                <div class="course-intro-stats-wrapper mb-0">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="course-whats-included-box course-widget py-4 px-0">
                                <h4 class="mb-4">{{__t('whats_included')}}</h4>

                                @php
                                $lectures_count = $course->lectures->count();
                                $assignments_count = $course->assignments->count();
                                $attachments_count = $course->contents_attachments->count();
                                @endphp

                                <ul>
                                    @if($course->total_video_time)
                                    <li> <i class="la la-video"></i>
                                        {{seconds_to_time_format($course->total_video_time)}} {{__t('on_demand_video')}}
                                    </li>
                                    @endif

                                    <li> <i class="la la-book"></i> {{$lectures_count}} {{__t('lectures')}} </li>
                                    @if($assignments_count)
                                    <li> <i class="la la-tasks"></i> {{$assignments_count}} {{__t('assignments')}}</li>
                                    @endif
                                    @if($attachments_count)
                                    <li> <i class="la la-file-download"></i> {{$attachments_count}} downloadable
                                        resources </li>
                                    @endif

                                    <li> <i class="la la-mobile"></i> {{__t('access_tablet_phone')}} </li>
                                    <li> <i class="la la-certificate"></i> {{__t('completion_certificate')}} </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>



                @if($course->benefits_arr)
                <div class="course-widget mb-4 py-4 px-0">
                    <h4 class="mb-4">{{__t('what_learn')}}</h4>

                    <div class="content-expand-wrap">
                        <div class="content-expand-inner">
                            <ul class="benefits-items row">
                                @foreach($course->benefits_arr as $benefit)
                                <li class="col-12 benefit-item d-flex mb-2">
                                    <i class="la la-check-square"></i>
                                    <span class="benefit-item-text ml-2" style="text-align:justify;">{{$benefit}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                @if($course->sections->count())

                <div class="course-curriculum-header d-flex flex-wrap mt-5">
                    <div class="mb-4">
                        <h4 class=" course-curriculum-title flex-grow-1">{{__t('course_curriculum')}}</h4>
                        <span class="course-total-lectures-info"
                            style="font-size:18px;color: #A2A5B7">{{$course->total_lectures}} {{__t('lectures')}}</span>
                        <span class="ml-3 mr-3 course-runtime-info"
                            style="font-size:18px;color: #A2A5B7">{{seconds_to_time_format($course->total_video_time)}}</span>
                    </div>

                    <p class="ml-md-auto mr-auto" id="expand-collapse-all-sections">
                        <a href="javascript:;" data-action="expand">{{__t('expand_all')}}</a>
                        <a href="javascript:;" data-action="collapse" style="display: none;">{{__t('collapse_all')}}</a>
                    </p>


                </div>

                <div class="course-curriculum-wrap mb-4">

                    @foreach($course->sections as $section)

                    <div id="course-section-{{$section->id}}" class="course-section">

                        <div class="course-section-header p-3 d-lg-flex d-md-flex">
                            <span class="course-section-name flex-grow-1 ml-2">
                                <strong>
                                    <i class="la la-{{$loop->first ? 'minus' : 'plus'}}"></i>
                                    {{$section->section_name}}
                                </strong>
                            </span>

                            <span class="course-section-lecture-count d-flex ml-4 pl-1">
                                {{$section->items->count()}} {{__t('lectures')}}
                            </span>
                        </div>

                        <div class="course-section-body" style="display: {{$loop->first ? 'block' : 'none'}};">

                            @if($section->items->count())
                            @foreach($section->items as $item)
                            <div class="course-curriculum-item pl-4 d-lg-flex d-md-flex">
                                <p class="curriculum-item-title m-0 flex-grow-1">

                                    <a href="{{route('single_'.$item->item_type, [$course->slug, $item->id ] )}}" class="d-flex">
                                        <span class="curriculum-item-icon mr-2">
                                            {!! $item->icon_html !!}
                                        </span>
                                        <span class="curriculum-item-title">
                                            {{clean_html($item->title)}}
                                        </span>

                                        @if($item->attachments->count())
                                        <span class="section-item-attachments ml-3" data-toggle="tooltip"
                                            title="{{__t('dl_resource_available')}}">
                                            <i class="la la-paperclip"></i>
                                        </span>
                                        @endif
                                    </a>
                                </p>

                                <p class="course-section-item-details d-lg-flex d-md-flex m-0 ml-4">
                                    @if($item->is_preview)
                                    <span class="section-item-preview flex-grow-1">

                                        <a href="{{route('single_lecture', [$course->slug, $item->id ] )}}">
                                            <i class="la la-eye"></i> {{__t('preview')}}
                                        </a>

                                    </span>
                                    @endif


                                    <span class="section-item-duration ml-auto">
                                        {{$item->runtime}}
                                    </span>
                                </p>

                            </div>
                            @endforeach
                            @endif

                        </div>

                    </div>
                    @endforeach

                </div>
                @endif

                @if($course->requirements_arr)
                <h4 class="mb-2">{{__t('requirements')}}</h4>

                <div class="course-widget mb-4 p-2">
                    <ul class="benefits-items row">
                        @foreach($course->requirements_arr as $requirement)
                        <li class="col-12 benefit-item d-flex mb-2">
                            <i class="la la-info-circle"></i>
                            <span class="benefit-item-text ml-2">{{$requirement}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($course->description)
                <div class="course-description mt-4 mb-5">
                    <h4 class="mb-4 course-description-title">{{__t('description')}}</h4>

                    <div class="content-expand-wrap">
                        <div class="content-expand-inner">
                            {!! $course->description !!}
                        </div>
                    </div>
                </div>
                @endif


                <div id="course-instructors-wrap" class="my-5">

                    <h4 class="mb-4">{{__t('instructors')}}</h4>

                    @foreach($course->instructors as $instructor)
                    @php
                    $courses_count = $instructor->courses()->publish()->count();
                    $students_count = $instructor->student_enrolls->count();
                    $instructor_rating = $instructor->get_rating;
                    @endphp

                    <div class="course-single-instructor-wrap mb-4">

                        <div class="instructor-stats">
                            <div class="d-flex align-items-center mb-5">
                                <div class="profile-image mr-4 ">
                                    <a href="{{route('profile', $instructor->id)}}">
                                        {!! $instructor->get_photo !!}
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <a href="{{route('profile', $instructor->id)}}">
                                        <h4 class="instructor-name">{{$instructor->name}}</h4>
                                    </a>

                                    @if($instructor->job_title)
                                    <h5 class="instructor-designation">{{$instructor->job_title}}</h5>
                                    @endif

                                    @if($instructor_rating->rating_count)
                                    <div class="profile-rating-wrap d-flex">
                                        {!! star_rating_generator($instructor_rating->rating_avg) !!}
                                        <p class="m-0 ml-2">({{$instructor_rating->rating_avg}})</p>
                                    </div>
                                    @endif
                                </div>
                            </div>


                            <div class="cls_listview d-flex align-items-center justify-content-around mb-4 p-4">
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-play-circle"></i>
                                    <strong>{{$courses_count}}</strong> {{__t('courses')}}
                                </p>
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-user-circle"></i>
                                    <strong>{{$students_count}}</strong> {{__t('students')}}
                                </p>
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-comments"></i>
                                    <strong>{{$instructor_rating->rating_count}} </strong> {{__t('reviews')}}
                                </p>
                            </div>
                        </div>

                        <div class="instructor-details">

                            @if($instructor->about_me)
                            <div class="profle-about-me-text mt-4">
                                <div class="content-expand-wrap">
                                    <div class="content-expand-inner">
                                        {!! nl2br($instructor->about_me) !!}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>


                    </div>

                    @endforeach
                </div>


                @if($course->reviews->count())
                <div id="course-ratings-wrap">
                    <h4 class="mb-4">{{__t('student_feedback')}}</h4>

                    <div id="course-rating-stats-wrap" class="my-4 d-flex">
                        <div class="rating-stats-avg mr-5">
                            <p class="rating-avg-big m-0">{{$course->rating_value}}</p>
                            {!! star_rating_generator($course->rating_value) !!}
                            <p class="number-of-reviews mt-3">
                                {{sprintf(__t('from_amount_reviews'), $course->rating_count)}}
                            </p>
                        </div>

                        <div class="star-rating-reviews-bar-wrap flex-grow-1">
                            @foreach($course->get_ratings('stats') as $rateKey => $rating)
                            <div class="rating-percent-wrap d-flex">
                                <div class="star-rating-bar-bg">
                                    <div class="star-rating-bar-fill" style="width: {{array_get($rating, 'percent')}}%">
                                    </div>
                                </div>

                                <div class="star-rating-percent-wrap">
                                    {!! star_rating_generator($rateKey) !!}
                                </div>
                                <p class="rating-percent-text m-0">{{array_get($rating, 'percent')}}%</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="reviews-list-wrap">
                        @foreach($course->reviews as $review)
                        <div class="single-review border-top d-flex my-3 py-3">
                            <div class="col-sm-3 col-md-5 col-lg-4 col-xl-3 col-7 pl-0">
                                <div class="reviewed-user d-flex align-items-center">
                                    <div class="reviewed-user-photo">
                                        <a href="{{route('profile', $review->user->id)}}">
                                            {!! $review->user->get_photo !!} 
                                        </a>
                                    </div>
                                    <div class="reviewed-user-name">
                                        <p class="mb-1">
                                            <a href="{{route('review', $review->id)}}"
                                                class="text-muted ">{{$review->created_at->diffForHumans()}}</a>
                                        </p>
                                        <a href="{{route('profile', $review->user->id)}}">{!! $review->user->name
                                            !!}</a>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-10 col-md-8 col-xl-7 pl-5 pl-md-0 ml-2 ml-md-0">

                                <div class="review-details text-sm-left">
                                    {!! star_rating_generator($review->rating) !!}
                                    @if($review->review)
                                    <div class="review-desc mt-3">
                                        {!! nl2br($review->review) !!}
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

        </div>

    </div>

</div>



@endsection