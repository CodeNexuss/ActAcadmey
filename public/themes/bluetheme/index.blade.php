@extends('layouts.theme')


@section('content')

    @if($home_slider->count())
    <div class="banner_carousel">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                @php $i = 1; @endphp
                @foreach($home_slider as $slider)
                    <div class="carousel-item {{ ($i == 1) ? 'active' : '' }}" >
                        <div class="carousel_banner_img">
                            <img src="{{ $slider->slider_url }}" alt="banner-image">
                        </div>
                        <div class="carousel_content carousel_content_card mx-auto mx-md-0 d-none d-md-block">
                            <h3 style="font-weight:bold;">{{ $slider->title }}</h3>
                            <p>
                                {!! $slider->description !!}
                                @if($slider->url)
                                    <a href="{{$slider->url}}" target="_blank">{{__t('see_more')}}</a>
                                @endif
                            </p>
                        </div> 
                  </div>
                    @php $i++; @endphp
                @endforeach
                
            </div>
            @if($home_slider->count() > 1)
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                    <div class="owl-prev">
                        <span aria-label="Previous"><</span>
                        <span class="sr-only">{{__t('previous')}}</span>
                    </div> 
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                    <div class="owl-next">
                        <span aria-label="Next">></span>
                        <span class="sr-only">{{__t('next')}}</span>
                    </div>
                </button>
            @endif
        </div>
    </div>
    @endif

    @if($top_topics->count())
    <section class="top-courses top-courses-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="font-size:40px;" class="mt-5">{{__t('top_topics_title')}}</h3>
                    <p style="font-size:23px;color:#494949;">{{__t('top_topics_desc')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ul_relative">
                        <ul class="nav nav-pills remove_active_blue mb-3 owl-carousel" id="pills-tab" role="tablist">
                            @php $i = 1 @endphp
                            @foreach($top_topics as $topic)
                                @if($topic->category_courses->count())
                                <li class="nav-item topics-nav-item" role="presentation">
                                    <a class="nav-link {{$i==1 ? 'active' : ''}}" id="{{$topic->slug}}-tab" data-toggle="pill" href="#{{$topic->slug}}" role="tab" aria-controls="{{$topic->slug}}" aria-selected="{{$i==1 ? 'true' : 'false'}}" data-tab="{{$topic->slug}}">{{$topic->category_name}}</a>
                                </li>
                                @php $i++ @endphp
                                @endif
                            @endforeach
                            <!-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Development</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">All Development</a>
                            </li>                           -->
                        </ul>
                    </div>
                    <div class="tab-content topics-tab-content" id="pills-tabContent">

                        @php $j = 1 @endphp
                        @foreach($top_topics as $topic)
                        @if($topic->category_courses->count())
                        <!-- @foreach($topic->category_courses as $courses) -->
                        <div class="tab-pane fade show {{$j==1 ? 'active' : ''}}" id="{{$topic->slug}}" role="tabpanel" aria-labelledby="{{$topic->slug}}-tab">
                            <div class="col-lg-12" style="border:1px solid #c7c7c7;padding: 30px 20px;margin:45px 0;">
                                @if($topic->title)
                                <h4 style="font-weight:bold;font-size:25px;">
                                    {{ $topic->title }}
                                </h4>
                                @endif
                                @if($topic->description)
                                    <p class="w-75 text-secondary">{{ $topic->description }}</p>
                                @endif
                                <a href="{{ route('courses', ['category' => $topic->category_id, 'topic' => $topic->category_courses->first()->category_id, 'sort' => '']) }}" target="_blank" class="btn btn-outline-dark rounded-0">{{__t('explore')}} {{$topic->category_name}}</a>
                                <div class="featured-courses-cards-wrap top_course_carousel mt-3">
                                    <div class="owl-carousel-container owl-carousel mt-5" data-item-length="{{$topic->category_courses->count()}}">
                                        
                                        @foreach($topic->category_courses as $course)
                                        <div class="cls_alllistWidth item">
                                            <a href="{{route('course', $course->slug)}}" class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
                                                <div class="img">
                                                    <img src="{{$course->thumbnail_url}}" alt="image"/>
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
                                                <div class="seemoretext">
                                                    <a href="{{ route('courses', ['category' => $topic->category_id, 'topic' => $topic->category_courses->first()->category_id, 'sort' => '']) }}" target="_blank" class="btn see_more_btn">{{__t('see_more')}}</a>
                                                </div>
                                            </a>
                                            <div class="tool_hover">
                                                <div class="cls_allAbs">
                                                    <div class="cls_allsdf">
                                                        <h1>{{$course->title}}</h1>
                                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span> </p>
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
                                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                                @if($in_cart)
                                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                                @else
                                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                                @endif
                                                            </button>
                                                            
                                                            <a href="javascript:;"  style="cursor: pointer;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
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
                                        @php $j++ @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- @endforeach -->
                        @php //$j++ @endphp
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </section>
    @endif


    <div class="hero-banner py-3 mb-5">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-6">

                    <div class="hero-left-wrap">
                        <h1 class="hero-title mb-4">{{__t('hero_title')}}</h1>
                        <p class="hero-subtitle  mb-4">
                            {!! __t('hero_subtitle') !!}
                        </p>
                        <a href="{{route('courses')}}" class="btn btn-theme-primary btn-lg">{{ __t('browse_course') }}</a>
                    </div>

                </div>


                <div class="col-md-12 col-lg-6 hero-right-col">
                    <div class="hero-right-wrap">
                        <img src="{{theme_url('images/hero-image.png')}}" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="home-section-wrap home-info-box-wrapper pb-5 mt-lg-0 mt-3">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="home-info-box">
                        <img src="{{theme_url('images/skills.png')}}">
                        <h3 class="info-box-title">{{ __t('home_sec4_title1') }}</h3>
                        <p class="info-box-desc">{{__t('home_sec4_desc1')}}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="home-info-box">
                        <img src="{{theme_url('images/career-goal.png')}}">
                        <h3 class="info-box-title">{{__t('home_sec4_title2')}}</h3>
                        <p class="info-box-desc">{{__t('home_sec4_desc2')}}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="home-info-box">
                        <img src="{{theme_url('images/instructions.png')}}">
                        <h3 class="info-box-title">{{__t('home_sec4_title3')}}</h3>
                        <p class="info-box-desc">{{__t('home_sec4_desc3')}}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="home-info-box">
                        <img src="{{theme_url('images/cartificate.png')}}">
                        <h3 class="info-box-title">{{__t('home_sec4_title4')}}</h3>
                        <p class="info-box-desc">{{__t('home_sec4_desc4')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($popular_courses->count())
        <div class="home-section-wrap home-popular-courses-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">
                                {{__t('popular_courses')}}

                                <a href="{{route('courses', ['sort' => 'popular_courses'])}}" class="btn btn-link float-right"><i class="la la-bolt"></i> {{__t('all_popular_courses')}}</a>
                            </h3>

                            <p class="section-subtitle">{{__t('popular_courses_desc')}}</p>
                        </div>
                    </div>
                </div>
                <div class="popular-courses-cards-wrap mt-3">
                    <div class="owl-carousel-container owl-carousel" data-item-length="{{ count($popular_courses) }}" data-item="{{count($popular_courses)}}" id="zindex">
                        

                        @foreach($popular_courses as $course)
                        <div class="cls_alllistWidth item">
                            <a href="{{route('course', $course->slug)}}" class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>

                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => 'popular_courses'])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>
                                            <!-- <a href="" class="btn btn-md btn-theme mt-2" style="flex:1;"><i class="la la-shopping-cart"></i> <span>{{ __t('add_to_cart') }} </span></a> -->

                                            
                                            <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
                                                @if($auth_user && in_array($course->id, $auth_user->get_option('wishlists', []) ))
                                                    <i class="la la-heart"></i>
                                                @else
                                                    <i class="la la-heart-o"></i>
                                                @endif
                                            </a>
                                            <!-- <a href="" class="btn btn-dm btn-theme mt-2 ml-3" title="{{ __t('remove_from_wishlist') }}"><i class="la la-heart"></i></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    @endif


    <div class="mid-callto-action-wrap text-white text-center py-3">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="cls_actionwrap py-5">
                        <h2 class="mb-4">{{__t('home_find_course_title')}}</h2>
                        <h4 class="mb-4 mid-callto-action-subtitle">{!! __t('home_find_course_desc') !!}</h4>

                        <a href="{{route('courses')}}" class="btn btn-lg" >{{__t('find_new_courses')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($featured_courses->count())
        <div class="home-section-wrap home-featured-courses-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">{{__t('featured_courses')}}

                                <a href="{{route('courses', ['sort' => 'featured_courses'])}}" class="btn btn-link float-right"><i class="la la-bookmark"></i> {{__t('all_featured_courses')}}</a>
                            </h3>
                            <p class="section-subtitle">{{__t('featured_courses_desc')}}</p>
                        </div>
                    </div>
                </div>
                <div class="featured-courses-cards-wrap mt-3">
                    <div class="owl-carousel-container owl-carousel " data-item-length="{{ count($featured_courses) }}">
                        
                        @foreach($featured_courses as $course)
                        <div class="cls_alllistWidth item">
                            <a href="{{route('course', $course->slug)}}" class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>

                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => 'featured_courses'])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>
                                            
                                            <a href="javascript:;"  style="cursor: pointer;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
                                                @if($auth_user && in_array($course->id, $auth_user->get_option('wishlists', []) ))
                                                    <i class="la la-heart"></i>
                                                @else
                                                    <i class="la la-heart-o"></i>
                                                @endif
                                            </a>
                                            <!-- <a href="" class="btn btn-dm btn-theme mt-2 ml-3" title="{{ __t('remove_from_wishlist') }}"><i class="la la-heart"></i></a> -->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($most_viewed->count())
        <div class="home-section-wrap home-most-viewed-courses-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">{{__t('most_viewed_courses')}}

                                <a href="{{route('courses', ['sort' => 'most_viewed'])}}" class="btn btn-link float-right"><i class="la la-eye"></i> {{__t('all_most_viewed_courses')}}</a>
                            </h3>
                            <!-- <p class="section-subtitle">{{__t('most_viewed_courses_desc')}}</p> -->
                        </div>
                    </div>
                </div>
                <div class="most-viewed-courses-cards-wrap mt-3">
                    <div class="owl-carousel-container owl-carousel ">
                        
                        @foreach($most_viewed as $course)
                        <div class="cls_alllistWidth item">
                            <a href="{{route('course', $course->slug)}}" class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>
                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => 'most_viewed'])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>
                                            
                                            <a href="javascript:;"  style="cursor: pointer;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
                                                @if($auth_user && in_array($course->id, $auth_user->get_option('wishlists', []) ))
                                                    <i class="la la-heart"></i>
                                                @else
                                                    <i class="la la-heart-o"></i>
                                                @endif
                                            </a>
                                            <!-- <a href="" class="btn btn-dm btn-theme mt-2 ml-3" title="{{ __t('remove_from_wishlist') }}"><i class="la la-heart"></i></a> -->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if($new_courses->count())
  
        <div class="home-section-wrap home-new-courses-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">{{__t('new_arrival')}}

                                <a href="{{route('courses', ['sort' => 'new_courses'])}}" class="btn btn-link float-right"><i class="la la-list"></i> {{__t('all_courses')}}</a>
                            </h3>
                            <p class="section-subtitle">{{__t('new_arrival_desc')}}</p>
                        </div>
                    </div>
                </div>

                <div class="new-courses-cards-wrap mt-3 poping">
                    <div class="owl-carousel-container owl-carousel " data-item-length="{{ count($new_courses) }}">

                        @foreach($new_courses as $course)
                        <div class="cls_alllistWidth item">                                
                            <a href="{{route('course', $course->slug)}}"  class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>
                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => 'new_courses'])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>                                    

                                            
                                            <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
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
                </div>
            </div>
        </div>
    @endif

    @if($related_for_enrolled->count())
  
        <div class="home-section-wrap home-related-for-enrolled-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            
                            <h3 class="section-title">{!! sprintf(__t('because_u_enrolled_for_title'), $random_enrolled->title) !!}

                                <!-- <a href="{{route('courses', ['sort' => 'new_courses'])}}" class="btn btn-link float-right"><i class="la la-list"></i> {{__t('all_courses')}}</a> -->
                            </h3>
                            <!-- <p class="section-subtitle">{{__t('related_for_enrolled_courses_desc')}}</p> -->
                        </div>
                    </div>
                </div>

                <div class="related-for-enrolled-cards-wrap mt-3 poping">
                    <div class="owl-carousel-container owl-carousel " data-item-length="{{ count($related_for_enrolled) }}">

                        @foreach($related_for_enrolled as $course)
                        <div class="cls_alllistWidth item">                                
                            <a href="{{route('course', $course->slug)}}"  class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>

                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => '', 'parent_category' => $course->parent_category_id, 'category' => $course->second_category_id, 'topic' => $course->category_id])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>                                    

                                            
                                            <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
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
                </div>
            </div>
        </div>
    @endif


    @if(isset($user) && count($user->related_for_last_viewed_course) > 0)
  
        <div class="home-section-wrap home-related-for-enrolled-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            
                            <h3 class="section-title">{!! sprintf(__t('because_you_viewed'), '" '. $user->last_viewed_course->title .' "') !!}

                                <!-- <a href="{{route('courses', ['sort' => 'new_courses'])}}" class="btn btn-link float-right"><i class="la la-list"></i> {{__t('all_courses')}}</a> -->
                            </h3>
                            <!-- <p class="section-subtitle">{{__t('related_for_enrolled_courses_desc')}}</p> -->
                        </div>
                    </div>
                </div>

                <div class="related-for-enrolled-cards-wrap mt-3 poping">
                    <div class="owl-carousel-container owl-carousel " data-item-length="{{ count($related_for_enrolled) }}">

                        @foreach($user->related_for_last_viewed_course as $course)
                        <div class="cls_alllistWidth item">                                
                            <a href="{{route('course', $course->slug)}}"  class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>

                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => 'because_you_viewed', 'parent_category' => $course->parent_category_id, 'category' => $course->second_category_id, 'topic' => $course->category_id])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>                                    

                                            
                                            <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
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
                </div>
            </div>
        </div>
    @endif


    @if(isset($user) && count($user->also_liked_courses) > 0)
  
        <div class="home-section-wrap home-related-for-enrolled-wrapper py-5 hov-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            
                            <h3 class="section-title">{!! __t('you_might_also_lik') !!}

                                <!-- <a href="{{route('courses', ['sort' => 'new_courses'])}}" class="btn btn-link float-right"><i class="la la-list"></i> {{__t('all_courses')}}</a> -->
                            </h3>
                            <!-- <p class="section-subtitle">{{__t('related_for_enrolled_courses_desc')}}</p> -->
                        </div>
                    </div>
                </div>

                <div class="related-for-enrolled-cards-wrap mt-3 poping">
                    <div class="owl-carousel-container owl-carousel " data-item-length="{{ count($related_for_enrolled) }}">

                        @foreach($user->also_liked_courses as $course)
                        <div class="cls_alllistWidth item">                                
                            <a href="{{route('course', $course->slug)}}"  class="listoutview mb-4 d-block pop" data-container="body" data-toggle="popover-{{$course->id}}" data-placement="right"   data-original-title="list" data-content=''>
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
                                            <!-- <i class="la la-star" data-rating-value="1"></i>
                                            <i class="la la-star" data-rating-value="2"></i>
                                            <i class="la la-star" data-rating-value="3"></i>
                                            <i class="la la-star-o" data-rating-value="4"></i>
                                            <i class="la la-star-o" data-rating-value="5"></i> -->
                                        </div>
                                        <span>({{ $course->rating_count }})</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span>{!! ($course->sale_price > 0.00) ? price_format($course->sale_price) : __t('free') !!}</span> <small>{!! ($course->price) ? price_format($course->price) : '' !!}</small>
                                        <p class="label-html">{!! labelHtml($course->id) !!}</p>
                                    </div>
                                </div>

                                <div class="seemoretext">
                                    <a href="{{route('courses', ['sort' => 'you_might_also_like', 'parent_category' => $course->parent_category_id, 'category' => $course->second_category_id, 'topic' => $course->category_id])}}" class="btn see_more_btn">{{__t('see_more')}}</a>
                                </div>

                            </a>
                            <div class="tool_hover">
                                <div class="cls_allAbs">
                                    <div class="cls_allsdf">
                                        <h1>{{$course->title}}</h1>
                                        <p><span class="label-html">{!! labelHtml($course->id) !!}</span> {{__t('updated')}} <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span></p>
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
                                            <button type="button" class="btn btn-md btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}}" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}">
                                                @if($in_cart)
                                                    <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                                @else
                                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                                @endif
                                            </button>                                    

                                            
                                            <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
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
                </div>
            </div>
        </div>
    @endif

   

    <div class="home-section-wrap home-cta-wrapper pb-5 ">

        <div class="home-partners-logo-section pb-5 mb-5 text-center">
            <div class="container">

                <h5 class="home-partners-title mb-5">{{__t('home_companies_text')}}</h5>

                <div class="home-partners-logo-wrap p-5">
                    <div class="logo-item">
                        <a href=""><img src="{{theme_url('images/adidas.png')}}" alt="adidas" /></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{theme_url('images/disnep.png')}}" alt="images" /></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{theme_url('images/intel.png')}}" alt="intel" /></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{theme_url('images/penlaw.png')}}" alt="penlaw" /></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{theme_url('images/shopify.png')}}" alt="shopify" /></a>
                    </div>
                </div>

            </div>
        </div>

      <!--   <div class="home-course-stats-wrap pb-5 mb-5 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"><h3>580</h3> <h5>Active Courses</h5></div>
                    <div class="col-md-3"> <h3>1200</h3> <h5>Hours Video</h5></div>
                    <div class="col-md-3"><h3>850</h3> <h5>Teachers</h5></div>
                    <div class="col-md-3"><h3>1800</h3> <h5>Students Learning</h5></div>
                </div>
            </div>
        </div> -->


        @if($top_categories->count())
        <section class="top-categories">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h3 style="font-weight:bold;" class="text-center text-lg-left">{{__t('top_categories')}}</h3>
                    </div>

                    @foreach($top_categories as $category)
                        <div class="col-lg-3 col-md-6">
                            <div class="design mt-4">
                                <div class="design_img">
                                    <a href="{{ route('categories', ['slug' => $category->slug]) }}"><img src="{!! media_image_uri($category->category_image)->thumbnail !!}" alt=""></a>
                                </div>
                            </div>
                            <h5 class="mt-2 text-center text-lg-left">{{$category->category_name}}</h5>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </section>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-sm-6">

                    <div class="home-cta-text-wrapper p-5 text-left">
                        <h4>{{__t('become_ins_title')}}</h4>
                        <p>{{__t('become_ins_desc')}}
                        </p>
                        <a href="{{route('create_course')}}" class="btn btn-theme-primary">{{__t('become_ins_btn_text')}}</a>
                        <img src="{{theme_url('images/become.png')}}" alt="become" class="cta_radius_img">
                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="home-cta-text-wrapper p-5 text-left mt-lg-0 mt-3">
                        <h4>{{__t('home_discover_title')}}</h4>
                        <p>{{__t('home_discover_desc')}}
                        </p>
                        <a href="{{route('courses')}}" class="btn btn-theme-primary">{{__t('find_new_courses')}}</a>
                        <img src="{{theme_url('images/discover.png')}}" alt="become" class="cta_radius_img">
                    </div>

                </div>

            </div>
        </div>

    </div>

     @if($posts->count())
     
    <div class="home-section-wrap home-blog-section-wrapper py-5">

        <div class="container">

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="section-header-wrap">
                        <h3 class="section-title">{{__t('latest_blog_text')}}</h3>
                        <p class="section-subtitle">{{__t('latest_blog_desc')}}</p>
                    </div>
                </div>
            </div>


            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="home-blog-card">
                            <a href="{{$post->url}}">
                                <img src="{{$post->thumbnail_url->image_md}}" alt="{{$post->title}}" class="img-fluid">
                            </a>
                            <div class="excerpt px-1">
                                <h2><a href="{{$post->url}}">{{$post->title}}</a></h2>
                                <div class="post-meta d-flex justify-content-between">
                                    <span>
                                        <i class="la la-user"></i>
                                        <a href="{{route('profile', $post->user_id)}}">
                                            {{$post->author->name}}
                                        </a>
                                    </span>
                                    <span>&nbsp;<i class="la la-calendar"></i>&nbsp; {{$post->published_time}}</span>
                                </div>
                                <p class="mt-4">
                                    <a href="{{$post->url}}" class="btn"><strong>{{__t('read_more')}} <i class="la la-arrow-right"></i> </strong></a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="btn-see-all-posts-wrapper pt-4">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <a href="{{route('blog')}}" class="btn btn-lg btn-theme-primary ml-auto mr-auto   ">
                            <i class="la la-blog"></i> {{__t('see_all_posts')}}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    

    @endif

@endsection

<script>
    // setInterval(() => {
    //     let show = document.querySelectorAll(".owl-item.active")
    //     let showed = show.forEach((one, index) => one.style.zIndex = "-"+index )
    // }, 100);
    </script>