<div class="section-item-form-html  p-lg-4 p-2 border">

    <div class="new-lecture-form-header d-flex mb-3 pb-3 border-bottom">
        <h5 class="flex-grow-1">{{__t('edit_'.$item->item_type)}}</h5>
        <a href="javascript:;" class="btn btn-outline-dark btn-sm btn-cancel-form" ><i class="la la-close"></i> </a>
    </div>

    <div class="curriculum-item-edit-tab list-group list-group-horizontal-md mb-3 text-center  ">
        <a href="javascript:;" data-tab="#lecture-basic" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary active ">
            <i class="la la-file-text"></i> {{__t('basic')}}
        </a>
        <a href="javascript:;" data-tab="#lecture-video" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary ">
            <i class="la la-video"></i> {{__t('video')}}
        </a>
        <a href="javascript:;" data-tab="#dashboard-lecture-attachments" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary ">
            <i class="la la-paperclip"></i> {{__t('attachments')}}
        </a>
    </div>

    <form class="curriculum-edit-lecture-form" action="{{route('update_lecture', [$item->course_id, $item->id])}}" method="post">
        @csrf

        <div class="lecture-request-response"></div>


        <div id="lecture-basic" class="section-item-tab-wrap" style="display: block;">

            <div class="form-group">
                <label for="title">{{__t('title')}}</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$item->title}}"  >
            </div>

            <div class="form-group">
                <label for="description">{{__t('description')}}</label>
                <textarea name="description" class="form-control ajaxCkeditor" rows="5">{!! $item->text !!}</textarea>
            </div>

            <div class="form-group d-flex">
                <span class="mr-4">{{__t('free_preview')}}</span>
                <label class="switch">
                    <input type="checkbox" name="is_preview" value="1" {{checked(1, $item->is_preview)}} >
                    <span></span>
                </label>
            </div>

        </div>


        <div id="lecture-video" class="section-item-tab-wrap" style="display: none;">

            @php
                $video_source = $item->video_info('source');
            @endphp

            <div class="lecture-video-upload-wrap">

                <select name="video[source]" class="lecture_video_source form-control mb-2">
                    <option value="-1">{{__t('select_video_src')}}</option>
                    <option value="html5" {{selected($video_source, 'html5')}} >HTML5 (mp4)</option>
                    <option value="external_url" {{selected($video_source, 'external_url')}}>External URL</option>
                    <option value="youtube" {{selected($video_source, 'youtube')}}>YouTube</option>
                    <option value="vimeo" {{selected($video_source, 'vimeo')}}>Vimeo</option>
                    <option value="embedded" {{selected($video_source, 'embedded')}}>Embedded</option>
                </select>

                <p class="video-file-type-desc">
                    <small class="text-muted">{{__t('select_ur_pref_videotype')}} </small>
                </p>

                <div class="video-source-input-wrap mb-5" style="display: {{$video_source? 'block' : 'none'}};">

                    <div class="video-source-item video_source_wrap_html5 border bg-white p-4" style="display: {{$video_source == 'html5'? 'block' : 'none'}};">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="video-upload-wrap text-center">
                                    <i class="la la-cloud-upload text-muted"></i>
                                    <h5>{{__t('upload_video')}}</h5>
                                    <p class="mb-2">{{__t('file_format')}}:  .mp4</p>
                                    {!! media_upload_form('video[html5_video_id]', __t('upload_video'), null, $item->video_info('html5_video_id')) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="video-poster-upload-wrap text-center">
                                    <i class="la la-image text-muted"></i>
                                    <h5>{{__t('video_poster')}}</h5>
                                    <small class="text-muted mb-3 d-block">{{__t('supports_image_format')}}</small>

                                    {!! image_upload_form('video[html5_video_poster_id]', $item->video_info('html5_video_poster_id')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="video-source-item video_source_wrap_external_url" style="display: {{$video_source == 'external_url'? 'block' : 'none'}};">
                        <input type="text" name="video[source_external_url]" class="form-control" value="{{$item->video_info('source_external_url')}}" placeholder="External Video URL">
                    </div>
                    <div class="video-source-item video_source_wrap_youtube" style="display: {{$video_source == 'youtube'? 'block' : 'none'}};">
                        <input type="text" name="video[source_youtube]" class="form-control" value="{{$item->video_info('source_youtube')}}" placeholder="YouTube Video URL">
                    </div>
                    <div class="video-source-item video_source_wrap_vimeo" style="display: {{$video_source == 'vimeo'? 'block' : 'none'}};">
                        <input type="text" name="video[source_vimeo]" class="form-control" value="{{$item->video_info('source_vimeo')}}" placeholder="Vimeo Video URL">
                    </div>
                    <div class="video-source-item video_source_wrap_embedded" style="display: {{$video_source == 'embedded'? 'block' : 'none'}};">
                        <textarea name="video[source_embedded]" class="form-control" placeholder="Place your embedded code here">{!! $item->video_info('source_embedded') !!}</textarea>
                    </div>

                    <div class="video-playback-time-wrap mt-4">
                        @php
                        $hours = $item->video_info('runtime.hours');
                        $mins = $item->video_info('runtime.mins');
                        $secs = $item->video_info('runtime.secs');
                        @endphp
                        <div class="input-group d-flex">
                            <div class="input-group-prepend mb-2 mb-md-0 col-md-5 col-lg-3 pr-0" style="flex-basis:275px;">
                                <span class="input-group-text">
                                    {{__t('video_runtime')}} - &nbsp;<strong>hh:mm:ss</strong></span>
                            </div>
                            <div class="d-flex col-md-7 col-lg-8 pl-3 pl-md-0">
                            <input type="text" class="form-control" name="video[runtime][hours]" value="{{$hours?$hours:'00'}}" style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">
                            <input type="text" class="form-control" name="video[runtime][mins]" value="{{$mins?$mins:'00'}}">
                            <input type="text" class="form-control" name="video[runtime][secs]" value="{{$secs?$secs:'00'}}">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="dashboard-lecture-attachments" class="section-item-tab-wrap" style="display: none;">


            <div class="dashboard-attachments-upload-body border bg-white p-2 mb-4">

                <div class="attachment-upload-forms-wrap d-flex flex-wrap justify-content-start"></div>

                <div id="upload-attachments-hidden-form" style="display: none">
                    <div class="single-attachment-form mb-3 border">
                        <div class="d-flex align-items-center p-3">
                            {!! media_upload_form('attachments[]', __t('upload_attachments')) !!}
                            <a href="javascript:;" class="btn btn-outline-danger btn-sm btn-remove-lecture-attachment-form ml-4"><i class="la la-close"></i> </a>
                        </div>
                    </div>
                </div>

                @if($item->attachments->count())
                    <div class="dashboard-section-item-attachments border p-3">

                        <h5 class="downloadable-materials mb-4">{{__t('downloadable_materials')}}</h5>

                        @foreach($item->attachments as $attachment)
                            @if($attachment->media)

                                <div class="dashboard-item-attachment d-flex flex-wrap align-items-center border p-2 mb-2 rounded">
                                    <span class="attachment-icon mr-2"><i class="la la-cloud-download"></i> </span>
                                    <span class="attachment-title flex-grow-1" style="word-break:break-all;">
                                        {{$attachment->media->slug_ext}} <small class="text-muted">({{$attachment->media->readable_size}})</small>
                                    </span>
                                    <span>
                                        <button class="section-item-attachment-delete-btn text-danger btn" data-attachment-id="{{$attachment->id}}"><i class="la la-trash"></i> </button>
                                    </span>
                                </div>

                            @endif
                        @endforeach
                    </div>

                @endif

                <a href="javascript:;" id="add_more_attachment_btn" class="my-4 d-inline-block btn btn-outline-info"> <i class="la la-plus"></i>  {{__t('attachments')}} </a>

            </div>

        </div>

        <div class="form-group text-lg-right text-center">
            <button type="button" class="btn btn-outline-info btn-cancel-form mb-lg-0"> {{__t('cancel')}}</button>
            <button type="submit" class="btn btn-info btn-edit-lecture"  name="save" value="save_next"> <i class="la la-save"></i> {{__t('save_'.$item->item_type)}}</button>
        </div>

    </form>

</div>
