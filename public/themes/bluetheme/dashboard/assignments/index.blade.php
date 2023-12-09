@extends(theme('dashboard.layout'))


@section('content')

    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_assignments')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__t('assignments')}}</li>
            <li class="breadcrumb-item active" aria-current="page">{{__t('assignment_submission')}}</li>
            <li class="breadcrumb-item active">{{__t('evaluate_submission')}}</li>
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
                            <p class="m-0">{{__t('lectures')}} : {{$course->lectures->count()}}</p>
                            <p class="m-0">{{__t('assignments')}} : {{$course->assignments->count()}}</p>
                            <p class="m-0">{{__t('assignment_submission')}} : {{$course->assignment_submissions->count()}}</p>
                            <p class="m-0">{{__t('submission_waiting')}} : {{$course->assignment_submissions_waiting->count()}}</p>
                        </div>

                    </td>
                    <td>{!! $course->price_html() !!}</td>
                    <td>
                        <a href="{{route('courses_assignments', $course->id)}}" class="btn btn-info">{{__t('assignments')}} </a>
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
