@php
    use App\Category;
    $categories = Category::whereStep(0)->with('sub_categories')->orderBy('category_name', 'asc')->get();
@endphp

    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{get_option('enable_rtl')? 'rtl' : 'auto'}}" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $favicon = media_file_uri(get_option('site_favicon'));
        $favicon = ($favicon) ? $favicon : asset('assets/images/udify-logo.svg')
    @endphp
    <link rel="shortcut icon" href="{{ $favicon }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>  @if( ! empty($title)) {{ $title }} | {{get_option('site_name')}}  @else {{get_option('site_name')}} @endif </title>

    <!-- all css here -->

    <!-- bootstrap v3.3.6 css -->
    <!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css').'?version='.time()}}"> -->
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css').'?version='.time()}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}"> -->

@yield('page-css')

<!-- style css -->
    <!-- <link rel="stylesheet" href="{{theme_asset('css/style.css').'?version='.time()}}"> -->
    <!-- <link rel="stylesheet" href="{{theme_asset('css/custom.css').'?version='.time()}}"> -->
    <link rel="stylesheet" href="{{asset('css/app.css').'?version='.time()}}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js').'?version='.time()}}"></script>


    <script type="text/javascript">
        /* <![CDATA[ */
        window.pageData = @json(pageJsonData());
        /* ]]> */
    </script>
    <style type="text/css">
        .hide {
            display: none;
        }
        .label-html span {
            color: #fff !important;
        }
        label.error, span.error, p.error {
            color: #dc3545 !important;
        }
        /* input[disabled], button[disabled] {
            opacity: 0.2 !important;
        } */
    </style>
</head>
<body class="{{get_option('enable_rtl')? 'rtl' : ''}} cls_design">

<div class="main-navbar-wrap">


    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container remv_collapse">
            <a class="navbar-brand site-main-logo" href="{{route('home')}}">
                @php
                    $logoUrl = media_file_uri(get_option('site_logo'));
                @endphp

                @if(get_option('logo_settings')=='show_site_name')
                    <div class=""><h3>{{get_option('site_name')}}</h3></div>
                @elseif($logoUrl)
                    <img src="{{media_file_uri(get_option('site_logo'))}}" alt="{{get_option('site_name')}}" />
                @else
                    <img src="{{asset('assets/images/udify-logo.svg')}}" alt="{{get_option('site_name')}}" />
                @endif
            </a>
            

            <div class="collapse navbar-collapse" id="mainNavbarContent">
                <ul class="navbar-nav categories-nav-item-wrapper mob_cate">
                    <li class="nav-item nav-categories-item">
                        <a class="nav-link browse-categories-nav-link  d-none d-lg-block" href="{{route('categories')}}"> <i class="la la-th-large"></i> {{__t('categories')}}</a>
                        <div class="categories-menu" id="remv_back">
                            <ul class="categories-ul-first" >
                                <!-- <li>
                                    <a href="javascript:;">
                                        <i class="la la-th-list"></i> {{__t('all_categories')}}
                                    </a>
                                </li> -->
                                <li class="text-right m-3 d-block d-lg-none">
                                    <span>
                                    <b class="close_cate">Close</b> 
                                    </span>
                                 </li>
                                <div>
                                @foreach($categories as $category)
                                    <li class="test">
                                        <a href="{{route('courses', ['parent_category' => $category->id])}}" class="{{ ($category->sub_categories->count()) ? '' : 'no-sub-categories' }} check">
                                            <i class="la {{$category->icon_class}}"></i> {{$category->category_name}}

                                            @if($category->sub_categories->count())
                                                <i class="la la-angle-right"></i>
                                            @endif
                                        </a>
                                        @if($category->sub_categories->count())
                                            <ul class="level-sub first_level" id="back_move">
                                            <span  class="text-right m-3 d-block d-lg-none"> <b class="back_first_animate">Back</b></span>
                                                <div >
                                                @foreach($category->sub_categories as $subCategory)
                                                    <li class="topic">
                                                        <?php 
                                                            $topics = App\Category::where('category_id', $subCategory->id)->get();
                                                        ?>
                                                        <a href="{{route('courses', ['category' => $subCategory->id])}}" class="{{ ($topics->count()) ? '' : 'no-topics' }}">{{$subCategory->category_name}}
                                                            @if($topics->count())
                                                                <i class="la la-angle-right"></i>
                                                            @endif
                                                        </a>
                                                        @if($topics->count())
                                                            <ul class="level-topics second_level">
                                                            <span  class="text-right m-3 d-block d-lg-none"> <b class="back_second_animate">Back</b></span>
                                                                @foreach($topics as $topic)
                                                                    <li>
                                                                        <a href="{{route('courses', ['category' => $subCategory->id, 'topic' => $topic->id])}}" class="topics_avail">{{$topic->category_name}}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                                </div>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                </div>
                                
                                
                            </ul>
                        </div>

                    </li>

                </ul>

                <div class="header-search-wrap ml-2 d-none d-lg-block" style="height:40px;">
                    <form action="{{route('courses')}}" class="form-inline " method="get">
                        <input class="form-control" type="search" name="q" value="{{request('q')}}" placeholder="{{__t('search')}}">
                        <button class="btn my-2 my-sm-0 header-search-btn" type="submit"><i class="la la-search"></i></button>
                    </form>
                </div>

                <ul class="navbar-nav main-nav-auth-profile-wrap d-none d-lg-flex align-items-center">

                    <li class="nav-item dropdown mini-cart-item home_cart">
                        {!! view_template_part('template-part.minicart') !!}
                    </li>

                    @if (Auth::guest())
                        <li class="nav-item mr-2 ml-2">
                            <a class="nav-link btn btn-login-outline" href="{{route('login')}}"> <i class="la la-sign-in"></i> {{__t('login')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-theme-primary" href="{{route('register')}}"> <i class="la la-user-plus"></i> {{__t('signup')}}</a>
                        </li>
                    @else
                        <li class="nav-item main-nav-right-menu nav-item-user-profile">
                            <a class="nav-link profile-dropdown-toogle" href="javascript:;">
                                <span class="top-nav-user-name">
                                    {!! $auth_user->get_photo !!}
                                </span>
                            </a>
                            <div class="profile-dropdown-menu pt-0">

                                <div class="profile-dropdown-userinfo border-bottom ">
                                    <div class="d-flex align-items-center px-3 pt-3">
                                    <div class="img">
                                         <span class="top-nav-user-name profile_img">
                                                {!! $auth_user->get_photo !!}
                                            </span>
                                    </div>
                                    <div class="text ml-3">
                                        <p class="m-0" style="word-break:break-all">{{ $auth_user->name }}</p>
                                        <small style="word-break:break-all">{{$auth_user->email}}</small>
                                    </div>
                                </div>
                                <hr>

                                @include(theme('dashboard.sidebar-menu'))
                            </div>
                        </li>
                    @endif

                </ul>

            </div>
        </div>

    </nav>


</div>
<div class="mobile_navbottom">
    <ul class="ul">
        <li class="">
                <a class="" href="{{route('home')}}"> <i class="la la-home"></i></a>
            </li> 
        <li>
        <button class=" open_cate" type="button" style="border:unset;background-color:unset;">
            <i class="la la-th-list" style="color:#6c47cd;font-size:31px;margin-top:6px;"></i>
                <!-- <span class="navbar-toggler-icon"></span> -->
            </button>
            <!-- <a href="{{route('categories')}}">
                <i class="la la-th-list"></i>
            </a> -->
        </li>
        <li>
             <a onclick="search_open()">
                <i class="la la-search"></i>
            </a>
            
        </li>
        <li class="nav-item dropdown mini-cart-item">
            {!! view_template_part('template-part.minicart') !!}
        </li>
        <div class="model-fixed" id="mobile_open">
                <button onclick="search_close()" class="close mb-4" style="font-size: 20px;color: #000;">close</button>
                <form action="{{route('courses')}}" class="form-inline w-100" method="get">
                    <input class="form-control pl-5" type="search" name="q" value="{{request('q')}}" placeholder="{{__t('search')}}">
                    <button class="btn my-2 my-sm-0 header-search-btn" type="submit" style="left: 25px;"><i class="la la-search"></i></button>
                </form>
            </div>
         @if (Auth::guest())
            <!-- <li class="">
                <a class="" href="{{route('login')}}"> <i class="la la-sign-in"></i></a>
            </li> -->
            <li class="">
                <a class="" href="{{route('register')}}"> <i class="la la-user-plus"></i></a>
            </li>
        @else
            <li class="">
                <a  href="javascript:;" onclick="menu_open()">
                    <span class="top-nav-user-name">
                        {!! $auth_user->get_photo !!}
                    </span>
                </a>
                <div class="mobile-dropdown-menu">
                    <button  onclick="menu_close()" class="close" style="font-size: 18px; padding: 10px;">{{__a('close')}}</button>
                    <div class="profile-dropdown-userinfo border-bottom p-3">
                        <p class="m-0" style="word-break:break-all">{{ $auth_user->name }}</p>
                        <small style="word-break:break-all">{{$auth_user->email}}</small>
                    </div>

                    @include(theme('dashboard.sidebar-menu'))
                </div>
            </li>
        @endif
    </ul>
</div>

<script type="text/javascript">


    function search_open() {
        $(".model-fixed").css("display" , "block")
        $("body").addClass('no_scrl')
        
    }
    function search_close() {
        $(".model-fixed").css("display" , "none")
        $("body").removeClass('no_scrl')
    }
    
     function menu_open() {
        $(".mobile-dropdown-menu").css("display" , "block")
        $("body").addClass('no_scrl')
    }
    function menu_close() {
        $(".mobile-dropdown-menu").css("display" , "none")
        $("body").removeClass('no_scrl')
    }

</script>

