<div class="section-item-form-html p-4 border">
    <div class="update-assignment-form-header d-flex mb-3 pb-3 border-bottom">
        <h5 class="flex-grow-1">{{__t('update_assignment')}}</h5>
        <a href="javascript:;" class="btn btn-outline-dark btn-sm btn-cancel-form" ><i class="la la-close"></i> </a>
    </div>

    <form class="update-assignment-form" action="{{route('update_assignment', [$item->course_id, $item->id])}}" method="post">

        <div class="assignment-request-response"></div>

        @csrf
        <div class="form-group">
            <label for="title">{{__t('title')}}</label>
            <input type="text" name="title" value="{{$item->title}}" class="form-control"  >
        </div>

        <div class="form-group">
            <label for="description">{{__t('description')}}</label>
            <textarea name="description" class="form-control ajaxCkeditor" rows="5">{!! $item->text !!}</textarea>
        </div>

        <div class="form-group border-bottom py-3">

            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <label>{{__t('time_duration')}}</label>
                    <div class="form-row">
                        <div class="col">
                            <input type="number" class="form-control mb-3 mb-md-0" name="assignment_option[time_duration][time_value]" value="{{$item->option('time_duration.time_value')}}">
                        </div>

                        <div class="col">
                            <select class="form-control" name="assignment_option[time_duration][time_type]">
                                <option value="weeks" {{selected($item->option('time_duration.time_type'), 'weeks')}} >{{__t('weeks')}}</option>
                                <option value="days" {{selected($item->option('time_duration.time_type'), 'days')}}>{{__t('days')}}</option>
                                <option value="hours" {{selected($item->option('time_duration.time_type'), 'hours')}}>{{__t('hours')}}</option>
                            </select>
                        </div>
                    </div>
                    <small class="text-muted">{{__t('assignment_time_desc')}}</small>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label>{{__t('total_number')}}</label>
                    <input type="number" name="assignment_option[total_number]" value="{{$item->option('total_number')}}" class="form-control"  >
                    <small class="text-muted">{{__t('total_number_desc')}}</small>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>{{__t('minimum_pass_number')}}</label>
                    <input type="number" name="assignment_option[pass_number]" value="{{$item->option('pass_number')}}" class="form-control"  >
                    <small class="text-muted">{{__t('minimum_pass_number_desc')}}</small>
                </div>

            </div>
        </div>


        <div class="form-group py-3">

            <div class="form-row">

                <div class="col-lg-4 col-md-6">
                    <label>{{__t('upload_attachment_limit')}}</label>
                    <input type="number" name="assignment_option[upload_attachment_limit]" value="{{$item->option('upload_attachment_limit')}}" class="form-control"  >
                    <small class="text-muted">
                        {{__t('max_attach_size_limit')}}
                    </small>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label>{{__t('max_attach_size_limit')}}</label>
                    <input type="number" name="assignment_option[upload_attachment_size_limit]" value="{{$item->option('upload_attachment_size_limit')}}" class="form-control"  >
                    <small class="text-muted">
                        {{__t('max_attach_size_limit_desc')}}
                    </small>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="dashboard-attachments-upload-body border bg-white p-4 mb-4">

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
                                        <button type="button" class="section-item-attachment-delete-btn text-danger btn" data-attachment-id="{{$attachment->id}}"><i class="la la-trash"></i> </button>
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <a href="javascript:;" id="add_more_attachment_btn" class="mt-4 mb-2 d-inline-block btn btn-outline-info"> <i class="la la-plus"></i>  {{__t('attachments')}} </a>

                <p class="m-0"> <small class="text-muted">{{__t('assignment_resources_desc')}}</small></p>
            </div>
        </div>


        <div class="form-group text-lg-right text-center">
            <button type="button" class="btn btn-outline-info btn-cancel-form mb-lg-0 mb-3"> {{__t('cancel')}}</button>
            <button type="submit" class="btn btn-info btn-save-assignment my-2"  name="save" value="save_next"> <i class="la la-save"></i> {{__t('save_assignment')}}</button>
        </div>
    </form>
</div>
