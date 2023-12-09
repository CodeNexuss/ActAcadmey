@extends('layouts.admin')

@section('content')

    @if(is_array($extended_plugins) && count($extended_plugins))
        <div class="extended-plugins find-plugins-lists">

            <p>{{count($extended_plugins)}} Plugins found to extend your LMS website.</p>

            <div class="row">
                @foreach($extended_plugins as $extended_plugin)
                    @php
                        $name = array_get($extended_plugin, 'name');
                        $desc = array_get($extended_plugin, 'desc');
                        $version = array_get($extended_plugin, 'version');
                        $release_date = array_get($extended_plugin, 'release_date');
                        $url = array_get($extended_plugin, 'url');
                        $thumbnail_url = array_get($extended_plugin, 'thumbnail_url');
                    @endphp
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @if($thumbnail_url)
                                <a href="{{$url}}" target="_blank" class="cover-image-wrap">
                                    <img class="card-img-top" src="{{$thumbnail_url}}" alt="Card image cap">
                                </a>
                            @endif

                            <div class="card-body">
                                <a href="{{$url}}" target="_blank" class="plugin-name"> <h5 class="card-title">{{$name}}</h5> </a>
                                <p class="card-text">{{$desc}}</p>
                                <a href="{{$url}}" target="_blank" class="btn btn-dark-blue" >View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        {!! no_data(__a('no_plugins_msg')) !!}
    @endif


@endsection
