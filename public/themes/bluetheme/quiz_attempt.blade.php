@extends(theme('layout-full'))

@section('content')

@php
$q_number = $answered->count() + 1;
$q_limit = $attempt->questions_limit;
@endphp

<div class="question-top-nav py-3 px-4 bg-dark-blue text-white">
    <h4 class="m-0"><i class="la la-clipboard-list"></i> {{$quiz->title}}</h4>
</div>

<div class="quiz-wrap mt-2 mt-lg-4">

    <div class="container">

        <div class="col-lg-8 offset-lg-2 col-sm-12">

            <div class="question-wrap">

                <form action="{{route('quiz_attempt_url', $quiz->id)}}" method="post" class="quiz-question-submit">
                    @csrf

                    <input type="hidden" name="question_type" value="{{$question->type}}">
                    @if($question->image_id)
                    <div class="quiz-image mb-3">
                        <img src="{{$question->image_url->original}}" />
                    </div>
                    @endif

                    <h2 class="question-title d-flex mb-3">
                        <span><i class="la la-question-circle mr-3"></i></span>
                        <span>{{$question->title}}</span>
                    </h2>

                    <div class="question-single-wrap pl-md-4">
                        @if( $question->type === 'radio' || $question->type === 'checkbox')
                        <div class="attempt-options-wrap d-flex mb-4 flex-wrap">
                            @foreach($question->options as $option)
                            <div class="question-option pr-4">
                                <label class="{{$question->type}} m-0">
                                    <input type="{{$question->type}}"
                                        name="questions[{{$question->id}}]{{$question->type === 'checkbox' ? '[]' : ''}}"
                                        value="{{$option->id}}"><span></span>
                                    {{$option->title}}
                                </label>
                            </div>

                            @endforeach
                        </div>
                        @elseif($question->type === 'text' )
                        <div class="form-group">
                            <input type="text" class="form-control" name="questions[{{$question->id}}]"
                                placeholder="{{__t('write_ur_ans')}}">
                        </div>
                        @elseif($question->type === 'textarea')
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="questions[{{$question->id}}]"></textarea>
                            <p class="text-muted my-3"><small>{{__t('write_ur_ans_text')}}</small></p>
                        </div>
                        @endif
                    </div>

                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-9 order-2 order-md-1">
                            <div id="quiz-progress">
                                <div class="container p-0 m-0">
                                    <div class="row m-0">
                                        <div class="col-lg-12 col-sm-12 py-2">
                                            @for($progress = 1; $progress <= $q_limit; $progress++) <span
                                                class="quiz-progress-number {{$progress == $q_number ? 'active' : ''}}">{{$progress}}</span>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 order-1 order-md-2">
                            <div class="nxt_btn text-right">
                            <button type="submit" name="question-submit-btn"
                        class="btn btn-dark-blue btn-lg question-submit-btn">
                        @if($q_number == $q_limit)
                        {{__t('finish')}} <i class="la la-angle-right"></i>
                        @else
                        {{__t('next')}} <i class="la la-angle-right"></i>
                        @endif
                        </button>
                            </div>
                        

                        </div>
                    </div>
                    

                </form>
            </div>


        </div>

    </div>
</div>

<div id="questionRequiredAlertModal" class="modal" role="dialog">
    <div class="modal-dialog modal-alert">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>{{__t('must_ans_question')}}:</h4>
                <p>{{$question->title}}</p>
                <button type="button" class="btn btn-info btn-wide" data-dismiss="modal">{{__t('ok')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection