@extends(theme('layout-full'))

@section('content')

    @include(theme('template-part.content-navigation'), ['content' => $lecture])

    <div class="lecture-container-wrap d-flex">

        @include(theme('template-part.curriculum_item_sidebar'), ['content' => $lecture])

        <div class="lecture-container">

            <!-- <h2 class="lecture-title mb-4">{{$title}}</h2> -->

            @if($isOpen)
                @if($lecture->video_info())
                    @include(theme('video-player'), ['model' => $lecture])
                @endif

                <div class="lecture-content-article mt-4 px-5">
                    {!! clean_html($lecture->text) !!}
                </div>

                @if($lecture->attachments->count())
                    <div class="lecture-attachments border p-3 mt-5">
                        <h5 class="lecture-attachments-title mb-3">{{__t('downloadable_materials')}}</h5>
                        @foreach($lecture->attachments as $attachment)
                            @if($attachment->media)
                                <a href="{{route('attachment_download', $attachment->hash_id)}}" class="lecture-attachment mb-2 d-block">
                                    <i class="la la-cloud-download mr-2"></i>
                                    {{$attachment->media->slug_ext}} <small class="text-muted">({{$attachment->media->readable_size}})</small>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif

                @if(get_option('lms_settings.enable_discussion'))
                    @include(theme('template-part.discussion'), ['content' => $lecture])
                @endif

            @else

                <div class="lecture-contents-locked text-center mt-5">
                    <div class="lecture-lock-icon mb-4">
                        <i class="la la-lock"></i>
                    </div>
                    <h4 class="lecture-lock-title mb-4">{{__t('lecture_content_locked')}}</h4>

                    @if( ! auth()->check())
                        <p class="lecture-lock-desc mb-4">
                            {!! sprintf(__t('if_enrolled_login_text'), '<a href="'.route('login').'" class="open_login_modal">', '</a>') !!}
                        </p>
                    @endif

                    @if( auth()->check() && $lecture->drip->is_lock)

                        @if($isEnrolled)
                        <p>{!! clean_html($lecture->drip->message) !!}</p>
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

