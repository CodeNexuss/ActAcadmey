@extends(theme('dashboard.layout'))


@section('content')


    <div class="discussion-single-wrap border p-3 mb-4 bg-white">
        <div class="discussion-user row justify-content-center justify-content-md-start mb-4 text-center text-md-left">
            <div class="reviewed-user-photo col-lg-1 col-md-3 mb-2 mb-md-0 mx-0">
                <a href="{{route('profile', $discussion->user->id)}}">
                    {!! $discussion->user->get_photo !!}
                </a>
            </div>
            <div class="discussion-user-name col-lg-10 col-md-8 pl-1">
                <a href="{{route('profile', $discussion->user->id)}}">{!! $discussion->user->name !!}</a>
                <p class="">
                    <a href="{{route('review', $discussion->id)}}" class="text-muted " >{{$discussion->created_at->diffForHumans()}}</a>
                </p>

                <a href="{{route('discussion_reply', $discussion->id)}}">
                    <h4>{{$discussion->title}}</h4>
                </a>

                <div class="discusison-details-wrap">
                    {!! nl2br($discussion->message) !!}
                </div>

                @if($discussion->replies->count())
                    @foreach($discussion->replies as $reply)
                        <div class="discussion-single-wrap border p-3 mb-3 mt-4 bg-white">
                            <div class="discussion-user row justify-content-center justify-content-md-start mb-4 text-center text-md-left">
                                <div class="reviewed-user-photo col-lg-1 col-md-3 mb-2 mb-md-0 mx-0">
                                    <a href="{{route('profile', $reply->user->id)}}">
                                        {!! $reply->user->get_photo !!}
                                    </a>
                                </div>
                                <div class="discussion-user-name col-lg-10 col-md-8 pl-1">
                                    <a href="{{route('profile', $reply->user->id)}}">{!! $reply->user->name !!}</a>
                                    <p class="">
                                        <a href="{{route('review', $reply->id)}}" class="text-muted " >{{$reply->created_at->diffForHumans()}}</a>
                                    </p>

                                    <a href="{{route('discussion_reply', $reply->id)}}">
                                        <h4>{{$reply->title}}</h4>
                                    </a>

                                    <div class="discusison-details-wrap">
                                        {!! nl2br($reply->message) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>



    <div class="discussion-reply-form bg-white my-4 p-4">
        <form action="" method="post">
            @csrf

            <div class="form-group {!! form_error($errors, 'message')->class !!}">
                <textarea class="form-control" name="message" rows="5"></textarea>
                {!! form_error($errors, 'message')->message !!}
            </div>
            <button type="submit" class="btn btn-purple"><i class="la la-question-circle-o"></i> {{__t('send_reply')}} </button>
        </form>
    </div>

@endsection
