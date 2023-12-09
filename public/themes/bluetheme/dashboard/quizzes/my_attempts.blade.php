@extends(theme('dashboard.layout'))


@section('content')

    @php
        $attempts = $auth_user->my_quiz_attempts()->with('user', 'quiz', 'course')->orderBy('ended_at', 'desc')->get();
    @endphp

    @if( $attempts->count())
     <div class="cls_table table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__t('details')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attempts as $attempt)
                <tr>
                    <td>#</td>
                    <td>
                        <p class="mb-3">{{$attempt->user->name}}</p>

                        <p class="mb-0 text-muted">
                            <strong>{{__t('quiz')}} : </strong> <a href="{{$attempt->quiz->url}}">{{$attempt->quiz->title}}</a>
                        </p>
                        <p class="mb-0 text-muted">
                            <strong>{{__t('course')}} : </strong> <a href="{{$attempt->course->url}}">{{$attempt->course->title}}</a>
                        </p>
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
