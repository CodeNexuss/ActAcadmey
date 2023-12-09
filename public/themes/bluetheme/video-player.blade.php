@php
    $video_source = $model->video_info('source');
    $src_youtube = $model->video_info('source_youtube');
    $src_vimeo = $model->video_info('source_vimeo');
    $src_external = $model->video_info('source_external_url');
    $embedded_code = $model->video_info('source_embedded');
    $text = empty($video_caption) ? null : $video_caption;
@endphp

<div class="lecture-video-wrapper video-player-wrapper">

    @if($video_source === 'embedded')
        {!! $embedded_code !!}
    @endif


    @if($video_source === 'html5')
        @php
            $video_id = $model->video_info('html5_video_id');
            $html5_video = \App\Media::find($video_id);
            $media_url = media_file_uri($html5_video);


            $poster_id = (int) $model->video_info('html5_video_poster_id');
            if ( ! $poster_id && $model->thumbnail_id){
                $poster_id = $model->thumbnail_id;
            }

            $poster_src = null;
            if ($poster_id){
                $poster_src = media_image_uri($poster_id)->original;
            }
        @endphp

        @if($html5_video)
            <video
                id="lecture_video"
                class="video-js vjs-fluid vjs-default-skin"
                controls
                preload="auto"

                @if($poster_src) poster="{{$poster_src}}" @endif
                data-setup='{}'>
                <source src="{{$media_url}}" type="{{$html5_video->mime_type}}"></source>
            </video>
        @endif
    @endif

    @if($video_source === 'external_url')
        <video
            id="lecture_video"
            class="video-js vjs-fluid vjs-default-skin"
            controls
            preload="auto"
            data-setup='{}'>
            <source src="{{$src_external}}" type="video/mp4"></source>
        </video>
    @endif


    @if($video_source === 'youtube')
        <video
            id="lecture_video"
            class="video-js vjs-fluid vjs-default-skin"
            controls
            data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "{{$src_youtube}}"}] }'
        >
        </video>
    @endif

    @if($video_source === 'vimeo')
        <video id="lecture_video" class="video-js vjs-fluid vjs-default-skin" controls
               data-setup='{ "techOrder": ["vimeo"], "sources": [{ "type": "video/vimeo", "src": "{{$src_vimeo}}"}] }'>
        </video>
    @endif
    @if($text)
        <p class="videoPlayerCaption m-0"><span class="captionText">{{$text}}</span></p>
    @endif
</div>

@if($video_source !== 'embedded')
@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/video-js/video-js.min.css')}}">
@endsection

@section('page-js')
    <script src="{{asset('assets/plugins/video-js/video.min.js')}}"></script>

    @if($video_source === 'youtube')
        <script src="{{asset('assets/plugins/video-js/Youtube.min.js')}}"></script>
    @endif
    @if($video_source === 'vimeo')
        <script src="{{asset('assets/plugins/video-js/videojs-vimeo.min.js')}}"></script>
    @endif
@endsection
@endif
