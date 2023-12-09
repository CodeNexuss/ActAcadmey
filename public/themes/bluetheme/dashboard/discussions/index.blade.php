@extends(theme('dashboard.layout'))


@section('content')

    @php
        $discussions = $auth_user->instructor_discussions()->with('course', 'content')->orderBy('replied', 'asc')->orderBy('updated_at', 'desc')->paginate(20);
    @endphp

    @if($discussions->count())
        @foreach($discussions as $discussion)
            <div class="discussion-single-wrap border p-3 mb-4 rounded {{$discussion->replied ? 'bg-light-success' : 'bg-white' }} ">
                <div class="discussion-user d-flex mb-4">
                    <div class="reviewed-user-photo">
                        <a href="{{route('profile', $discussion->user->id)}}">
                            {!! $discussion->user->get_photo !!}
                        </a>
                    </div>
                    <div class="discussion-detials">
                        <a href="{{route('profile', $discussion->user->id)}}">{!! $discussion->user->name !!}</a>
                        <p class="text-muted mb-0">
                            <small>{{$discussion->created_at->diffForHumans()}}</small>
                        </p>
                        <p class="text-muted">
                            <a href="{{$discussion->course->url}}" class="text-info" target="_blank">
                                {{$discussion->course->title}}
                            </a>
                            <i class="la la-arrow-right"></i> {{$discussion->content->title}}
                        </p>

                        <a href="{{route('discussion_reply', $discussion->id)}}" class="mb-4 d-block">
                            <h4> <i class="la la-question-circle-o"></i> {{$discussion->title}}</h4>
                        </a>
                        <a href="{{route('discussion_reply', $discussion->id)}}" class="btn btn-purple btn-sm">{{__t('view_question')}}</a>
                    </div>
                </div>
            </div>

        @endforeach

    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc')) !!}
    @endif


    {!! $discussions->links() !!}


@endsection
