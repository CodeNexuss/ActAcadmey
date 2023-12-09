
<div id="course-discussion-wrap">

    <div class="discusion-calltoaction-wrap text-center py-4 bg-dark-blue text-white my-4">
        <h1><i class="la la-question-circle-o"></i> </h1>
        <h3>{{__t('discussions')}}</h3>
        <h5>{!! __t('discussion_sub_text_frontend') !!}</h5>
    </div>

    <div class="discussion-ask-question-form bg-light my-4 p-4">

        <form action="{{route('ask_question')}}" method="post">
            @csrf
            <input type="hidden" name="content_id" value="{{$content->id}}">
            <div class="form-group {!! form_error($errors, 'title')->class !!}">
                <label class="">{{__t('question_title')}}</label>
                <input type="text" class="form-control" name="title" value="">
                {!! form_error($errors, 'title')->message !!}
            </div>

            <div class="form-group {!! form_error($errors, 'message')->class !!}">
                <label>{{__t('question_details')}}</label>
                <textarea class="form-control" name="message" rows="5"></textarea>
                {!! form_error($errors, 'message')->message !!}
            </div>

            <button type="submit" class="btn btn-purple"><i class="la la-question-circle-o"></i> {{__t('ask_question')}} </button>
        </form>

    </div>


    <div id="content-discussions-list-wrap">


        @foreach($content->discussions as $discussion)

            <div class="discussion-single-wrap border p-3 mb-4">

                <div class="discussion-user row justify-content-center justify-content-md-start mb-4 text-center text-md-left">
                    <div class="reviewed-user-photo col-lg-1 col-md-3 mb-2 mb-md-0 mx-0">
                        <a class="d-inline-block" href="{{route('profile', $discussion->user->id)}}">
                            {!! $discussion->user->get_photo !!}
                        </a>
                    </div>
                    <div class="discussion-user-name col-lg-10 col-md-8 pl-1">

                        <a href="{{route('profile', $discussion->user->id)}}">{!! $discussion->user->name !!}</a>
                        <p class="mb-0">
                            <a href="{{route('review', $discussion->id)}}" class="text-muted " >{{$discussion->created_at->diffForHumans()}}</a>
                        </p>
                    </div>
                </div>

                <h4 class="mb-4"> {{$discussion->title}}</h4>

                <div class="discusison-details-wrap mb-4">
                    {!! nl2br(clean_html($discussion->message)) !!}
                </div>

                @if($discussion->replies->count())
                    @foreach($discussion->replies as $reply)
                        <div class="discussion-reply-wrap border p-3 bg-white">
                            <div class="discussion-user row justify-content-center justify-content-md-start mb-4">
                                <div class="reviewed-user-photo col-lg-1 col-md-3 mb-2 mb-md-0 mr-0 mx-0">
                                    <a class="d-inline-block" href="{{route('profile', $reply->user->id)}}">
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
                                        {!! nl2br(clean_html($reply->message)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


                <div class="discussion-reply-form bg-white my-4">
                    <form action="{{route('discussion_reply_student', $discussion->id)}}" method="post">
                        @csrf

                        <div class="form-group {!! form_error($errors, 'message')->class !!}">
                            <textarea class="form-control" name="message" rows="5"></textarea>
                            {!! form_error($errors, 'message')->message !!}
                        </div>
                        <button type="submit" class="btn btn-purple"><i class="la la-question-circle-o"></i> {{__t('send_reply')}} </button>
                    </form>
                </div>

            </div>

        @endforeach


    </div>

</div>
