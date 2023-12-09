@extends('layouts.theme')

@section('content')

<div class="blog-post-page-header  text-white text-left py-5" style="background: #1C1D1F;">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h1 class="mb-3">{{$title}}</h1>


                <div class="row align-items-center">
                    <nav aria-label="breadcrumb" class="col-lg-8 text-truncate">
                        <ol class='breadcrumb mb-0 p-0 bg-transparent'>
                            <li class='breadcrumb-item'>
                                <a href='{{route('blog')}}' class="text-white font-weight-bold">
                                    <i class='la la-home'></i> {{__t('blog_home')}}
                                </a>
                            </li>

                            <li class='breadcrumb-item active text-white'>{{$title}}</li>
                        </ol>
                    </nav>
                    <p class="mb-0 text-right col-lg-4">{{__t('published_time')}} : {{$post->published_time}}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="blog-post-container-wrap py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @if($post->feature_image)
                <div class="post-feature-image-wrap mb-5">
                    <img src="{{$post->thumbnail_url->image_lg}}" alt="{{$post->title}}" class="img-fluid" width="100%">
                </div>
                @endif

                <div class="post-content">
                    {!! clean_html($post->post_content) !!}
                </div>


                <div class="blog-author-wrap border p-4 my-5">

                    @php
                    $instructor = $post->author;
                    $courses_count = $instructor->courses()->publish()->count();
                    $students_count = $instructor->student_enrolls->count();
                    $instructor_rating = $instructor->get_rating;
                    @endphp

                    <div class="course-single-instructor-wrap mb-4 ">

                        <div class="instructor-stats">
                            <div class="d-flex align-items-center mb-5 flex-wrap justify-content-center justify-content-sm-start">
                                <div class="profile-image mr-md-4">
                                    <a href="{{route('profile', $instructor->id)}}">
                                        {!! $instructor->get_photo !!}
                                    </a>
                                </div>
                                <div class="instructor-details text-center mt-2">
                                    <a href="{{route('profile', $instructor->id)}}" class="d-inline-block">
                                        <h4 class="instructor-name mb-0">{{$instructor->name}}</h4>
                                    </a>
                                    <div class="text-center text-sm-left">

                                        @if($instructor_rating->rating_count)
                                        <div class="profile-rating-wrap">
                                            {!! star_rating_generator($instructor_rating->rating_avg) !!}
                                            <p class="m-0 ">({{$instructor_rating->rating_avg}})</p>
                                        </div>
                                        @endif
                                    </div>
                                    @if($instructor->job_title)
                                    <h5 class="instructor-designation">{{$instructor->job_title}}</h5>
                                    @endif

                                    @if($instructor->about_me)
                                    <div class="profle-about-me-text mt-4">
                                        <div class="content-expand-wrap">
                                            <div class="content-expand-inner">
                                                {!! nl2br(clean_html($instructor->about_me)) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="cls_listview d-flex align-items-center justify-content-around mb-4 p-4">

                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-play-circle"></i>
                                    <strong>{{$courses_count}}</strong> {{__t('courses')}}
                                </p>
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-user-circle"></i>
                                    <strong>{{$students_count}}</strong> {{__t('students')}}
                                </p>
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-comments"></i>
                                    <strong>{{$instructor_rating->rating_count}} </strong> {{__t('reviews')}}
                                </p>
                            </div>
                        </div>

                        <!-- <div class="instructor-details text-center">
                                <a href="{{route('profile', $instructor->id)}}">
                                    <h4 class="instructor-name">{{$instructor->name}}</h4>
                                </a>

                                @if($instructor->job_title)
                                    <h5 class="instructor-designation">{{$instructor->job_title}}</h5>
                                @endif

                                @if($instructor->about_me)
                                    <div class="profle-about-me-text mt-4">
                                        <div class="content-expand-wrap">
                                            <div class="content-expand-inner">
                                                {!! nl2br(clean_html($instructor->about_me)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div> -->
                    </div>

                </div>



            </div>
        </div>
    </div>
</div>


@endsection