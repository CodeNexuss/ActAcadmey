@extends(theme('dashboard.layout'))


@section('content')

    @include(theme('dashboard.courses.course_nav'))

    <form action="" method="post">
        @csrf

        <div class="row">
            <div class="col-md-10 offset-md-1 mt-3">
                <div class="publish-course-wrap">

                    @if( ! $course->status)
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3>{{__t('draft')}}</h3>
                            </div>
                            <div class="card-body  pt-3 pb-5 text-center">
                                <p class="course-publish-icon m-0">
                                    <i class="la la-pencil-square-o"></i>
                                </p>
                                <p class="pl-5 pr-5">
                                    {{__t('draft_sub_text')}}
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                @if(get_option("lms_settings.instructor_can_publish_course"))
                                    <button type="submit" class="btn btn-dark btn-lg" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> {{__t('publish_course')}}</button>
                                @else
                                    <button type="submit" class="btn btn-dark btn-lg" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> {{__t('submit_for_review')}}</button>
                                @endif
                            </div>
                        </div>

                    @elseif($course->status == 1)
                        <div class="text-center">
                            <div class="alert alert-success py-5">
                                <p class="course-publish-icon m-0"> <i class="la la-smile-o"></i></p>
                                <h3>{{__t('course_has_published')}}</h3>
                            </div>

                            <button type="submit" class="btn btn-warning btn-lg mt-4" name="publish_btn" value="unpublish"><i class="la la-arrow-circle-down"></i> {{__t('unpublish_course')}}</button>
                        </div>
                    @elseif($course->status == 2)
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3>{{__t('pending')}}</h3>
                            </div>
                            <div class="card-body  pt-3 pb-5 text-center">
                                <p class="course-publish-icon m-0">
                                    <i class="la la-clock-o"></i>
                                </p>
                                <p class="pl-5 pr-5">
                                    {{__t('pending_state_desc')}}
                                </p>
                            </div>
                        </div>

                    @elseif($course->status == 4)
                        <div class="text-center">
                            <div class="alert alert-warning py-5">
                                <p class="course-publish-icon m-0"> <i class="la la-exclamation-circle"></i></p>
                                <h3>{{__t('course_isin_unpublish_state')}} </h3>
                            </div>

                            @if(get_option("lms_settings.instructor_can_publish_course"))
                                <button type="submit" class="btn btn-success btn-lg mt-4" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> {{__t('publish_course')}}</button>
                            @else
                                <button type="submit" class="btn btn-dark btn-lg mt-4" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> {{__t('submit_for_review')}}</button>
                            @endif

                        </div>

                    @elseif($course->status == 3)
                        <div class="text-center">
                            <div class="alert alert-danger py-5">
                                <p class="course-publish-icon m-0"> <i class="la la-frown"></i></p>
                                <h3>{{__t('course_has_blocked')}} </h3>
                            </div>
                        </div>
                    @endif



                </div>

            </div>
        </div>

    </form>



@endsection
