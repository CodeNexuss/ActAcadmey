@extends('layouts.theme')


@section('content')

    @php
        $courses = $user->courses()->publish()->get();
        $students_count = $user->student_enrolls->count();
        $rating = $user->get_rating;
    @endphp

    <div class="container">


        <div class="profile-page-wrap d-flex py-5 flex-wrap flex-sm-nowrap">

            <div class="profile-page-sidebar mr-4">

                <div class="profile-image mr-4 text-center">
                    {!! $user->get_photo !!}
                </div>

                <p class="profile-social-icon-wrap mt-4">
                    @if($user->get_option('social'))
                        @foreach($user->get_option('social') as $socialKey => $social)
                            @if($social)
                                <a title="{{ucfirst($socialKey)}}" href="{{$social}}" class="d-block border py-2 px-3 mb-1" target="_blank">
                                    <i class="la la-{{$socialKey === 'website' ? 'link' : $socialKey}}"></i>
                                    {{ucfirst($socialKey)}}
                                </a>
                            @endif
                        @endforeach
                    @endif
                </p>

            </div>

            <div class="profile-page-content-wrap flex-grow-1">

                <div class="profle-page-header mb-4 border-bottom">
                    @if($user->isInstructor)
                        <label class="badge badge-info">{{__t('instructor')}}</label>
                    @else
                        <label class="badge badge-dark">{{__t('student')}}</label>
                    @endif

                    <h1 class="profile-name">{{$user->name}}</h1>
                    @if($user->job_title)
                        <h3 class="profile-designation">{{$user->job_title}}</h3>
                    @endif

                    @if($rating->rating_count)
                        <div class="my-3 profile-rating-wrap d-flex">
                            {!! star_rating_generator($rating->rating_avg) !!}
                            <p class="m-0 ml-3">({{$rating->rating_avg}})</p>
                        </div>
                    @endif

                    @if($user->isInstructor)

                        <div class="profile-stat-wrap d-flex mt-2">
                            @if($courses->count())
                                <div class="profile-stat mr-4">
                                    <p class="profile-stat-title mb-0">{{__t('courses')}}</p>
                                    <p class="profile-stat-value">{{$courses->count()}}</p>
                                </div>
                            @endif
                            @if($students_count)
                                <div class="profile-stat mr-4">
                                    <p class="profile-stat-title mb-0">{{__t('students')}}</p>
                                    <p class="profile-stat-value">{{$students_count}}</p>
                                </div>
                            @endif
                            <div class="profile-stat mr-4">
                                <p class="profile-stat-title mb-0">{{__t('reviews')}}</p>
                                <p class="profile-stat-value">{{$rating->rating_count}}</p>
                            </div>
                        </div>
                    @endif


                </div>

                @if($user->about_me)
                    <h4 class="mb-4">{{__t('about_me')}}</h4>

                    <div class="profle-about-me-text">
                        <div class="content-expand-wrap">
                            <div class="content-expand-inner">
                                {!! nl2br($user->about_me) !!}
                            </div>
                        </div>
                    </div>
                @endif

                @if($courses->count())
                    <h4 class="my-4">{{__t('my_courses')}}</h4>

                    <div class="row">
                        @foreach($courses as $course)
                            
                        <div class="col-lg-3 col-md-6 cls_alllistWidth">
                            <a href="{{route('course', $course->slug)}}" class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right" data-original-title="list" data-content=''>
                                <div class="img">
                                    <img src="{{$course->thumbnail_url}}" alt="image"/>
                                     <!-- <img src="{{asset('assets/images/sample.png')}}" alt="image" /> -->
                                </div>
                                <div class="text">
                                     @php
                                        $lectures_count = $course->lectures->count();
                                        $assignments_count = $course->assignments->count();
                                        $quizzes_count = $course->quizzes->count();
                                    @endphp
                                    <h5>{{$course->title}}  <!-- {!! $course->status_html() !!} --></h5>
                                    <p>{{__t('by')}} {{ ($course->author) ? $course->author->name : '--' }}</p>
                                    <div class="star">
                                        @if($course->rating_value && $course->rating_value > 1)
                                        <strong>{{($course->rating_value) ? $course->rating_value : '0.00'}}</strong>
                                        <div class="generated-star-rating-wrap">
                                            @for($r = 1; $r <= 5; $r++)
                                                @if($r <= round($course->rating_value))
                                                    <i class="la la-star" data-rating-value="{{ $r }}"></i>        
                                                @else
                                                    <i class="la la-star-o" data-rating-value="{{ $r }}"></i>        
                                                @endif
                                            @endfor
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span>{{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
                                        <div class="mb-2">
                                            <span>
                                                @if($course->level == 1)
                                                    @php $level = __t('beginner') @endphp                                    
                                                @elseif($course->level == 2)
                                                    @php $level = __t('intermediate') @endphp
                                                @elseif($course->level == 3)
                                                    @php $level = __t('expert') @endphp
                                                @else
                                                    @php $level = __t('all_level') @endphp
                                                @endif

                                                {{ $level }}
                                            </span>
                                            <span>{{ ($course->category) ? $course->category->category_name : '--' }}</span>
                                        </div>
                                        <h5>{{ \Str::limit($course->short_description, 60) }}</h5>
                                        <ul class="row p-0">
                                            <li class="col-lg-6 col-12"><span class="tick_icon mr-2"><img src="{{url('uploads/images/Tick.svg')}}"></span>{{ $course->total_lectures . __t('lectures') }}</li>
                                           <li class="col-lg-6 col-12"><span class="tick_icon mr-2"><img src="{{url('uploads/images/Tick.svg')}}"></span>{{ $level }}</li>
                                           <li class="col-lg-6 col-12"><span class="tick_icon mr-2"><img src="{{url('uploads/images/Tick.svg')}}"></span>{{__t('by')}} {{ ($course->author) ? $course->author->name : '--' }}</li>
                                           <li class="col-lg-6 col-12"><span class="tick_icon mr-2"><img src="{{url('uploads/images/Tick.svg')}}"></span>{{ $course->second_category->category_name }}</li>
                                        </ul>
                                        <div class="d-flex align-items-center">
                                            <?php
                                                $in_cart = cart($course->id)
                                            ?>
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>
                                            
                                            <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}">
                                                @if($auth_user && in_array($course->id, $auth_user->get_option('wishlists', []) ))
                                                    <i class="la la-heart"></i>
                                                @else
                                                    <i class="la la-heart-o"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                @endif

            </div>

        </div>




    </div>



@endsection
