@extends(theme('dashboard.layout'))


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_assignments')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('courses_assignments', $assignment->course_id)}}">{{__t('assignments')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('assignment_submissions', $assignment->id)}}">{{__t('assignment_submission')}}</a></li>
            <li class="breadcrumb-item active">{{__t('evaluate_submission')}}</li>
        </ol>
    </nav>

    @if($submissions->count())
     <div class="cls_table table-responsive">
        <table class="table table-bordered bg-white">

            <thead>
            <tr>
                <th>{{__t('student')}}</th>
                <th>{{__t('numbers')}}</th>
                <th>{{__t('result')}}</th>
                <th>{{__a('actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissions as $submission)

                <tr>
                    <td>
                        @if($submission->student)
                            {{$submission->student->name}}
                        @endif

                        <p class="mt-3 mb-0 text-muted">
                            {{__t('time')}}: {{$submission->created_at->format(get_option('date_format').' '.get_option('time_format'))}}
                        </p>

                    </td>
                    <td>

                        <div class="course-list-lectures-counts text-muted">
                            <p class="m-0">{{__t('total_number')}} : {{$submission->assignment->option('total_number')}}</p>
                            <p class="m-0">{{__t('minimum_pass_number')}} : {{$submission->assignment->option('pass_number')}}</p>
                        </div>

                    </td>

                    <td>
                        @if( ! $submission->is_evaluated)
                            <span class="badge badge-warning">{{__t('pending')}}</span>
                        @else
                            <span class="badge badge-success">{{__t('evaluated')}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('assignment_submission', $submission->id)}}" class="btn btn-info">{{__t('view_submission')}}</a>
                    </td>

                </tr>

            @endforeach
            </tbody>

        </table>
    </div>


        {!! $submissions->links() !!}

    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc')) !!}
    @endif




@endsection
