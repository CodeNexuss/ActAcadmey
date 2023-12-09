@extends('layouts.theme')


@section('content')

    @php
        $path = request()->path();
    @endphp

    <div class="page-header-wrapper py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-2">
                        @if($path === 'courses')
                            @if($sort == 'relevance')
                                {{__t('most_relevant')}}
                            @elseif($sort == 'most-reviewed')
                                {{__t('most_reviewed')}}
                            @elseif($sort == 'highest-rated')
                                {{__t('highest_rated')}}
                            @elseif($sort == 'newest')
                                {{__t('newest')}}
                            @elseif($sort == 'price-low-to-high')
                                {{__t('lowest_price')}}
                            @elseif($sort == 'price-high-to-low')
                                {{__t('highest_price')}}
                            @elseif($sort == 'popular_courses')
                                {{__t('popular_courses')}}
                            @elseif($sort == 'featured_courses')
                                {{__t('featured_courses')}}
                            @elseif($sort == 'most_viewed')
                                {{__t('most_viewed_courses')}}
                            @elseif($sort == 'new_courses')
                                {{__t('new_arrival_courses')}}
                            @elseif($sort == 'because_you_viewed' && isset($user) && $user->last_viewed_course!=NULL)
                                {!! sprintf(__t('because_you_viewed'), '" '. $user->last_viewed_course->title .' "') !!}
                            @elseif($sort == 'you_might_also_like' && isset($user))
                                {{__t('you_might_also_lik')}}
                            @else
                                @if($sort=='' && request('category')!='' && request('topic')!='')
                                    {{__t('explore_courses')}}
                                @else
                                    {{__t('courses')}}
                                @endif
                            @endif
                        @else
                            {{$title}}
                        @endif


                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class='breadcrumb mb-0'>
                            <li class='breadcrumb-item'>
                                <a href='{{route('home')}}'>
                                    <i class='la la-home'></i>  {{__t('home')}}
                                </a>
                            </li>
                            @if($path === 'courses')
                                @if($sort == 'relevance')
                                    <li class='breadcrumb-item active'></i>  {{__t('most_relevant')}}
                                @elseif($sort == 'most-reviewed')
                                    <li class='breadcrumb-item active'></i>  {{__t('most_reviewed')}}
                                @elseif($sort == 'highest-rated')
                                    <li class='breadcrumb-item active'></i>  {{__t('highest_rated')}}
                                @elseif($sort == 'newest')
                                    <li class='breadcrumb-item active'></i>  {{__t('newest')}}
                                @elseif($sort == 'price-low-to-high')
                                    <li class='breadcrumb-item active'></i>  {{__t('lowest_price')}}
                                @elseif($sort == 'price-high-to-low')
                                    <li class='breadcrumb-item active'></i>  {{__t('highest_price')}}
                                @elseif($sort == 'popular_courses')
                                    <li class='breadcrumb-item active'></i>  {{__t('popular_courses')}}
                                @elseif($sort == 'featured_courses')
                                    <li class='breadcrumb-item active'></i>  {{__t('featured_courses')}}
                                @elseif($sort == 'most_viewed')
                                    <li class='breadcrumb-item active'></i>  {{__t('most_viewed_courses')}}
                                @elseif($sort == 'new_courses')
                                    <li class='breadcrumb-item active'></i>  {{__t('new_arrival_courses')}}
                                @elseif($sort == 'because_you_viewed' && isset($user) && $user->last_viewed_course!=NULL)
                                    <li class='breadcrumb-item active'></i>   {!! sprintf(__t('because_you_viewed'), '" '. $user->last_viewed_course->title .' "') !!}
                                @elseif($sort == 'you_might_also_like' && isset($user))
                                    <li class='breadcrumb-item active'></i>  {{__t('you_might_also_lik')}}
                                @else
                                    @if($sort=='' && request('category')!='' && request('topic')!='')
                                        <li class='breadcrumb-item active'>{{__t('explore_courses')}}</li>
                                    @else
                                        <li class='breadcrumb-item active'>{{__t('courses')}}</li>
                                    @endif
                                @endif
                            @elseif($path === 'popular-courses')
                                <li class='breadcrumb-item active'> <i class="la la-bolt"></i> {{__t('popular_courses')}}</li>
                            @elseif($path === 'featured-courses')
                                <li class='breadcrumb-item active'> <i class="la la-bookmark"></i> {{__t('featured_courses')}}</li>
                            @endif
                        </ol>
                    </nav>
                    
                </div>

            </div>
        </div>

    </div>


    <div class="courses-container-wrap my-5">

        <form action="" id="course-filter-form" method="get">

            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-5">


                        <div class="course-filter-wrap">

                            @if(request('q'))
                                <input type="hidden" name="q" value="{{request('q')}}">
                            @endif

                            <?php
                                if(request('sort')=='because_you_viewed') {
                                    $old_cat_id = (isset($user) && $user->last_viewed_course!=NULL) ? $user->last_viewed_course->second_category_id : '';
                                    $old_topic_id = (isset($user) && $user->last_viewed_course!=NULL) ? $user->last_viewed_course->category_id : '';
                                } else if(request('sort')=='you_might_also_like') {
                                    $old_cat_id = (isset($user) && $user->last_wished_course!=NULL) ? $user->last_wished_course->second_category_id : '';
                                    $old_topic_id = (isset($user) && $user->last_wished_course!=NULL) ? $user->last_wished_course->category_id : '';
                                } else {
                                    $old_cat_id = request('category');
                                    $old_topic_id = request('topic');
                                }
                                $old_level = (array) request('level');
                                $old_price = (array) request('price');
                            ?>

                            @if($categories->count())

                                <div class="course-filter-form-group p-3 mb-4">
                                    <div class="form-group">
                                        <h4 class="mb-3">{{__t('category')}}</h4>

                                        <select name="category" id="course_category" class="form-control select2">
                                            <option value="">{{__t('select_category')}}</option>
                                            @foreach($categories as $category)
                                                <optgroup label="{{$category->category_name}}">
                                                    @if($category->sub_categories->count())
                                                        @foreach($category->sub_categories as $sub_category)
                                                            <option value="{{$sub_category->id}}" {{selected($sub_category->id, $old_cat_id)}} >{{$sub_category->category_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </optgroup>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <h4 class="mb-3">{{__t('topic')}} <span class="show-loader"></span> </h4>

                                        <select name="topic" id="course_topic" class="form-control select2">
                                            <option value="">{{__t('select_topic')}}</option>

                                            @foreach($topics as $topic)
                                                <option value="{{$topic->id}}" {{selected($topic->id, $old_topic_id)}}>
                                                    {{$topic->category_name}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            @endif


                            <div class="course-filter-form-group p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('course_level')}}</h4>
                                    @foreach(course_levels() as $key => $level)
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="level[]" value="{{$key}}" {{in_array($key, $old_level) ? 'checked="checked"' : ''}} >
                                            <span class="custom-control-label">{{$level}}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="course-filter-form-group p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('price')}}</h4>

                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="price[]" value="paid" {{in_array('paid', $old_price) ? 'checked="checked"' : '' }} >
                                        <span class="custom-control-label">{{__t('paid')}}</span>
                                    </label>

                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="price[]" value="free" {{in_array('free', $old_price) ? 'checked="checked"' : '' }}>
                                        <span class="custom-control-label">{{__t('free')}}</span>
                                    </label>

                                </div>
                            </div>

                            <div class="course-filter-form-group p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('ratings')}}</h4>
                                    <div class="filter-form-by-rating-field-wrap">
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="4.5" class="mr-2" {{checked('4.5', request('rating'))}} >
                                            {!! star_rating_generator(4.5) !!}
                                            <span class="ml-2">4.5 & {{__t('up')}}</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="4" class="mr-2" {{checked('4', request('rating'))}}>
                                            {!! star_rating_generator(4) !!}
                                            <span class="ml-2">4.0 & {{__t('up')}}</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="3" class="mr-2" {{checked('3', request('rating'))}}>
                                            {!! star_rating_generator(3) !!}
                                            <span class="ml-2">3.0 & {{__t('up')}}</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="2" class="mr-2" {{checked('2', request('rating'))}}>
                                            {!! star_rating_generator(2) !!}
                                            <span class="ml-2">2.0 & {{__t('up')}}</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="1" class="mr-2" {{checked('1', request('rating'))}}>
                                            {!! star_rating_generator(1) !!}
                                            <span class="ml-2">1.0 & {{__t('up')}}</span>
                                        </label>


                                    </div>
                                </div>
                            </div>


                            <div class="course-filter-form-group p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('video_duration')}}</h4>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="0_2" {{checked('0_2', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('0_2_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="3_5" {{checked('3_5', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('3_5_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="6_10" {{checked('6_10', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('6_10_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="11_20" {{checked('11_20', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('11_20_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="21" {{checked('21', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('21_hours')}}</span>
                                    </label>

                                </div>
                            </div>



                        </div>



                    </div>

                    <div class="col-lg-9 col-md-7">

                        <div class="course-sorting-form-wrap form-inline mb-4">

                            <div class="form-group mr-2 mb-2 mb-lg-0 filter-option d-none">
                                <button type="button" id="hide-course-filter-sidebar" class="btn btn-outline-dark">
                                    <i class="la la-filter"></i> {{__t('filter')}}  <!-- {{count(array_except(array_filter(request()->input()), 'q'))}} -->
                                </button>
                            </div>

                            <div class="form-group mr-2 mb-2 mb-lg-0 d-flex align-items-baseline">
                                <label class="filter-col mr-2" style="white-space:nowrap;">{{__t('per_page')}}:</label>
                                <select class="form-control" name="perpage">
                                    @for($i = 10; $i<=100; $i = $i + 10)
                                        <option value="{{$i}}" {{selected($i, request('perpage'))}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group mb-2 mb-lg-0">
                                <select class="form-control mr-2" name="sort">
                                    <option value="relevance" {{selected('relevance', request('sort'))}}>{{__t('most_relevant')}}</option>
                                    <option value="most-reviewed" {{selected('most-reviewed', request('sort'))}}>{{__t('most_reviewed')}}</option>
                                    <option value="highest-rated" {{selected('highest-rated', request('sort'))}}>{{__t('highest_rated')}}</option>
                                    <option value="newest" {{selected('newest', request('sort'))}}>{{__t('newest')}}</option>
                                    <option value="price-low-to-high" {{selected('price-low-to-high', request('sort'))}}>{{__t('lowest_price')}}</option>
                                    <option value="price-high-to-low" {{selected('price-high-to-low', request('sort'))}}>{{__t('highest_price')}}</option>

                                    <option value="popular_courses" {{selected('popular_courses', request('sort'))}}>{{__t('popular_courses')}}</option>
                                    <option value="featured_courses" {{selected('featured_courses', request('sort'))}}>{{__t('featured_courses')}}</option>
                                    <option value="most_viewed" {{selected('most_viewed', request('sort'))}}>{{__t('most_viewed_courses')}}</option>
                                    <option value="new_courses" {{selected('new_courses', request('sort'))}}>{{__t('new_arrival_courses')}}</option>
                                    @if(Auth::user())
                                        <option value="because_you_viewed" {{selected('because_you_viewed', request('sort'))}}>{!! sprintf(__t('because_you_viewed'), '') !!}</option>
                                        <option value="you_might_also_like" {{selected('you_might_also_like', request('sort'))}}>{{__t('you_might_also_lik')}}</option>
                                    @endif
                                </select>
                            </div>


                            <div class="form-group ml-md-auto">
                                <a href="{{route('courses')}}" class="btn btn-link border" style="color: #5022C3;"> <i class="la la-refresh"></i> {{__t('reset_filter')}}</a>
                            </div>
                        </div>


                        @if($courses->count())
                            <p class="text-muted mb-3">{{ sprintf(__t('pagination_info_show'), $courses->count(), $courses->total()) }}</p>

                            <div class="row">
                                


                                @foreach($courses as $course)
                                <div class="col-lg-6 col-xl-4 col-md-12 cls_alllistWidth">
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
                        @else
                            {!! no_data(__t('nothing_here'), __t('nothing_here_desc')) !!}
                        @endif

                        <div class="file-manager-footer-pagination-wrap my-5">
                        {!! $courses->links() !!}
                        </div>

                    </div>

                </div>

            </div>



        </form>

    </div>


@endsection
