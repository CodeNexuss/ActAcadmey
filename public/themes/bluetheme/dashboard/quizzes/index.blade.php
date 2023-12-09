@extends(theme('dashboard.layout'))


@section('content')

    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_quiz')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__t('quizzes')}}</li>
            <li class="breadcrumb-item active" aria-current="page">{{__t('quiz_attempts')}}</li>
            <li class="breadcrumb-item active">{{__t('review')}}</li>
        </ol>
    </nav> -->

    @if($courses->count())
     <div class="cls_table table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
            <tr>
                <th>{{__t('thumbnail')}}</th>
                <th>{{__t('title')}}</th>
                <th>{{__t('price')}}</th>
                <th>{{__a('actions')}}</th>
            </tr>   
            </thead>
            <tbody>

            @foreach($courses as $course)

                <tr>
                    <td><img src="{{$course->thumbnail_url}}" width="80" /></td>
                    <td>
                        <p class="mb-3">
                            <a href="{{route('course', $course->slug)}}"target="_blank"><strong>{{$course->title}}</strong></a>
                            {!! $course->status_html() !!} {!! labelHtml($course->id) !!}
                        </p>

                        <div class="course-list-lectures-counts text-muted">
                            <p class="m-0">{{__t('quizzes')}} : {{$course->quizzes->count()}}</p>
                            <p class="m-0">{{__t('quiz_attempts')}} : {{$course->quiz_attempts->count()}}</p>
                        </div>

                    </td>
                    <td>{!! $course->price_html() !!}</td>
                    <td>
                        <a href="{{route('courses_quizzes', $course->id)}}" class="btn btn-dark-blue">
                            <i class="la la-check-double"></i> {{__t('quizzes')}} </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc')) !!}
    @endif




@endsection
