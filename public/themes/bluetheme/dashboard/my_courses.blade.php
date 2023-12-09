@extends(theme('dashboard.layout'))

@section('content')

    <div class="curriculum-top-nav d-flex align-items-center mb-5 p-2">
        <h4 class="flex-grow-1 mb-0">{{__t('my_courses')}} </h4>
        <a href="{{route('create_course')}}" class="btn btn-warning">{{__t('create_course')}}</a>
    </div>

    @if($auth_user->courses->count())

        <div class="row">
            
            @foreach($auth_user->courses as $course)
            <div class="col-lg-3 col-md-4 cls_alllistWidth" data-course-id="{{$course->id}}">
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
                        <p>{{__t('by')}} {{ $course->author->name ? $course->author->name : '--' }}</p>
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
                            <p class="label-html">{!! $course->status_html() !!} {!! labelHtml($course->id) !!}</p>
                        </div>
                    </div>

                </a>
                <div class="tool_hover">
                    <div class="cls_allAbs">
                        <div class="cls_allsdf">
                            <h1>{{$course->title}}</h1>
                            <p class="mb-2 label-badge">
                                <span class="label-html">{!! $course->status_html() !!} {!! labelHtml($course->id) !!}</span></p>{{__t('updated')}}
                            <span style="font-weight:bold;color:#5022C3;">{{date('M Y', strtotime($course->last_updated_at))}}</span>
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
                               <li class="col-lg-6 col-12"><span class="tick_icon mr-2"><img src="{{url('uploads/images/Tick.svg')}}"></span>{{__t('by')}} {{ $course->author->name ? $course->author->name : '--' }}</li>
                               <li class="col-lg-6 col-12"><span class="tick_icon mr-2"><img src="{{url('uploads/images/Tick.svg')}}"></span>{{ ($course->second_category) ? $course->second_category->category_name : '--' }}</li>
                            </ul>
                            <div class="d-flex align-items-center">
                                <?php
                                    $in_cart = cart($course->id)
                                ?>
                                <button type="button" class="btn btn-md col-lg-7 btn-theme mt-2 add-to-cart-btn add-to-cart-btn-{{$course->id}} big_screen_padding" data-course-id="{{$course->id}}" data-content-id="add-to-cart-btn-{{$course->id}}" name="cart_btn" value="add_to_cart" {{$in_cart? 'disabled="disabled"' : ''}} data-incart-msg="{{__t('in_cart')}}" data-addcart-msg="{{__t('add_to_cart')}}" style="padding:7px 0px;">
                                    @if($in_cart)
                                        <i class='la la-check-circle'></i> {{__t('added_to_cart')}}
                                    @else
                                        <i class="la la-shopping-cart remv_space"></i> {{__t('add_to_cart')}}
                                    @endif
                                </button>
                                <!-- <a href="" class="btn btn-md btn-theme mt-2" style="flex:1;"><i class="la la-shopping-cart"></i> <span>{{ __t('add_to_cart') }} </span></a> -->

                                
                                <a href="javascript:;" class="course-card-update-wish course-card-update-wish-{{$course->id}} btn btn-dm btn-theme mt-2 ml-3 loadermove" title="{{ __t('remove_from_wishlist') }}" data-course-id="{{$course->id}}" data-content-id="course-card-update-wish-{{$course->id}}" data-page="home">
                                    @if($auth_user && in_array($course->id, $auth_user->get_option('wishlists', []) ))
                                        <i class="la la-heart"></i>
                                    @else
                                        <i class="la la-heart-o"></i>
                                    @endif
                                </a>
                                <a href="{{ route('edit_course_information', $course->id) }}" class="btn btn-dm btn-theme mt-2 ml-3 loadermove" data-course-id="{{$course->id}}" data-page="home">
                                    <i class="la la-pencil-square-o"></i>
                                </a>
                                <!-- <a href="" class="btn btn-dm btn-theme mt-2 ml-3" title="{{ __t('remove_from_wishlist') }}"><i class="la la-heart"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


     <!-- <div class="cls_table table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
            <tr>
                <th>{{__t('thumbnail')}}</th>
                <th>{{__t('title')}}</th>
                <th>{{__t('price')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($auth_user->courses as $course)
                <tr>
                    <td>
                        <img src="{{$course->thumbnail_url}}" width="80" />
                    </td>
                    <td>
                        <p class="mb-3">
                            <strong>{{$course->title}}</strong>
                            {!! $course->status_html() !!}
                        </p>

                        <p class="m-0 text-muted">
                            @php
                                $lectures_count = $course->lectures->count();
                                $assignments_count = $course->assignments->count();
                                $quizzes_count = $course->quizzes->count();
                            @endphp

                            <span class="course-list-lecture-count">{{$lectures_count}} {{__t('lectures')}}</span>

                            @if($assignments_count)
                                , <span class="course-list-assignment-count">{{$assignments_count}} {{__t('assignments')}}</span>
                            @endif
                            @if($quizzes_count)
                                , <span class="course-list-quiz-count">{{$quizzes_count}} {{__t('quizzes')}}</span>
                            @endif
                        </p>

                        <div class="courses-action-links mt-1">
                            <a href="{{route('edit_course_information', $course->id)}}" class="font-weight-bold mr-3">
                                <i class="la la-pencil-square-o"></i> {{__t('edit')}}
                            </a>

                            @if($course->status == 1)
                                <a href="{{route('course', $course->slug)}}" class="font-weight-bold mr-3" target="_blank"><i class="la la-eye"></i> {{__t('view')}} </a>
                            @else
                                <a href="{{route('course', $course->slug)}}" class="font-weight-bold mr-3" target="_blank"><i class="la la-eye"></i> {{__t('preview')}} </a>
                            @endif

                            @php do_action('my_courses_list_actions_after', $course); @endphp

                        </div>
                    </td>
                    <td>{!! $course->price_html() !!}</td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </div> -->
    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-5' ) !!}
        <div class="no-data-wrap text-center">
            <a href="{{route('create_course')}}" class="btn btn-lg btn-warning">{{__t('create_course')}}</a>
        </div>
    @endif

@endsection
