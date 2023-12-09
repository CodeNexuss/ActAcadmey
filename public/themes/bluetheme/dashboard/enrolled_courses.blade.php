@extends(theme('dashboard.layout'))

@section('content')

    @if($auth_user->enrolls->count())

    <div class="cls_alllist">
        <div class="row">
            @foreach($auth_user->enrolls as $course)
            <div class="col-lg-3 col-md-4 cls_alllistWidth">
                <a href="{{route('course', $course->slug)}}" class="listoutview mb-4 d-block">
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
                            <p class="label-html">{!! labelHtml($course->id) !!}</p>
                        </div>
                    </div>

                </a>
                <!-- <div class="cls_allAbs">
                    <div class="">
                        <h1>Management Skills: New Manager Training in Essential Skills</h1>
                        <p>Updated May 2020</p>
                        <div class="mb-2">
                            <span>All Level</span>
                            <span>Subtitles</span>
                        </div>
                        <h5>Discover our most popular courses for self learningcourses for self learning</h5>
                        <ul class="row p-0">
                            <li class="col-lg-6 col-12"><i class="la la-check"></i>14 Lectures</li>
                           <li class="col-lg-6 col-12"><i class="la la-check"></i>14 Lectures</li>
                           <li class="col-lg-6 col-12"><i class="la la-check"></i>14 Lectures</li>
                           <li class="col-lg-6 col-12"><i class="la la-check"></i>14 Lectures</li>
                        </ul>
                        <div class="d-flex align-items-center">
                            <a href="" class="btn btn-md btn-theme mt-2" style="flex:1;"><i class="la la-shopping-cart"></i> <span>Add to Cart </span></a>

                            <a href="" class="btn btn-dm btn-theme mt-2 ml-3"><i class="la la-heart"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
             @endforeach
        </div>
    </div>
    <!-- <div class="cls_table table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
            <tr>
                <th>{{__t('thumbnail')}}</th>
                <th>{{__t('title')}}</th>
                <th>{{__t('price')}}</th>
                <th>{{__t('actions')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($auth_user->enrolls as $course)
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
                                , <span class="course-list-assignment-count">{{$quizzes_count}} {{__t('quizzes')}}</span>
                            @endif

                        </p>
                    </td>
                    <td>{!! $course->price_html() !!}</td>

                    <td>
                        @if($course->status == 1)
                            <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-primary mt-2" target="_blank"><i class="la la-eye"></i> {{__t('view')}} </a>
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div> -->
    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-5' ) !!}
    @endif

@endsection
