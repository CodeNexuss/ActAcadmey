@extends(theme('layout-full'))

@section('content')

    @include(theme('template-part.content-navigation'), ['content' => $quiz])
    <div class="lecture-container-wrap d-flex">
        @include(theme('template-part.curriculum_item_sidebar'), ['content' => $quiz])
        <div class="lecture-container p-3">

            @if($isEnrolled)

                <h2 class="lecture-title mb-4"> {!! $quiz->icon_html !!} {{$title}}</h2>

                <div class="quiz-instruction-wrapper">

                    @php
                        $attempt = $auth_user->get_attempt($quiz->id);
                    @endphp

                    @if(! $attempt || $attempt->status !== 'finished')
                        <div class="assignment-header-info mb-4 p-3">
                            <h4 class="mb-4">{{__t('instructions')}}</h4>

                            <p class="assignment-basic-info mb-2">
                                <span class="mr-4"> <i class="la la-clock"></i> <strong> {{__t('time_duration')}} : </strong> {{$quiz->option('time_limit')}} {{__t('minutes')}} </span>

                                <span class="mr-4"><i class="la la-chart-pie"></i> <strong> {{__t('total_questions')}} : </strong> {{$quiz->option('questions_limit')}}</span>
                                <span class="mr-4"><i class="la la-check-circle"></i> <strong> {{__t('min_pass_score')}} : </strong> {{$quiz->option('passing_score')}}%</span>
                            </p>

                            <p class="font-italic text-muted m-0">
                                {{__t('quiz_instruction_text')}}
                            </p>
                        </div>
                    @endif



                    @if($attempt)
                        @if($attempt->status == 'started')
                            <div class="alert alert-warning">
                                {{__t('ur_quiz_started')}}
                            </div>
                            <div id="start-quiz-btn-wrapper" class="mt-5">
                                <button id="btn-start-quiz" class="btn btn-success btn-lg" data-quiz-id="{{$quiz->id}}">
                                    <i class="la la-play-circle"></i> {{__t('continue_quiz')}}
                                </button>
                            </div>
                        @endif

                        @if($attempt->status === 'in_review')
                            <div class="bg-light-sky p-4 border d-flex quiz-submitted-alert">
                                <h1 class="mr-3">
                                    <i class="la la-info-circle"></i>
                                </h1>
                                <div>
                                    <h3>{{__t('quiz_result_in_review')}}</h3>
                                    <p>{{__t('quiz_result_in_review_text')}}</p>
                                </div>
                            </div>
                        @endif

                        @if($attempt->status === 'finished')

                            <div class="quiz-attempt-time-wrap bg-white p-2 border mb-3">
                                <p class="mb-0">
                                    <strong><i class="la la-clock"></i> {{__t('start_time')}}:</strong> {{$attempt->created_at->format(date_time_format())}},
                                    <strong><i class="la la-clock"></i> {{__t('end_time')}}:</strong> {{$attempt->ended_at->format(date_time_format())}},
                                    <span class="text-info">
                                        <strong><i class="la la-clock"></i> {{__t('time_required')}}:</strong>
                                        {{$attempt->ended_at->diffInMinutes($attempt->created_at)}} {{__t('minutes')}}
                                    </span>
                                </p>
                            </div>

                            <div class="quiz-attempt-stats quiz_table mb-3">
                                <ul class="list-group list-group-horizontal">
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
                                        <p class="mb-2"><strong>{{ __t('count_on_grade') }}</strong></p>

                                        @if($attempt->quiz_gradable)
                                            <p class="mb-1 text-success">{{__a('yes')}}</p>
                                        @else
                                            <p class="mb-1 text-muted">{{__a('no')}}</p>
                                        @endif
                                    </li>
                                </ul>
                                <ul class="list-group list-group-horizontal">

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
                                </ul>

                            </div>


                            <div class="quiz-result-gretings">
                                @if($attempt->passed)
                                    <div class="bg-success text-white p-3 border text-center">
                                        <span class="greetings-icon"><i class="la la-trophy"></i> </span>
                                        <h2>{{__t('congratulations')}}</h2>
                                        <h3 class="mb-3">{!! sprintf(__t('u_passed_with_score_text'), $passing_score, $passing_percent) !!}</h3>
                                    </div>
                                @else
                                    <div class="bg-warning p-3 border text-center">
                                        <span class="greetings-icon"><i class="la la-exclamation-circle"></i> </span>
                                        <h2>{{__t('failed')}}</h2>
                                        <h3 class="mb-3">{{__t('unfortunately_not_passed')}}</h3>
                                    </div>
                                @endif
                            </div>

                            <h4 class="my-4">{{__t('u_can_review_ur_ans_below')}}</h4>

                            @php
                                $answers = $attempt->answers()->with('question', 'question.options')->get();
                            @endphp

                            @if($answers->count())

                                <div class="attempt-given-answers-wrap">
                                    <div class="row">

                                        @foreach($answers as $answer)
                                            @php
                                                $qtype = $answer->question->type;
                                            @endphp


                                            <div class="col-md-6">
                                                <div class="view-attempted-answer border p-3 mb-3">

                                                    <p class="text-success mb-0">
                                                        <span class="badge badge-info mr-3"> <i class="la la-question-{{$qtype}}"></i> {{$qtype}}</span>

                                                        @if($answer->is_correct)
                                                            <span class="text-success"><i class="la la-check-circle"></i> {{__t('correct')}}</span>
                                                        @endif

                                                    </p>

                                                    <p class="mt-3">
                                                        {{$answer->question->title}}
                                                    </p>

                                                    <h4 class="text-muted">{{__t('answer')}}</h4>

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

                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>

                            @endif

                        @endif

                    @else
                        <div id="start-quiz-btn-wrapper" class="mt-5">
                            <button id="btn-start-quiz" class="btn btn-success btn-lg" data-quiz-id="{{$quiz->id}}">
                                <i class="la la-play-circle"></i> {{__t('start_quiz')}}
                            </button>
                        </div>
                    @endif

                </div>

            @else
                <div class="lecture-contents-locked text-center mt-5">
                    <div class="lecture-lock-icon mb-4">
                        <i class="la la-lock"></i>
                    </div>
                    <h4 class="lecture-lock-title mb-4">{{__t('quiz_content_locked')}}</h4>
                    @if( ! auth()->check())
                        <p class="lecture-lock-desc mb-4">
                            {!! sprintf(__t('if_enrolled_login_text'), '<a href="'.route('login').'" class="open_login_modal">', '</a>') !!}
                        </p>
                    @endif

                    @if( auth()->check() && $quiz->drip->is_lock)

                        @if($isEnrolledQuiz)
                            <p>{!! clean_html($quiz->drip->message) !!}</p>
                        @else
                            <a href="{{route('course', $course->slug)}}" class="btn btn-theme-primary btn-lg">{{__t('enroll_course_to_unlock')}}</a>
                        @endif

                    @else
                    <a href="{{route('course', $course->slug)}}" class="btn btn-theme-primary btn-lg">{{__t('enroll_course_to_unlock')}}</a>
                    @endif
                </div>
            @endif
        </div>
    </div>

@endsection

