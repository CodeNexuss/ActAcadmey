@include(theme('header'))

<div class="dashboard-wrap">
 <div class="cls_submenulist">
     <div class="container">
        <div class="text">
            <h1>{{__t('my_learning')}}</h1>
        </div>
        <div class="dashboard-menu-col">
            @include(theme('dashboard.navbar-menu'))
        </div>
    </div>
</div>
<div class="cls_submenulist1 mt-4">
     <div class="container">
        
            @php 
                $dashboard_submenu_items = dashboard_submenu() 
            @endphp
            @if(count($dashboard_submenu_items) > 1)
            <div class="listout">
                <ul>
                    @foreach($dashboard_submenu_items as $key => $item)
                        @if(Auth::user()->isInstructor())
                            @if($key == 'student_progress')

                                @if(request()->is('dashboard/my-courses') || request()->is('dashboard/courses*') || request()->is('dashboard/students-progress*') || request()->is('dashboard/assignments*') || request()->is('dashboard/discussions*'))
                                    <li class="{{ (isset($item['url']) && $item['url'] == url()->full()) ? 'active' : '' }}">
                                        <a href="{{ isset($item['url']) ? $item['url'] : '#' }}">{!! $item['name'] !!}</a>
                                    </li>
                                @endif

                            @else
                                <li class="{{ ($item['is_active']) ? 'active' : '' }}">
                                    <a href="{{ isset($item['url']) ? $item['url'] : '#' }}">{!! $item['name'] !!}</a>
                                </li>
                            @endif
                        @else
                            @if($key != 'student_progress')
                                <li class="{{ (isset($item['url']) && $item['url'] == url()->full()) ? 'active' : '' }}">
                                    <a href="{{ isset($item['url']) ? $item['url'] : '#' }}">{!! $item['name'] !!}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif
        
    </div>
</div>

    <div class="container py-4">
        <div class="row">
           

            <div class="col-lg-12">
                <div class="cls_right">
                    @include('inc.flash_msg')
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

</div>

@include(theme('footer'))
