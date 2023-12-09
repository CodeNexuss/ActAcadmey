
<footer>

    <div class="footer-top py-5">

        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="footer-widget-wrap">
                        <h4>{{__t('about_us')}}</h4>
                        <p class="footer-about-us-desc">
                            {!! get_option('about_us_content') !!}
                        </p>
                        <p class="footer-social-icon-wrap">
                            <a href="{{ get_option('facebook_joinus_link') ?? '#' }}"><i class="la la-facebook"></i> </a>
                            <a href="{{ get_option('twitter_joinus_link') ?? '#' }}"><i class="la la-twitter"></i> </a>
                            <a href="{{ get_option('youtube_joinus_link') ?? '#' }}"><i class="la la-youtube"></i> </a>
                        </p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="footer-widget-wrap contact-us-widget-wrap">
                        <h4>{{__t('contact')}}</h4>
                        <p class="footer-address">
                            {!! get_option('site_address') !!}
                        </p>

                        <p class=""> {{__t('telephone')}}: {!! get_option('site_phone_number') !!} </p>
                        <!-- <p class="mb-0"> {{__t('fax')}}: +1 979 132 225 675 </p> -->
                        <p class="mb-0"> {{ get_option('site_email') }} </p>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="footer-widget-wrap link-widget-wrap">

                        <ul class="footer-links d-block">
                            <li><a href="{{route('home')}}">{{__t('home')}}</a> </li>
                            <li><a href="{{route('dashboard')}}">{{__t('dashboard')}}</a> </li>
                            <li><a href="{{route('popular_courses')}}">{{__t('popular_courses')}}</a> </li>
                            <li><a href="{{route('courses')}}">{{__t('courses')}}</a> </li>
                            
                            
                            <li><a href="{{route('featured_courses')}}">{{__t('featured_courses')}}</a> </li>
                                                       
                            <!-- <li><a href="{{route('post_proxy')}}">{{__t('about_us')}}</a> </li> -->
                            <li><a href="{{route('register')}}">{{__t('signup')}}</a> </li>
                            <!-- <li><a href="#">{{__t('contact_us')}}</a> </li> -->
                            
                        </ul>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget-wrap link-widget-wrap">
                    <ul class="footer-links d-block">
                        <li><a href="{{route('blog')}}">{{__t('blog')}}</a> </li>
                        <li>
                                    <a href="{{route('post_proxy', get_option('about_us_page'))}}">
                                        {{__t('about_us')}}
                                    </a>
                                </li>
                        <li>
                                    <a href="{{route('post_proxy', get_option('terms_of_use_page'))}}">
                                        {{__t('terms_of_use')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('post_proxy', get_option('privacy_policy_page'))}}">
                                        {{__t('privacy_policy')}} &amp; {{__t('cookie_policy')}}
                                    </a>
                                </li>
                    </ul>
                </div>
                    </div>
                    

            </div>
        </div>
    </div>


    <div class="footer-bottom py-4">

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-contents-wrap text-center d-lg-flex flex-wrap mb-5 mb-lg-0">

                        <div class="footer-bottom-left d-lg-flex">
                            <span class="ml-2">{{__t('copyright')}} © {{ get_option('copyright_year') }} <a href="{{ get_option('copyright_url') }}" target="_blank">{{ get_option('copyright_name') }}</a>. {{__t('all_rights_reserved')}}.</span>
                        </div>

                        <div class="footer-bottom-right flex-grow-1 text-lg-right">
                            <ul class="footer-bottom-right-links">
                                <li>
                                    <div class="language-selector" style="padding-right: 15px;">
                                        <select id="language_footer" class="language-selector footer-select mt-lg-0 mt-md-2">
                                            @foreach($active_languages as $lang)
                                                <option value="{{$lang->value}}" {{ app()->getLocale()==$lang->value ? 'selected="selected"' : '' }}>{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </li>
                                

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


</footer>


<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    {{ csrf_field() }}
</form>

@if( ! auth()->check() && request()->path() != 'login')
    @include(theme('template-part.login-modal-form'))
@endif

<!-- jquery latest version -->
<script src="{{asset('assets/js/vendor/jquery-1.12.0.min.js').'?version='.time()}}"></script>
<!-- bootstrap js -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js').'?version='.time()}}"></script>

@yield('page-js')

<!-- main js -->
<script src="{{theme_asset('js/main.js').'?version='.time()}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
    $('#language_footer').on('change', function(e) {
        e.preventDefault();
        console.log(pageData.routes.change_language);

        $.ajax({
            url : pageData.routes.change_language,
            type : 'POST',
            data : {language: $('#language_footer').val(), _token : pageData.csrf_token },
            success: function(resp) {
                location.reload();
            }
        });

    });
</script>

<script type="text/javascript">
    length = $('#similar-slider').attr('item-length');
    loop = false
    if (length>4) {
        loop = true
    }

    $('.owl-carousel-container').owlCarousel({
        loop: false,
        autoplay: false,
        margin: 5,
        // rtl:false,
        nav: true,
        items: 5,
        dots: false,
        responsiveClass: true,
        // navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive:{
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {           
                items: 3  
            },
            1024: {
                items: 4
            },
            1400: {
                items: 5
            }
        }
        
    })
    $('.remove_active_blue').owlCarousel({
        loop: false,
        autoplay: false,
        margin: 20,
        autoWidth:true,
        nav: true,
        items: 5,
        dots: false,
        responsiveClass: true,
        responsive:{
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {           
                items: 3  
            },
            1024: {
                items: 4
            },
            1400: {
                items: 5
            }
        }
        
    })

    $(".pop").popover({
        trigger: "manual",
        html: true,
        animation: false,
        content: function() {
            return $(this).parent().find('.tool_hover').html();
        },
        sanitize: false
    }).on("mouseenter", function() {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function() {
            $(_this).popover('hide');
        });
        $(".close").on("mousedown", function() {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function() {
        var _this = this;
        setTimeout(function() {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 100);
    });

    $(document).on('click', '.topics-nav-item .nav-link', function() {
        $('.top-courses-container .tab-pane').removeClass('active');
        $('.topics-nav-item .nav-link').removeClass('active');
        $('#'+$(this).attr('data-tab')).addClass('active');
        $(this).addClass('active');
    });

</script>

@if(env('Live_Chat') == "true")
<script>
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/57223b859f07e97d0da57cae/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>
@endif

</body>
</html>
