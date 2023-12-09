<div class="instructor-search-results-wrap bg-white p-4 border">

    @if($instructors->count())

        <p>{{ sprintf(__a('found_number_instructors'), $instructors->count()) }}</p>

        <form action="{{route('add_instructors', $course_id)}}" method="post">
            @csrf

            <div class="d-flex instructor-search-results mb-3">
                @foreach($instructors as $instructor)
                    <input id="instructor-input-{{$instructor->id}}" type="checkbox" name="instructors[]" value="{{$instructor->id}}" style="display: none;">
                    <label for="instructor-input-{{$instructor->id}}" class="add-instructor-result-item col-md-4 p-3 d-flex">
                        @php
                            $courses_count = $instructor->courses()->publish()->count();
                        @endphp

                        <div class="instructor-stats mr-2">
                            <div class="profile-image">
                                {!! $instructor->get_photo !!}
                            </div>
                        </div>

                        <div class="instructor-details flex-grow-1">
                            <h4 class="instructor-name">{{$instructor->name}}</h4>
                            @if($instructor->job_title)
                                <h5 class="instructor-designation">{{$instructor->job_title}}</h5>
                            @endif

                            <div class="d-flex justify-content-between">
                                <p class="instructor-stat-value m-0 mr-2">
                                    <i class="la la-play-circle"></i>
                                    <strong>{{$courses_count}}</strong> {{__t('courses')}}
                                </p>

                                <a href="{{route('profile', $instructor)}}" target="_blank">{{__t('view_profile')}}</a>
                            </div>
                        </div>
                    </label>

                @endforeach

            </div>

            <button type="submit" class="btn btn-warning btn-purple"> <i class="la la-user-plus"></i> {{__t('add_instructors')}} </button>

        </form>


    @else

        {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-3 pb-3' ) !!}

    @endif


</div>
