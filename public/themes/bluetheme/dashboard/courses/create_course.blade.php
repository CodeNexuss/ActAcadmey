@extends(theme('dashboard.layout'))

@section('content')
    <div class="card">
        <div class="card-body des_font">

            <form method="post">
                @csrf
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">{{__t('title')}} <span style="color:red;">*</span></label>
                    <div class="input-group mb-3">
                        <input type="text" name="title" class="form-control" id="title" placeholder="{{__t('course_title_eg')}}" value="{{old('title')}}" data-maxlength="120" >
                        <div class="input-group-append border border-dark border-left-0 rounded-right">
                            <span class="input-group-text">120</span>
                        </div>
                    </div>
                    @if ($errors->has('title'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="short_description">{{__t('short_description')}}</label>
                    <div class="input-group">
                        <textarea name="short_description" id="short_description" class="form-control" placeholder="{{__t('course_short_desc_eg')}}" data-maxlength="220"></textarea>
                        <div class="input-group-append border border-dark border-left-0 rounded-right">
                            <span class="input-group-text">220</span>
                        </div>
                    </div>
                </div>


                <div class="form-row my-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="requirements">{{__t('course_thumbnail')}}</label>
                            {!! image_upload_form('thumbnail_id', null, [330,185 ]) !!}
                            <small class="form-text text-muted"> {{__t('course_img_guide')}}</small>
                        </div>
                    </div>

                    <div class="col">

                        <div class="form-group">
                            <p for="level" class="mr-4">{{__t('course_level')}} <span style="color:red;">*</span></p>
                            <select name="level" class="form-control">
                                @foreach(course_levels() as $key => $level)
                                    <option value="{{$key}}" {{selected(1, $key)}}>{{$level}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="mb-3">{{__t('category')}} <span style="color:red;">*</span></label>

                            @if($categories->count())
                                <select name="category_id" id="course_category" class="form-control select2">
                                    <option value="">{{__t('select_category')}}</option>
                                    @foreach($categories as $category)
                                        <optgroup label="{{$category->category_name}}">
                                            @if($category->sub_categories->count())
                                                @foreach($category->sub_categories as $sub_category)
                                                    <option value="{{$sub_category->id}}">
                                                        {{$sub_category->category_name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                    @endforeach
                                </select>
                            @endif
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('topic_id') ? ' has-error' : '' }}">
                            <label class="mb-3">{{__t('topic')}} <span style="color:red;">*</span></label>

                            @if($categories->count())
                                <select name="topic_id" id="course_topic" class="form-control select2">
                                    <option value="">{{__t('select_topic')}}</option>
                                </select>
                            @endif
                            @if ($errors->has('topic_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('topic_id') }}</strong></span>
                            @endif
                        </div>


                    </div>

                </div>


                <div class="lecture-video-upload-wrap mb-5">
                    @php
                        $videoSrc = old('video_source')
                    @endphp

                    <label>{{__t('intro_video')}}</label>

                    <select name="video[source]" class="lecture_video_source form-control mb-2">
                        <option value="-1">{{__t('select_video_src')}}</option>
                        <option value="html5" {{selected($videoSrc, 'html5')}} >HTML5 (mp4)</option>
                        <option value="external_url" {{selected($videoSrc, 'external_url')}}>External URL</option>
                        <option value="youtube" {{selected($videoSrc, 'youtube')}}>YouTube</option>
                        <option value="vimeo" {{selected($videoSrc, 'vimeo')}}>Vimeo</option>
                        <option value="embedded" {{selected($videoSrc, 'embedded')}}>Embedded</option>
                    </select>

                    <p class="video-file-type-desc">
                        <small class="text-muted">{{__t('select_ur_pref_videotype')}} </small>
                    </p>

                    <div class="video-source-input-wrap mb-5" style="display: {{$videoSrc? 'block' : 'none'}};">

                        <div class="video-source-item video_source_wrap_html5 bg-custom p-4 " style="display: {{$videoSrc == 'html5'? 'block' : 'none'}};border-radius: 12px;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="video-upload-wrap text-center">
                                        <i class="la la-cloud-upload text-muted"></i>
                                        <h5>{{__t('upload_video')}}</h5>
                                        <p class="mb-2">{{__t('file_format')}}:  .mp4</p>
                                        {!! media_upload_form('video[html5_video_id]', __t('upload_video'), null) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="video-poster-upload-wrap text-center">
                                        <i class="la la-image text-muted"></i>
                                        <h5>{{__t('video_poster')}}</h5>
                                        <small class="text-muted mb-3 d-block">{{__t('supports_image_format')}}</small>

                                        {!! image_upload_form('video[html5_video_poster_id]') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="video-source-item video_source_wrap_external_url" style="display: {{$videoSrc == 'external_url'? 'block' : 'none'}};">
                            <input type="text" name="video[source_external_url]" class="form-control" value="" placeholder="External Video URL">
                        </div>
                        <div class="video-source-item video_source_wrap_youtube" style="display: {{$videoSrc == 'youtube'? 'block' : 'none'}};">
                            <input type="text" name="video[source_youtube]" class="form-control" value="" placeholder="YouTube Video URL">
                        </div>
                        <div class="video-source-item video_source_wrap_vimeo" style="display: {{$videoSrc == 'vimeo'? 'block' : 'none'}};">
                            <input type="text" name="video[source_vimeo]" class="form-control" value="" placeholder="Vimeo Video URL">
                        </div>
                        <div class="video-source-item video_source_wrap_embedded" style="display: {{$videoSrc == 'embedded'? 'block' : 'none'}};">
                            <textarea name="video[source_embedded]" class="form-control" placeholder="{{__t('place_embedded_code_here')}}"></textarea>
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-warning"> <i class="la la-save"></i> {{__t('create_course')}}</button>
            </form>

        </div>
    </div>
@endsection


@section('page-css')
    <link href="{{ asset('assets/plugins/select2-4.0.3/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
    <script src="{{ asset('assets/plugins/select2-4.0.3/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/filemanager.js') }}"></script>
@endsection
