<ul class="dashboard-menu mob_menu  mt-3">
    @if(Auth::user() && Auth::user()->isStudent())
    <li class="{{request()->is('dashboard') ? 'active' : ''}}"><a href="{{route('dashboard')}}"> <span class="menu_icon mr-2"><img src="{{url('uploads/images/Dashboard.png')}}"></span> {{__t('dashboard')}} </a></li>
    @else
    <li class="{{request()->is('dashboard') ? 'active' : ''}}"><a href="{{route('dashboard')}}"> <i class="la la-dashboard"></i> {{__t('dashboard')}} </a></li>
    @endif
 
    @php
    $menus = sidebar_menu();
    @endphp

    @if(is_array($menus) && count($menus))
        @foreach($menus as $key => $instructor_menu)
            <li class="{{array_get($instructor_menu, 'is_active') ? 'active' : ''}}">
                <a href="{{route($key)}}"> {!! array_get($instructor_menu, 'icon') !!} {!! array_get($instructor_menu, 'name') !!} </a>
            </li>
        @endforeach
    @endif

    @if(Auth::user() && Auth::user()->isStudent())
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               <span class="menu_icon mr-2"><img src="{{url('uploads/images/Logout.png')}}"></span> {{__t('logout')}}
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               <i class="la la-sign-out"></i>
                 {{__t('logout')}}
            </a>
        </li>
    @endif

    @if(Auth::user() && Auth::user()->isAdmin())
    <li>
        <a href="{{ route('admin') }}">
            <i class="la la-cogs"></i> {{__t('go_to_admin')}}
        </a>
    </li>
    @endif
</ul>
