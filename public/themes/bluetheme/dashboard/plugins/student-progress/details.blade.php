@extends(theme('dashboard.layout'))

@section('content')

    <h4 class="mb-4">Course: {{$course->title}}</h4>

    @php
        $contents_count = $course->contents->count();
        $completed_percent = $course->completed_percent($user);
        $completed_content_ids = (array) $user->get_option("completed_courses.{$course->id}.content_ids");
    @endphp

    <div class="student-progress-details-wrap">

        <div class="student-progress-header d-flex bg-white p-3">
            <div class="reviewed-user-photo m-0 mr-3">
                <a href="{{route('profile', $user->id)}}">
                    {!! $user->get_photo !!}</h4>
                </a>
            </div>

            <div class="progress-report-loop-detail w-100">
                <a href="{{route('profile', $user->id)}}" class="mb-2 d-block" ><h4>{!! $user->name !!}</h4></a>

                <div class="progress">
                    <div class="progress-bar bg-success" style="width: {{$completed_percent}}%"></div>
                </div>

                <p class="mt-2 mb-0 text-muted">
                    {{__a('progress')}} {{$completed_percent}}%, {{__t('completed')}} {{count($completed_content_ids)}} / {{$contents_count}} {{__a('items')}}
                </p>
            </div>
        </div>

        <div class="progress-report-content-wrap">
            @if($course->sections->count())

                <div class="lecture-sidebar-curriculum-wrap mt-5">
                    @foreach($course->sections as $section)
                        <div id="course-section-{{$section->id}}" class="course-course-section mb-4">
                            <p class="section-name m-0 p-3 bg-white border-bottom">
                                <strong>{{$section->section_name}}</strong>
                            </p>

                            <div class="course-section-body">
                                @if($section->items->count())
                                    @foreach($section->items as $item)
                                        @php
                                            $is_completed = in_array($item->id, $completed_content_ids);
                                            $runTime = $item->runtime;
                                        @endphp

                                        <div class="progress-section-item border-bottom bg-white">
                                            <a href="{{route('single_'.$item->item_type, [$course->slug, $item->id ] )}}" class="p-2 d-flex" @if($is_completed) data-toggle="tooltip" title="{{__t('completed')}}" @endif>
                                                <p class="lecture-status-icon border-right pr-3 m-0">
                                                    @if($is_completed)
                                                        <i class="la la-check-circle text-success"></i>
                                                    @else
                                                        <i class="la la-circle"></i>
                                                    @endif
                                                </p>
                                                <div class="title-container pl-2 flex-grow-1 d-flex">
                                                    <p class="lecture-icon mb-0 mr-2"> {!! $item->icon_html !!}</p>
                                                    <p class="lecture-name flex-grow-1 m-0">
                                                        {{$item->title}} {!! $runTime ? "<small>($runTime)</small>" : "" !!}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>

            @endif

        </div>


    </div>

@endsection
