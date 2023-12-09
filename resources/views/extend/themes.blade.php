@extends('layouts.admin')


@section('title-after')
    <a href="{{route('find_themes')}}" class="btn btn-primary" > <i class="la la-brush"></i></a>
@endsection

@section('content')


    <div class="themes-list-wrapper">

        <div class="row">
            @foreach($installed_themes as $themeSlug => $theme)
                @php
                    $name = array_get($theme, 'name');
                    $desc = array_get($theme, 'description');
                    $version = array_get($theme, 'version');
                    $author = array_get($theme, 'author');
                    $author_url = array_get($theme, 'author_url');
                    $url = array_get($theme, 'url');
                    $screenshot_url = array_get($theme, 'screenshot_url');
                @endphp


                @if($loop->first && $themeSlug == get_option('current_theme'))

                    <div class="active-theme-wrap border p-3 mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{$screenshot_url}}" class="img-fluid" />
                            </div>

                            <div class="col-md-6">
                                <label class="badge badge-success"></label>
                                <h2 class="mb-4 theme-name">{{$name}}
                                  
                                </h2>

                                <p>{{$desc}}</p>

                                <p class="mb-0 font-weight-bold">
                                    
                                    @if($author_url)
                                        <a href="{{$author_url}}" target="_blank">
                                            @endif
                                            @if($author)
                                                {!! $author !!}
                                            @endif
                                            @if($author_url)
                                        </a>
                                    @endif

                                    @if($url)
                                        | <a href="{{$url}}" target="_blank"> {{__a('view_details')}} </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                @else

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <a href="{{$url}}" target="_blank">
                                <img class="card-img-top" src="{{$screenshot_url}}" alt="Card image cap">
                            </a>
                            <div class="card-body">
                                <a href="{{$url}}" target="_blank" class="plugin-name"> <h5 class="card-title">{{$name}}</h5> </a>
                                <p class="card-text">{{$desc}}</p>

                                <form action="{{route('activate_theme')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="theme_slug" value="{{$themeSlug}}">
                                    <button type="submit" class="btn btn-purple">Activate</button>
                                </form>
                            </div>
                        </div>
                    </div>


                @endif


            @endforeach
        </div>

    </div>


@endsection
