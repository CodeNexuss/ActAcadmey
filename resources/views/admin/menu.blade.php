
<div class="navbar-default sidebar" role="navigation">
    <div id="adminmenuback"></div>
    <div class="sidebar-nav navbar-collapse">
        <a class="cls_logo text-center" href="{{route('home')}}" style="color: #000;">
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
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{route('admin')}}"><i class="la la-long-arrow-right fa-fw"></i> @lang('admin.dashboard')</a>
            </li>

            @php
                do_action('admin_menu_item_before');
            @endphp

            <li>
                <a href="#"><i class="la la-long-arrow-right fa-fw"></i> @lang('admin.cms')<span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    <li> <a href="{{ route('posts') }}">@lang('admin.posts')</a> </li>
                    <li> <a href="{{ route('pages') }}">@lang('admin.pages')</a> </li>
                </ul><!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{route('media_manager')}}"><i class="la la-long-arrow-right"></i> @lang('admin.media_manager')</a>
            </li>

            <li>
                <a href="{{route('category_index')}}"><i class="la la-long-arrow-right"></i> @lang('admin.categories')</a>
            </li>

            <li>
                <a href="{{route('home_page_sliders')}}" class="{{request()->is('admin/home_page_sliders*') ? 'active' : ''}}"><i class="la la-long-arrow-right"></i> @lang('admin.home_page_sliders')</a>
            </li>

            <li> <a href="{{route('admin_courses')}}"><i class="la la-long-arrow-right"></i> {{__a('courses')}}</a>  </li>

            <li>
                <a href="{{route('plugins')}}" class="{{request()->is('admin/plugins*') ? 'active' : ''}}" >
                    <i class="la la-long-arrow-right"></i> {{__a('plugins')}}
                </a>
            </li>

            <li>
                <a href="{{route('manage_labels')}}" class="{{request()->is('admin/manage_labels*') ? 'active' : ''}}" >
                    <i class="la la-long-arrow-right"></i> Manage Labels
                </a>
            </li>

           <!--  <li>
                <a href="{{route('themes')}}" class="{{request()->is('admin/themes*') ? 'active' : ''}}">
                    <i class="la la-long-arrow-right"></i> {{__a('themes')}}
                </a>
            </li> -->

            <li>
                <a href="#"><i class="la la-long-arrow-right fa-fw"></i> @lang('admin.settings')<span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    @php
                        do_action('admin_menu_settings_item_before');
                    @endphp
                    <li> <a href="{{ route('general_settings') }}">@lang('admin.general_settings')</a> </li>
                    <li> <a href="{{ route('joinus_links') }}">Join Us Links</a> </li>
                    <li> <a href="{{ route('lms_settings') }}">@lang('admin.lms_settings')</a> </li>
                    <li> <a href="{{ route('payment_settings') }}">@lang('admin.payment_settings')</a> </li>
                    <li> <a href="{{ route('payment_gateways') }}">@lang('admin.payment_gateways')</a> </li>
                    <li> <a href="{{ route('withdraw_settings') }}">@lang('admin.withdraw')</a> </li>
                    <li> <a href="{{ route('theme_settings') }}">@lang('admin.theme_settings')</a> </li>
                    {{--<li> <a href="{{ route('invoice_settings') }}">@lang('admin.invoice_settings')</a> </li>--}}
                    <li> <a href="{{ route('social_settings') }}"> {{__a('social_login_settings')}} </a> </li>
                    <li> <a href="{{ route('storage_settings') }}"> {{__a('storage')}} </a> </li>
                    @php
                        do_action('admin_menu_settings_item_after');
                    @endphp
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="la la-long-arrow-right fa-fw"></i> {{ __a('language_settings') }} <span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    <li> <a href="{{ route('language_settings') }}"> {{ __a('manage_language') }} </a> </li>
                    <!-- <li> <a href="{{ route('manage_web_language') }}"> {{ __a('manage_web_language') }} </a> </li> -->
                    <li> <a href="{{ route('manage_web_front_language') }}"> {{ __a('manage_web_front_language') }} </a> </li>
                    <li> <a href="{{ route('manage_web_validation_msg') }}"> {{ __a('manage_web_validation_msg') }} </a> </li>
                    <!-- <li> <a href="{{ route('language_settings') }}"> {{ __a('manage_mobile_language') }} </a> </li> -->

                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li> <a href="{{route('payments')}}"><i class="la la-long-arrow-right"></i> {{__a('payments')}}</a>  </li>
            <li> <a href="{{route('withdraws')}}"><i class="la la-long-arrow-right"></i> {{__a('withdraws')}}</a>  </li>

            <li> <a href="{{ route('users') }}"><i class="la la-long-arrow-right"></i> {{__a('users')}}</a>  </li>

            <li> <a href="{{route('change_password')}}"><i class="la la-long-arrow-right"></i> @lang('admin.change_password')</a>  </li>

            @php
            do_action('admin_menu_item_after');
            @endphp

            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="la la-long-arrow-right"></i> {{__a('logout')}}
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
