@extends(theme('dashboard.layout'))

@section('content')

    @if($auth_user->courses->count())
     <div class="cls_table table-responsive">
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
                            {!! $course->status_html() !!} {!! labelHtml($course->id) !!}
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

                            @if(route_has('student_progress'))
                                <a href="{{route('student_progress', $course->id)}}" class="font-weight-bold mr-3">
                                    <i class="la la-pie-chart"></i>
                                    {{__t('students_progress_report')}}
                                </a>
                            @endif
                        </div>
                    </td>
                    <td>{!! $course->price_html() !!}</td>


                </tr>

            @endforeach
            </tbody>

        </table>
    </div>
    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-5' ) !!}
        <div class="no-data-wrap text-center">
            <a href="{{route('create_course')}}" class="btn btn-lg btn-warning">{{__t('create_course')}}</a>
        </div>
    @endif

@endsection
