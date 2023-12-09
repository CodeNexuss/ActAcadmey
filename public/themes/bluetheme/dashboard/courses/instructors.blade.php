@extends(theme('dashboard.layout'))


@section('content')

    @include(theme('dashboard.courses.course_nav'))

    <div class="row">
        <div class="col-md-12 mt-3">
            <div id="add-instructors-search-wrap" class="mb-4">

                <div id="instructor-search-wrap">

                    <form action="{{route('multi_instructor_search', $course->id)}}" method="post" id="instructor-search-form">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control" name="q" value="">
                                <p class="text-muted mb-2"><small>{{__t('search_instructors_desc')}}</small></p>
                                <div id="form-response-msg"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-theme-primary btn-block" style="height:49px">{{__t('search_instructors')}}</button>
                            </div>
                        </div>


                    </form>

                </div>

                <div id="instructor-search-results"></div>

            </div>

        </div>
    </div>



    <div class="row">

        <div class="col-md-12">


            <div class="course-default-author-wrap  mb-5 p-4 d-flex">

                @php
                    $author = $course->author;
                    $courses_count = $author->courses()->publish()->count();
                    $students_count = $author->student_enrolls->count();
                    $author_rating = $author->get_rating;
                @endphp

                <div class="instructor-stats mr-4">
                    <div class="profile-image">
                        <a href="{{route('profile', $author)}}">
                            {!! $author->get_photo !!}
                        </a>
                    </div>

                </div>

                <div class="instructor-details">
                    <h4 class="instructor-name">{{$author->name}} <span class="badge badge-info">{{__t('author')}}</span></h4>
                    @if($author->job_title)
                        <h5 class="instructor-designation">{{$author->job_title}}</h5>
                    @endif

                    <div class="course-default-author-stats-wrap d-flex mt-3">
                        @if($author_rating->rating_count)
                            <div class="profile-rating-wrap d-flex mr-3">
                                {!! star_rating_generator($author_rating->rating_avg) !!}
                                <p class="m-0 ml-2">({{$author_rating->rating_avg}})</p>
                            </div>
                        @endif

                        <p class="instructor-stat-value  mr-3">
                            <i class="la la-play-circle"></i>
                            <strong>{{$courses_count}}</strong> {{__t('courses')}}
                        </p>
                        <p class="instructor-stat-value  mr-3">
                            <i class="la la-user-circle"></i>
                            <strong>{{$students_count}}</strong> {{__t('students')}}
                        </p>
                        <p class="instructor-stat-value  mr-3">
                            <i class="la la-comments"></i>
                            <strong>{{$author_rating->rating_count}} </strong> {{__t('reviews')}}
                        </p>
                    </div>

                </div>

            </div>

            @php
                $instructors = $course->instructors()->where('users.id', '!=', $course->user_id)->get();
            @endphp

            @if($instructors->count())
                <div id="added-instructors-wrap">


                    @foreach($instructors as $instructor)


                        <div class="added-instructor-wrap bg-white mb-3 p-4 d-flex">

                            @php
                                $courses_count = $instructor->courses()->publish()->count();
                                $students_count = $instructor->student_enrolls->count();
                                $instructor_rating = $instructor->get_rating;
                            @endphp

                            <div class="instructor-stats mr-4">
                                <div class="profile-image">
                                    <a href="{{route('profile', $instructor)}}">
                                        {!! $instructor->get_photo !!}
                                    </a>
                                </div>
                            </div>

                            <div class="instructor-details flex-grow-1">
                                <h4 class="instructor-name">{{$instructor->name}}</h4>
                                @if($instructor->job_title)
                                    <h5 class="instructor-designation">{{$instructor->job_title}}</h5>
                                @endif

                                <div class="course-default-author-stats-wrap d-flex mt-3">
                                    @if($instructor_rating->rating_count)
                                        <div class="profile-rating-wrap d-flex mr-3">
                                            {!! star_rating_generator($instructor_rating->rating_avg) !!}
                                            <p class="m-0 ml-2">({{$instructor_rating->rating_avg}})</p>
                                        </div>
                                    @endif

                                    <p class="instructor-stat-value  mr-3">
                                        <i class="la la-play-circle"></i>
                                        <strong>{{$courses_count}}</strong> {{__t('courses')}}
                                    </p>
                                    <p class="instructor-stat-value  mr-3">
                                        <i class="la la-user-circle"></i>
                                        <strong>{{$students_count}}</strong> {{__t('students')}}
                                    </p>
                                    <p class="instructor-stat-value  mr-3">
                                        <i class="la la-comments"></i>
                                        <strong>{{$instructor_rating->rating_count}} </strong> {{__t('reviews')}}
                                    </p>
                                </div>

                            </div>


                            <div class="remove-instructor-btn-wrap">
                                <form action="{{route('remove_instructor', $course->id)}}" method="post">
                                    @csrf

                                    <input type="hidden" name="instructor_id" value="{{$instructor->id}}">

                                    <button type="submit" class="instructor-remove-btn btn btn-outline-danger"><i class="la la-trash"></i> </button>

                                </form>

                            </div>

                        </div>


                    @endforeach

                </div>
            @endif

        </div>
    </div>

@endsection
