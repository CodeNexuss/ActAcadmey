@extends(theme('layout-full'))

@section('content')

    @include(theme('template-part.content-navigation'), ['content' => $assignment])

    <div class="lecture-container-wrap d-flex">

        @include(theme('template-part.curriculum_item_sidebar'), ['content' => $assignment])

        <div class="lecture-container p-3">

            @if($isEnrolled)

            <h2 class="lecture-title mb-4"> {!! $assignment->icon_html !!} {{$title}}</h2>

            <div class="assignment-header-info mb-4 p-3">
                <p class="assignment-basic-info mb-1">
                    <span class="mr-4"> <i class="la la-clock"></i> <strong> {{__t('time_duration')}} : </strong> {{$assignment->option('time_duration.time_value').' '.$assignment->option('time_duration.time_type')}} </span>

                    <span class="mr-4"><i class="la la-chart-pie"></i> <strong> {{__t('total_number')}} : </strong> {{$assignment->option('total_number')}}</span>
                    <span class="mr-4"><i class="la la-check-circle"></i> <strong> {{__t('minimum_pass_number')}} : </strong> {{$assignment->option('pass_number')}}</span>
                </p>

                <?php
                $upload_attachment_limit = $assignment->option('upload_attachment_limit');
                $upload_attachment_size_limit = $assignment->option('upload_attachment_size_limit');
                ?>
                @if($upload_attachment_limit > 0)
                    <p class="font-italic text-muted m-0">{{sprintf(__t('assignment_attachment_limit_desc'), $upload_attachment_limit, $upload_attachment_size_limit.' MB' )}}</p>
                @endif

            </div>

            

                @if($has_submission && $has_submission->status === 'submitted')
                    <div class="bg-light border p-3 my-4">

                        @if($has_submission->is_evaluated)
                            <div class="alert alert-success">
                                <h5 class="text-success mt-2"><i class="la la-check-circle-o"></i> {{__t('submission_evaluated')}} </h5>
                                <p class="text-muted m-0"> {{__t('evaluated_by')}}: <strong>{{$has_submission->instructor->name}}</strong></p>
                                <p class="text-muted"> {{__t('evaluated_at')}}: {{$has_submission->evaluated_at->format(date_time_format())}}</p>
                            </div>

                            <div class="submission-result-wrap text-center my-5">
                                <h4>
                                    {!! sprintf(__t('assignment_you_got_score'), $has_submission->earned_numbers, $assignment->option('total_number')) !!}
                                </h4>

                                @php
                                $earned_parcent = $has_submission->earned_numbers * 100 / $assignment->option('total_number');

                                $is_passed = $has_submission->earned_numbers >= $assignment->option('pass_number');

                                $border_color = 'warning';
                                if ($is_passed){
                                    $border_color = 'success';
                                }
                                @endphp

                                <!-- Progress bar -->
                                <div class="progress circle mx-auto my-3" data-value="{{$earned_parcent}}" style="height:60px;">
                                <span class="progress-left">
                                    <span class="progress-bar border-{{$border_color}}"></span>
                                </span>
                                    <span class="progress-right">
                                    <span class="progress-bar border-{{$border_color}}"></span>
                                </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                        <div class="h2 font-weight-bold mt-2">{{$earned_parcent}}<sup class="small">%</sup></div>
                                    </div>
                                </div>
                                <!-- Progress END -->

                                <h5>{{__t('result')}} :
                                    @if($is_passed)
                                        <span class="text-success">{{__t('passed')}}</span>
                                    @else
                                        <span class="text-danger">{{__t('failed')}}</span>
                                    @endif
                                </h5>
                            </div>

                        @else

                            <h4 class="text-success mb-3"><i class="la la-check-circle"></i> {{__t('you_submitted_assignment')}}.</h4>

                            <div class="alert alert-warning">
                                <i class="la la-exclamation-triangle"></i> {{__t('submission_not_valuated_text')}}
                            </div>

                        @endif

                        <div class="assignment-submitted-was-wrap">

                            @if($has_submission->text_submission)
                                <h5 class="submission_title">{{__t('submission_text')}}</h5>

                                <div class="assignment-submission-text-wrap border bg-white p-3 my-3">
                                    {!! clean_html($has_submission->text_submission) !!}
                                </div>
                            @endif

                            @if($has_submission->attachments->count())
                                <div class="lecture-attachments bg-white border p-3 mt-4">
                                    <h5 class="lecture-attachments-title mb-3">{{__t('attachments')}}</h5>
                                    @foreach($has_submission->attachments as $attachment)
                                        @if($attachment->media)
                                            <a href="{{route('attachment_download', $attachment->hash_id)}}" class="lecture-attachment mb-2 d-block">
                                                <i class="la la-cloud-download mr-2"></i>
                                                {{$attachment->media->slug_ext}} <small class="text-muted">({{$attachment->media->readable_size}})</small>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>

                @endif

                <div class="lecture-content-article">
                    @if($assignment->text)
                        <h4 class="mb-3">{{__t('description')}}</h4>
                        {!! clean_html($assignment->text) !!}
                    @endif
                </div>

                @if($assignment->attachments->count())

                    <div class="lecture-attachments border p-3 mt-4">
                        <h5 class="lecture-attachments-title mb-3">{{__t('downloadable_materials')}}</h5>
                        @foreach($assignment->attachments as $attachment)
                            @if($attachment->media)
                                <a href="{{route('attachment_download', $attachment->hash_id)}}" class="lecture-attachment mb-2 d-block">
                                    <i class="la la-cloud-download mr-2"></i>
                                    {{$attachment->media->slug_ext}} <small class="text-muted">({{$attachment->media->readable_size}})</small>
                                </a>
                            @endif
                        @endforeach
                    </div>

                @endif

                @if($has_submission)

                    @if($has_submission->status === 'submitting')

                        @php
                            $upload_attachment_limit = (int) $assignment->option('upload_attachment_limit');
                        @endphp


                        <div id="assignment-submission-form" class="bg-light my-4 p-4">


                            <form action="{{route('single_assignment', [$course->slug, $assignment->id])}}" method="post">
                                @csrf

                                <input type="hidden" name="submission_type" value="submission">

                                <h4 class="mb-3">{{__t('submission_form')}}</h4>

                                <div class="form-group">
                                    <label for="assignment_text">{{__t('text_submission')}}</label>
                                    <textarea name="assignment_text" id="assignment_text" class="form-control" rows="10"></textarea>
                                    <small class="form-text text-muted my-3">{{__t('text_submission_desc')}}</small>
                                </div>


                                @if($upload_attachment_limit)
                                    <div class="form-group">
                                        <label>{{__t('attach_assignment_files')}}</label>

                                        <div class="row">
                                            @for($i = 1; $i<= $upload_attachment_limit; $i++)
                                                <div class="col-md-3 mb-4">
                                                    <div class="assignment-attachment-wrap bg-white p-3 text-center border">
                                                        {!! media_upload_form('assignment_attachments[]', '<i class="la la-paperclip"></i>'. __t('attach_file')) !!}
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-info btn-lg">{{__t('submit_assignment')}}</button>
                            </form>


                        </div>

                    @endif

                @else

                    <div class="submit-assignment-btn-wrap mt-4">
                        <form action="{{route('single_assignment', [$course->slug, $assignment->id])}}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-primary btn-lg">{{__t('ready_submit_assignment')}}</button>
                        </form>
                    </div>


                @endif

            @else

                <div class="lecture-contents-locked text-center mt-5">
                    <div class="lecture-lock-icon mb-4">
                        <i class="la la-lock"></i>
                    </div>
                    <h4 class="lecture-lock-title mb-4">{{__t('assignment_content_locked')}}</h4>

                    @if( ! auth()->check())
                        <p class="lecture-lock-desc mb-4">
                            {!! sprintf(__t('if_enrolled_login_text'), '<a href="'.route('login').'" class="open_login_modal">', '</a>') !!}
                        </p>
                    @endif

                    @if( auth()->check() && $assignment->drip->is_lock)

                        @if($isEnrolledAssignment)
                            <p>{!! clean_html($assignment->drip->message) !!}</p>
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

@section('page-js')
    <script src="{{ asset('assets/js/filemanager.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        if($('#assignment_text').length) {
            CKEDITOR.replace('assignment_text', {removeButtons: 'Image,RemoveFormat,Source,Subscript,Superscript,Table,HorizontalRule,SpecialChar'});
        }
    </script>
@endsection
