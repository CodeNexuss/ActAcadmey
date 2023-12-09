@extends(theme('dashboard.layout'))


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_assignments')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('courses_assignments', $course->id)}}">{{__t('assignments')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__t('assignment_submission')}}</li>
            <li class="breadcrumb-item active">{{__t('evaluate_submission')}}</li>
        </ol>
    </nav>

    @if($assignments->count())
     <div class="cls_table table-responsive">
        <table class="table table-bordered bg-white">

           <thead>
           <tr>
               <th>{{__t('assignments')}} {{__t('title')}}</th>
           </tr>
           </thead>
           <tbody>
            @foreach($assignments as $assignment)

                <tr>
                    <td>
                        <p class="mb-3">
                            <strong>
                                <a href="{{route('assignment_submissions', $assignment->id)}}">{{$assignment->title}}</a>
                            </strong>
                        </p>

                        <div class="course-list-lectures-counts text-muted">
                            <p class="m-0">{{__t('submissions')}} : {{$assignment->submissions->count()}}</p>
                        </div>

                    </td>

                </tr>

            @endforeach
            </tbody>

        </table>
    </div>


        {!! $assignments->links() !!}

    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc')) !!}
    @endif




@endsection
