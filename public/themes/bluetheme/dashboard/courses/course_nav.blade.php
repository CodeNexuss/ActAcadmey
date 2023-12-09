<div class="course-edit-nav list-group list-group-horizontal-md mb-3 text-center  ">
    @php
        $nav_items = course_edit_navs();
    @endphp

    @if(is_array($nav_items) && count($nav_items))
        @foreach($nav_items as $route => $nav_item)
            <a href="{{route($route, $course->id)}}" class="list-group-item list-group-item-action list-group-item-info {{array_get($nav_item, 'is_active') ? 'active' : ''}}">
                {!! array_get($nav_item, 'icon') !!} <p class="m-0">{{array_get($nav_item, 'name')}}</p>
            </a>
        @endforeach
    @endif

    <a href="{{route('publish_course', $course->id)}}" class="list-group-item list-group-item-action list-group-item-info {{request()->is('dashboard/courses/*/publish') ? 'active' : ''}}">
        <i class="la la-arrow-alt-circle-up"></i> <p class="m-0">{{__t('publish')}}</p>
    </a>
</div>

<div class="course-edit-header d-flex mb-3 flex-wrap align-items-center flex-column flex-md-row" style="white-space: pre-wrap;">

    <a href="{{route('my_courses')}}" class="mb-0 mb-md-2 mb-lg-0 mb-md-0"> <i class="la la-angle-left"></i> {{__t('back_to_courses')}}</a> <span class="d-none d-md-block"> | </span><strong class="header-course-title ellipsis">{{$course->title}}</strong> <span class="d-none d-md-block"> | </span> {!! $course->status_html(false) !!}

    @if($course->status == 1)
        <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-primary ml-lg-auto mt-2 mt-lg-1 ml-2 ml-lg-0 mt-md-0" target="_blank"><i class="la la-eye"></i> {{__t('view')}} </a>
    @else
        <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-purple ml-lg-auto mt-2 mt-lg-0 ml-2 ml-lg-0 mt-md-0" target="_blank"><i class="la la-eye"></i> {{__t('preview')}} </a>
    @endif

</div>
