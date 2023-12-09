<div id="filemanager" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body" style="border-bottom:1px solid #80808047;">
            <div class="row">
                <div class="col-sm-5 order-2 order-sm-0">

                    <a href="{{route('load_filemanager')}}" data-toggle="tooltip" title="" id="button-refresh" class="btn btn-default" data-original-title="Refresh"><i class="la la-refresh"></i></a>

                    <button type="button" data-toggle="tooltip" title="{{__t('upload')}}" id="button-upload" class="btn btn-primary"><i class="la la-upload"></i></button>
                    <button type="button" data-toggle="tooltip" title="{{__t('insert_media')}}" class="btn btn-info mediaInsertBtn"><i class="la la-plus-circle"></i></button>
                    <button type="button" data-toggle="tooltip" title="{{__t('delete')}}" id="button-delete" class="btn btn-danger"><i class="la la-trash-o"></i></button>
                </div>

                <div class="col-sm-6 order-3 order-sm-0 mt-3 mt-sm-0">
                    <div class="input-group align-items-center">
                        <input type="text" name="filemanager-search" value="{{request('filter_name')}}" placeholder="{{__t('search')}}" class="form-control stop_scroll" style="border-radius:8px;">
                        <span class="input-group-btn">
                            <button type="button" data-toggle="tooltip" title="{{__t('search')}}" id="button-search" class="btn btn-primary ml-2">
                                <i class="la la-search"></i>
                            </button>
                        </span>
                    </div>
                </div>

                <div class="col-sm-1 order-1 order-sm-0">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

            </div>

            <div class="row mt-2 mb-0">
                <div class="col-sm-12">
                    <p class="mb-0 allowed_file_text"> {{__t('allowed_file_types')}} :
                        <code>{{get_option('allowed_file_types')}}</code>
                    </p>
                </div>
            </div>

            <hr class="mb-0" />
            <div class="row">
                <div class="col-md-12">
                    <div id="statusMsg"></div>
                </div>
            </div>

            <div class="media-modal-wrap d-flex">

                <div class="media-modal-thumbnail-wrap flex-grow-1 pt-3">

                    @if($medias->count())
                        <div class="media-manager-grid-wrap">
                            @foreach($medias as $media)
                                <div id="media-grid-id-{{$media->id}}" class="media-manager-single-grid">
                                    <a href="javascript:;" class="media-modal-thumbnail" data-media-info="{{json_encode($media->media_info)}}" >
                                        <img src="{{$media->thumbnail}}" alt="{{$media->name}}" title="{{$media->name}}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="media-modal-info-wrap bg-light p-3">

                    <div class="adminMediaModalInfoSide">
                        <p id="mediaModalFileID" class="m-1" style="word-break:break-all;"><strong>{{__t('id')}}:</strong> #<span></span></p>
                        <p id="mediaModalFileName" class="m-1" style="word-break:break-all;"><strong>{{__t('file_name')}}:</strong> <span></span></p>
                        <p id="mediaModalFileType" class="m-1" style="word-break:break-all;"><strong>{{__t('file_type')}}:</strong> <span></span></p>
                        <p id="mediaModalFileUploadedOn" class="m-1" style="word-break:break-all;"><strong>{{__t('uploaded_on')}}:</strong> <span></span></p>
                        <p id="mediaModalFileSize" class="m-1" style="word-break:break-all;"><strong>{{__t('file_size')}}:</strong> <span></span></p>
                    </div>

                    <hr />
                    <div class="media_set_size">
                    <img id="mediaManagerPreviewScreen" src="{{asset('uploads/placeholder-image.png')}}" class="mediaManagerPreviewScreen img-fluid" />
                    </div>
                   
                    <hr />

                    <form id="adminMediaManagerModalForm" method="post"> @csrf
                        <input type="hidden" id="sc_modal_info_media_id" name="media_id" value="">
                        <div class="form-group row">
                            <label for="mediaFileTitle" class="col-sm-4 col-md-2 col-xl-4 col-lg-4  col-form-label col-form-label-sm ml-auto ml-md-0">{{__t('title')}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm title_scroll" name="title" id="mediaFileTitle" placeholder="{{__t('title')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mediaFileAltText" class="col-sm-4 col-md-2 col-xl-4 col-lg-4 col-form-label col-form-label-sm ml-auto ml-md-0">{{__t('alt_text')}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm alt_scroll" name="alt_text" id="mediaFileAltText" placeholder="{{__t('alt_text')}}">

                                <div id="formWorkingIconWrap" class="my-3"></div>
                            </div>
                        </div>

                    </form>

                    <hr />

                    <button type="button" class="btn btn-info mediaInsertBtn">
                        <i class="la la-plus-circle"></i> {{__t('insert_selected_media')}}
                    </button>

                </div>

            </div>

            <br />
        </div>
        <div class="file-manager-footer-pagination-wrap my-5 px-3 ml-auto">
            {!! $medias->appends(['filter_name' => request('filter_name')])->links() !!}
        </div>
    </div>
</div>
