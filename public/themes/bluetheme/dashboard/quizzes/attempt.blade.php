@extends(theme('dashboard.layout'))


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_quiz')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item"> <a href="{{route('courses_quizzes', $attempt->course_id)}}">{{__t('quizzes')}}</a></li>
            <li class="breadcrumb-item"> <a href="{{route('quiz_attempts', $attempt->quiz_id)}}">{{__t('quiz_attempts')}} </a> </li>
            <li class="breadcrumb-item active">{{__t('review')}}</li>
        </ol>
    </nav>

    <div class="attempt-review-wrap">
        <div class="attempt-view-header border bg-white p-4 d-flex mb-3">
            <div class="reviewed-user-photo">
                <a href="{{route('profile', $attempt->user->id)}}">
                    {!! $attempt->user->get_photo !!}
                </a>
            </div>
            <div class="attempt-details">
                <a href="{{route('profile', $attempt->user->id)}}">{!! $attempt->user->name !!}</a>
                <p class="mb-0">
                    <small>
                        <small><i class="la la-clock-o"></i> {{$attempt->created_at->diffForHumans()}}</small>

                        <strong>{{__t('course')}} :</strong>
                        <a href="{{$attempt->course->url}}" class="text-info" target="_blank">
                            {{$attempt->course->title}}
                        </a>
                        <i class="la la-arrow-right"></i>
                        <strong>{{__t('quiz')}} :</strong>
                        <a href="{{$attempt->quiz->url}}">
                            {{$attempt->quiz->title}}
                        </a>
                    </small>
                </p>

            </div>
        </div>

        <div class="quiz-attempt-time-wrap bg-white p-2 border mb-3">
            <p class="mb-0">
                @if($attempt->created_at)
                    <strong><i class="la la-clock"></i> {{__t('start_time')}}:</strong> {{$attempt->created_at->format(date_time_format())}},
                @endif
                @if($attempt->ended_at)
                    <strong><i class="la la-clock"></i> {{__t('end_time')}}:</strong> {{$attempt->ended_at->format(date_time_format())}},
                @endif
                @if($attempt->ended_at)
                    <span class="text-info">
                    <strong><i class="la la-clock"></i> {{__t('time_required')}}:</strong>
                    {{$attempt->ended_at->diffInMinutes($attempt->created_at)}} {{__t('minutes')}}
                </span>
                @endif
            </p>
        </div>
        <div class="quiz-attempt-stats quiz_table mb-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">{{__t('total_questions')}}</th>
                        <th scope="col">{{__t('total_score')}}</th>
                        <th scope="col">{{__t('total_answered')}}</th>
                        <th scope="col">{{__t('count_on_grade')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td scope="row">{{$attempt->questions_limit}}</td>
                        <td>{{$attempt->total_scores}}</td>
                        <td>{{$attempt->total_answered}}</td>
                        <td>
                            @if($attempt->quiz_gradable)
                                <p class="mb-1 text-success">{{__t('yes')}}</p>
                            @else
                                <p class="mb-1 text-muted">{{__t('no')}}</p>
                            @endif
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">{{__t('passing_score')}}</th>
                        <th scope="col">{{__t('earned_score')}}</th>
                        <th scope="col">{{__t('result')}}</th>
                        <th scope="col">{{__t('status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td scope="row">
                        <p class="mb-1">
                                @php
                                    $passing_percent = (int) $attempt->quiz->option('passing_score');

                                    $passing_score = 0;
                                    if ($passing_percent){
                                        $passing_score = ($attempt->total_scores * $attempt->quiz->option('passing_score')) / 100;
                                    }
                                @endphp
                                {{$passing_score}} ({{$passing_percent}}%)
                            </p>
                        </td>
                        <td>{{$attempt->earned_scores}} ({{$attempt->earned_percent}}%)</td>
                        <td>
                            @if($attempt->earned_percent >= $passing_percent)
                                <p class="mb-1 text-success"> <strong> <i class="la la-check-circle"></i> {{__t('passed')}}</strong> </p>
                            @else
                                <p class="mb-1 text-danger"> <strong> <i class="la la-exclamation-circle"></i> {{__t('failed')}}</strong> </p>
                            @endif
                        </td>
                        <td>
                        {!! $attempt->status_html !!}
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       

        <div class="quiz-attempt-stats quiz_table mb-3">
            <!-- <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('total_questions')}}</strong></p>
                    <p class="mb-1">{{$attempt->questions_limit}}</p>
                </li>
                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('total_score')}}</strong></p>
                    <p class="mb-1">{{$attempt->total_scores}}</p>
                </li>
                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('total_answered')}}</strong></p>
                    <p class="mb-1">{{$attempt->total_answered}}</p>
                </li>
                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('count_on_grade')}}</strong></p>

                    @if($attempt->quiz_gradable)
                        <p class="mb-1 text-success">{{__t('yes')}}</p>
                    @else
                        <p class="mb-1 text-muted">{{__t('no')}}</p>
                    @endif
                </li>
            </ul> -->
            <!-- <ul class="list-group list-group-horizontal">

                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('passing_score')}}</strong></p>
                    <p class="mb-1">
                        @php
                            $passing_percent = (int) $attempt->quiz->option('passing_score');

                            $passing_score = 0;
                            if ($passing_percent){
                                $passing_score = ($attempt->total_scores * $attempt->quiz->option('passing_score')) / 100;
                            }
                        @endphp
                        {{$passing_score}} ({{$passing_percent}}%)
                    </p>
                </li>

                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('earned_score')}}</strong></p>
                    <p class="mb-1">{{$attempt->earned_scores}} ({{$attempt->earned_percent}}%)</p>
                </li>
                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('result')}}</strong></p>
                    @if($attempt->earned_percent >= $passing_percent)
                        <p class="mb-1 text-success"> <strong> <i class="la la-check-circle"></i> {{__t('passed')}}</strong> </p>
                    @else
                        <p class="mb-1 text-danger"> <strong> <i class="la la-exclamation-circle"></i> {{__t('failed')}}</strong> </p>
                    @endif
                </li>
                <li class="list-group-item">
                    <p class="mb-2"><strong>{{__t('status')}}</strong></p>
                    <p class="mb-1">
                        {!! $attempt->status_html !!}
                    </p>
                </li>
            </ul> -->

        </div>

        <form method="post">
            @csrf


            @php
                $answers = $attempt->answers()->with('question', 'question.options')->get();
            @endphp

            @if($answers->count())
                <h4 class="my-4"> <i class="la la-info-circle"></i> {{__t('review_attempt_info_text')}}</h4>

                 <div class="cls_table table-responsive">
                    <table class="table table-bordered bg-white">
                        <thead>
                        <tr>
                            <th>{{__t('question')}}</th>
                            <th>{{__t('given_answer')}}</th>
                            <th>{{__t('question')}} <br /> {{__t('scores')}}</th>
                            <th>{{__t('review')}} <br /> {{__t('scores')}}</th>
                            <th>{{__t('correct')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($answers as $answer)
                            @php
                                $qtype = $answer->question->type;
                            @endphp

                            <tr>
                                <td>
                                    <span class="badge badge-info"> <i class="la la-question-{{$qtype}}"></i> {{$qtype}}</span> <br />
                                    {{$answer->question->title}}
                                </td>
                                <td>

                                    @if($qtype === 'text' || $qtype === 'textarea')
                                        <p>{!! nl2br($answer->answer) !!}</p>
                                    @elseif($qtype === 'radio' || $qtype === 'checkbox')

                                        @php
                                            $options = $answer->question->options->pluck('title', 'id')->toArray()
                                        @endphp

                                        @if($qtype === 'radio' &&  $answer->answer)
                                            <p class="mb-0"> <i class="la la-question-{{$qtype}}"></i>
                                                {{array_get($options, $answer->answer)}}
                                            </p>
                                        @elseif($qtype === 'checkbox' &&  $answer->answer)
                                            @foreach(json_decode($answer->answer, true) as $answeredKey)
                                                <p class="mb-0"> <i class="la la-question-{{$qtype}}"></i> {{array_get($options, $answeredKey)}}</p>
                                            @endforeach
                                        @endif
                                    @endif
                                </td>
                                <td>{{$answer->q_score}}</td>
                                <td width="50">
                                    <input type="text" class="form-control" name="answers[{{$answer->id}}][review_score]" value="{{$answer->r_score}}">
                                </td>
                                <td>
                                    <label class="checkbox m-0 d-flex align-items-center">
                                        {{__t('correct')}}
                                        <input type="checkbox" class="mx-1" name="answers[{{$answer->id}}][is_correct]" value="1" {{checked(1, $answer->is_correct)}}>
                                        <span></span>
                                    </label>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                {!! no_data('No answers found to review this attempt') !!}
            @endif

            @if( $attempt )
                <div class="form-group d-lg-flex text-center mt-3">

                    @if($answers->count())
                        <button type="submit" class="btn btn-warning mr-auto mb-lg-0 mb-3 mb-md-0" name="review_btn" value="review" > <i class="la la-save"></i> {{__t('review_attempt')}}</button>
                    @endif

                    <!-- <button type="submit" class="btn cls_gray_btn ml-auto" name="review_btn" value="delete" > <i class="la la-trash"></i> {{__t('delete_attempt')}}</button> -->

                </div>
            @endif

        </form>

    </div>

@endsection
