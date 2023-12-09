<?php
$gridClass = $grid_class ? $grid_class : 'col-lg-4 col-md-6';
?>

<div class="col-lg-4 col-md-6 course-card-grid-wrap course-card-items">
    <div class="course-card mb-3">

        <div class="course-card-img-wrap">
            <a href="{{route('course', $course->slug)}}">
                <img src="{{$course->thumbnail_url}}" class="img-fluid" />
            </a>

            <button class="course-card-add-wish btn btn-link btn-sm p-0" data-course-id="{{$course->id}}">
                @if($auth_user && in_array($course->id, $auth_user->get_option('wishlists', []) ))
                    <i class="la la-heart"></i>
                @else
                    <i class="la la-heart-o"></i>
                @endif
            </button>
        </div>

        <div class="course-card-contents py-3">
            <a href="{{route('course', $course->slug)}}">
                <h4 class="course-card-title mb-3">{{$course->title}}</h4>
                <p class="course-card-short-info mb-2 d-flex justify-content-between">
                    <span><i class="la la-play-circle"></i> {{$course->total_lectures}} {{__t('lectures')}}</span>
                    <span><i class="la la-signal"></i> {{course_levels($course->level)}}</span>
                </p>
            </a>

            <div class="course-card-info-wrap">
                <p class="course-card-author d-flex justify-content-between">
                    <span>
                        
                    </span>
                    @if($course->category)
                        <span>
                            <i class="la la-folder"></i> {{__t('in')}} <a href="{{route('category_view', $course->category->slug)}}">{{$course->category->category_name}}</a>
                        </span>
                    @endif
                </p>
                @if($course->rating_count)
                    <div class="course-card-ratings">
                        <div class="star-ratings-group d-flex">
                            {!! star_rating_generator($course->rating_value) !!}
                            <span class="star-ratings-point mx-2"><b>{{$course->rating_value}}</b></span>
                            <span class="text-muted star-ratings-count">({{$course->rating_count}})</span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="course-card-footer mt-3">
                <div class="course-card-cart-wrap align-items-center d-flex justify-content-between">
                    {!! $course->price_html(false, false) !!}

                    <div class="course-card-btn-wrap">
                        @if($auth_user && in_array($course->id, $auth_user->get_option('enrolled_courses', []) ))
                            <a href="{{route('course', $course->slug)}}">{{__t('enrolled')}}</a>
                        @else
                            @php($in_cart = cart($course->id))
                            <button type="button" class="btn btn-sm btn-theme-primary add-to-cart-btn"  data-course-id="{{$course->id}}" {{$in_cart? 'disabled="disabled"' : ''}}>
                                @if($in_cart)
                                    <i class='la la-check-circle'></i> {{__t('in_cart')}}
                                @else
                                    <i class="la la-shopping-cart"></i> {{__t('add_to_cart')}}
                                @endif
                            </button>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
