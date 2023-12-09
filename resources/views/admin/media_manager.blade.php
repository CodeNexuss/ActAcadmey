@extends('layouts.admin')

@section('content')
    @include('inc.flash_msg')

    <div id="admin-media-manager-wrap">

        <div class="row my-3">
            <div class="col-sm-4">
                <button type="button" data-toggle="tooltip" title="{{__a('upload')}}" id="button-upload" class="btn btn-primary" data-upload-success="reload" ><i class="la la-upload"></i> {{__a('upload')}}</button>
            </div>

            <div class="col-sm-8">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" name="q" value="{{request('q')}}" placeholder="{{__a('search')}}" class="form-control mr-4">
                        <span class="input-group-btn">
                        <button type="submit" data-toggle="tooltip" title="{{__a('search')}}" id="button-search" class="btn btn-primary" style="    position: relative; right: 16px; height: 44px;">
                            <i class="la la-search"></i>
                        </button>
                    </span>
                    </div>
                </form>

            </div>
        </div>

        <div class="row my-3">
            <div class="col-sm-12">
                <p class="mb-0 allowed_file_text">
                    {{__a('found')}} <strong>{{$medias->total()}} </strong> {{__a('media')}} |
                    @lang('admin.allowed_file_types') :
                    <code>{{get_option('allowed_file_types')}}</code>
                </p>
            </div>
        </div>

        <div id="statusMsg" class="my-3"></div>

        @if($medias->count())
            <div class="media-manager-grid-wrap grid-photo-items">
                @foreach($medias as $media)
                {{$media->file_type}}
                    <div id="media-grid-id-{{$media->id}}" class="media-manager-single-grid">
                        <a href="javascript:;" data-toggle="sc-modal" data-target="#adminFileManagerModal" data-media-info="{{json_encode($media->media_info)}}" >

                            <img class="card-img-top" src="{{$media->thumbnail}}" alt="{{$media->name}}" title="{{$media->name}}" />
                        </a>
                    </div>
                @endforeach
            </div>

        @else

            {!! no_data() !!}

        @endif

        <div class="file-manager-footer-pagination-wrap my-5 d-flex justify-content-end">
            {!! $medias->appends(['filter_name' => request('filter_name')])->links() !!}
        </div>

    </div>





    <!-- Modal -->
    <div class="modal fade" id="adminFileManagerModal" tabindex="-1" role="dialog" aria-labelledby="adminFileManagerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminFileManagerModalLabel">@lang('admin.media_details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="media_set_size">
                            <img id="mediaManagerPreviewScreen" src="{{asset('uploads/placeholder-image.png')}}" class="mediaManagerPreviewScreen img-fluid" />
                            </div>
                           
                        </div>
                        <div class="col-md-6">

                            <div class="adminMediaModalInfoSide">
                                <p id="mediaModalFileID" class="m-1" style="word-break:break-all;"><strong>{{__a('id')}}:</strong> #<span></span></p>
                                <p id="mediaModalFileName" class="m-1" style="word-break:break-all;"><strong>{{__a('file_name')}}:</strong> <span></span></p>
                                <p id="mediaModalFileType" class="m-1" style="word-break:break-all;"><strong>{{__a('file_type')}}:</strong> <span></span></p>
                                <p id="mediaModalFileUploadedOn" class="m-1" style="word-break:break-all;"><strong>{{__a('updated_on')}}:</strong> <span></span></p>
                                <p id="mediaModalFileSize" class="m-1" style="word-break:break-all;"><strong>{{__a('file_size')}}:</strong> <span></span></p>
                            </div>

                            <hr />

                            <form id="adminMediaManagerModalForm" method="post"> @csrf
                                <input type="hidden" id="sc_modal_info_media_id" name="media_id" value="">
                                <div class="form-group row">
                                    <label for="mediaFileTitle" class="col-sm-4 col-form-label col-form-label-sm text-right">{{__a('title')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="title" id="mediaFileTitle">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mediaFileAltText" class="col-sm-4 col-form-label col-form-label-sm text-right">{{__a('alt_text')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="alt_text" id="mediaFileAltText">

                                        <div id="formWorkingIconWrap" class="my-3"></div>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="la la-times"></i> {{__a('close')}}</button>
                    <button type="button" id="media-info-modal-trash-btn" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i> {{__a('delete_permanently')}}</button>
                </div>
            </div>
        </div>
    </div>




@endsection
