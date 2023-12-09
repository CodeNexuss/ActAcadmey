<div class="section-item-form-html  p-2 border cls_right">

    <div class="new-quiz-form-header d-flex mb-3 pb-3 border-bottom">
        <h5 class="flex-grow-1">{{__t('edit_'.$item->item_type)}}</h5>
        <a href="javascript:;" class="btn btn-outline-dark btn-sm btn-cancel-form" ><i class="la la-close"></i> </a>
    </div>

    <div class="curriculum-item-edit-tab list-group list-group-horizontal-md mb-3 text-center  ">
        <a href="javascript:;" data-tab="#quiz-basic" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary active ">
            <i class="la la-file-text"></i> {{__t('basic')}}
        </a>
        <a href="javascript:;" id="quiz-questions-tab-item" data-tab="#quiz-questions" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary ">
            <i class="la la-question-circle"></i> {{__t('questions')}}
        </a>
        <a href="javascript:;" data-tab="#quiz-settings" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary ">
            <i class="la la-cog"></i> {{__t('settings')}}
        </a>
    </div>

    <form class="curriculum-edit-quiz-form" action="{{route('update_quiz', [$item->course_id, $item->id])}}" method="post">
        @csrf

        <div class="quiz-request-response"></div>

        <div id="quiz-basic" class="section-item-tab-wrap" style="display: block;">
            <div class="form-group">
                <label for="title">{{__t('title')}}</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$item->title}}"  >
            </div>

            <div class="form-group">
                <label for="description">{{__t('description')}}</label>
                <textarea name="description" class="form-control ajaxCkeditor" rows="5">{!! $item->text !!}</textarea>
            </div>

            <!-- Quiz Save Button -->
            <div class="form-group text-lg-right text-center quiz-save-btn">
                <button type="button" class="btn btn-outline-info btn-cancel-form">
                    {{__t('cancel')}}</button>
                <button type="submit" class="btn cls_gray_btn btn-edit-quiz" name="save" value="save_next"> <i
                        class="la la-save"></i> {{__t('save_'.$item->item_type)}}</button>
            </div>

        </div>

        <div id="quiz-questions" class="section-item-tab-wrap mb-5" style="display: none;">

            <div id="quiz-questions-wrap" class="mb-4">
                @include(theme('dashboard.courses.quiz.questions'), ['quiz' => $item])
            </div>

            <button type="button" id="quiz-add-question-btn" class="btn cls_gray_btn btn-block mt-5">
                <i class="la la-plus-circle"></i> {{__t('add_question')}}
            </button>


        </div>


        <div id="quiz-settings" class="section-item-tab-wrap" style="display: none;">


            <div id="quiz-settings-wrap">

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">{{__t('gradable')}}</label>
                    <div class="col-sm-8">
                        {!! switch_field('quiz_gradable', __t('quiz_gradable'), $item->quiz_gradable) !!}
                        <p class="text-muted">
                            <small>{{__t('quiz_gradable_text')}}</small>
                        </p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">{{__t('remain_time_disp')}}</label>
                    <div class="col-sm-8">
                        {!! switch_field('quiz_option[show_time]', __t('show_time'), $item->option('show_time')) !!}
                        <p class="text-muted">
                            <small>{{__t('remain_time_disp_text')}}</small>
                        </p>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{__t('time_limit')}}</label>
                        <div class="input-group d-block">
                            <div class="time-input d-flex">
                                <input type="number" class="form-control" name="quiz_option[time_limit]"
                                    value="{{$item->option('time_limit')}}">
                                <div class="input-group-append min-field">
                                    <span class="input-group-text">{{__t('minutes')}}</span>
                                </div>
                            </div>
                            <div class="py-2">
                                <p class="text-muted"><small>{{__t('set_0_disable_min')}}</small></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group  col-md-4">
                        <label>{{__t('passing_score')}} (%)</label>
                        <input type="number" class="form-control" name="quiz_option[passing_score]"
                            value="{{$item->option('passing_score')}}">
                        <p class="text-muted"><small>{{__t('passing_score_text')}}</small></p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>{{__t('questions_limit')}}</label>
                        <input type="number" class="form-control" name="quiz_option[questions_limit]"
                            value="{{$item->option('questions_limit', 10)}}">
                        <p class="text-muted"><small>{{__t('questions_limit_text')}}</small></p>
                    </div>

                </div>


                <!-- Quiz Save Button -->
                <div class="form-group text-lg-right text-center">
                    <button type="button" class="btn btn-outline-info btn-cancel-form">
                        {{__t('cancel')}}</button>
                    <button type="submit" class="btn cls_gray_btn btn-edit-quiz" name="save" value="save_next"> <i
                            class="la la-save"></i> {{__t('save_'.$item->item_type)}}</button>
                </div>

            </div>



        </div>



    </form>

</div>








<div id="questionTypesHiddenFormHtml" style="display: none;">
    <!-- Question Type Radio -->
    <div id="quizQuestionWrapType_radio">

        <div class="quiz-question-form-wrap question-type-radio bg-white border p-4">

            <div class="question-basic-info  mb-1 d-flex justify-content-between flex-wrap flex-column flex-lg-row">
                <div class="question-title">
                    <div class="form-group">
                        <label>{{__t('question_title')}}</label>
                        <input type="text" name="question_title" class="form-control"
                            placeholder="{{__t('question_title')}}">
                    </div>
                </div>
                <div class="question-image-wrap">
                    <div class="form-group">
                        <label>{{__t('image')}}</label>
                        {!! image_upload_form('image_id') !!}
                    </div>
                </div>

                <div class="question-score">
                    <div class="form-group">
                        <label>{{__t('score')}}</label>
                        <input type="number" name="score" class="form-control" placeholder="{{__t('score')}}">
                    </div>
                </div>
            </div>

            <div class="question-options-wrap">
                
                <div class="question-opt my-2" data-type="radio">
                    <div class="form-group m-0">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="options[{index}][title]" value="" placeholder="{{__t('option_title')}}">
                            <div class="input-group-append">
                                <a href="javascript:;" class="input-group-text question-opt-trash"><i
                                        class="la la-trash"></i> </a>
                                <a href="javascript:;" class="input-group-text"><i class="la la-sort"></i> </a>
                            </div>
                        </div>

                        <div class="question-opt-footer d-flex align-items-center mt-3 flex-wrap">
                            <div class="question-opt-image">
                                {!! image_upload_form('options[{index}][image_id]') !!}
                            </div>
                            <div class="question-opt-display flex-grow-1 ml-lg-4 ml-0 mt-2 mt-lg-0">
                                <p class="mb-2">{{__t('disp_preference')}}</p>

                                <label class="mr-2">
                                    <input type="radio" name="options[{index}][d_pref]" value="text" checked="checked">
                                    {{__t('text')}}
                                </label>
                                <label class="mr-2">
                                    <input type="radio" name="options[{index}][d_pref]" value="image"> {{__t('image')}}
                                </label>
                                <label class="mr-2">
                                    <input type="radio" name="options[{index}][d_pref]" value="both"> {{__t('both')}}
                                </label>
                            </div>
                            <label class="m-0 mt-1 text-right checkbox d-flex align-items-center">
                                {{__t('correct_ans')}} <input type="checkbox" class="is_correct_input mx-1"
                                    name="options[{index}][is_correct]" value="1"><span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- Question Type Text/TextArea -->
    <div id="quizQuestionWrapType_text">
        <div class="quiz-question-form-wrap question-type-radio bg-white border p-4">
            <div class="question-basic-info  mb-1 d-flex justify-content-between flex-wrap flex-column flex-lg-row">
                <div class="question-title">
                    <div class="form-group">
                        <label>{{__t('question_title')}}</label>
                        <input type="text" name="question_title" class="form-control"
                            placeholder="{{__t('question_title')}}">
                    </div>
                </div>
                <div class="question-image-wrap">
                    <div class="form-group">
                        <label>{{__t('image')}}</label>
                        {!! image_upload_form('image_id') !!}
                    </div>
                </div>

                <div class="question-score">
                    <div class="form-group">
                        <label>{{__t('score')}}</label>
                        <input type="number" name="score" class="form-control" placeholder="{{__t('score')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Question Form Modal -->
<div class="modal fade p-0" id="quizQuestionTypeMoal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__t('question_type')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('create_question', [$item->course_id, $item->id])}}" method="post"
                id="create-question-form">
                @csrf

                <div class="modal-body">

                    <div class="form-group option-type-selection-wrapper quiz_option_select d-flex d-lg-block flex-wrap">
                        <input type="radio" id="input_option_type_radio" name="question_type" class="d-none"
                            value="radio">
                        <label class="px-3 py-2 list-group-item list-group-item-action list-group-item-info" for="input_option_type_radio">
                            <i class="la la-dot-circle"></i> {{__t('single_choice')}}
                        </label>

                        <input type="radio" id="input_option_type_checkbox" name="question_type" class="d-none"
                            value="checkbox">
                        <label class="px-3 py-2 list-group-item list-group-item-action list-group-item-info" for="input_option_type_checkbox">
                            <i class="la la-check-square"></i> {{__t('multiple_choice')}}
                        </label>

                        <input type="radio" id="input_option_type_text" name="question_type" class="d-none"
                            value="text">
                        <label class="px-3 py-2 list-group-item list-group-item-action list-group-item-info" for="input_option_type_text">
                            <i class="la la-pencil-square"></i> {{__t('single_line_text')}}
                        </label>

                        <input type="radio" id="input_option_type_textarea" name="question_type" class="d-none"
                            value="textarea">
                        <label class="px-3 py-2 list-group-item list-group-item-action list-group-item-info" for="input_option_type_textarea">
                            <i class="la la-file-text"></i> {{__t('multi_line_text')}}
                        </label>
                    </div>

                    <div id="questionRequestResponse"></div>

                    <div id="questionTypeFormModal"></div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple"><i class="la la-save"></i>
                        {{__t('save_question')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__t('close')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@push("scripts")
<script>

//Request cab active number


</script>
@endpush
