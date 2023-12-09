@extends('layouts.admin')

@section('content')

    @if(is_array($themes) && count($themes))
    <div class="themes-list-wrapper">
        <div class="row">
            @foreach($themes as $theme)
                @php
                    $name = array_get($theme, 'name');
                    $desc = array_get($theme, 'desc');
                    $url = array_get($theme, 'url');
                    $thumbnail_url = array_get($theme, 'thumbnail_url');
                @endphp

                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if($thumbnail_url)
                            <a href="{{$url}}" target="_blank">
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

        {!! no_data(__a('no_themes_msg')) !!}

    @endif


@endsection
