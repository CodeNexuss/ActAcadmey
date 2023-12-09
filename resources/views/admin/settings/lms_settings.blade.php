@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form action="{{route('save_settings')}}" method="post">
                @csrf

                
                <div class="form-group row">
                    <label class="col-md-4 control-label"> {{__a('enable_discussion')}} </label>
                    <div class="col-md-8">
                        {!! switch_field("lms_settings[enable_discussion]", '', get_option("lms_settings.enable_discussion") ) !!}

                        <p class="text-muted"><small>By enabling discussion, students can ask questions to instructors directory from every lecture page, they will get a form to ask question under every lecture..</small></p>
                    </div>
                </div>
                <!-- <input type="hidden" value="0" id="lms_settings[enable_discussion]" name="lms_settings[enable_discussion]"> -->

                <div class="form-group row">
                    <label class="col-md-4 control-label"> {{__a('instructor_can_publish_course')}} </label>
                    <div class="col-md-8">
                        {!! switch_field("lms_settings[instructor_can_publish_course]", '', get_option("lms_settings.instructor_can_publish_course") ) !!}

                        <p class="text-muted"><small>{{__a('allow_inst_publish_text')}}.</small></p>
                    </div>
                </div>

                <hr />

                <div class="form-group row">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" id="settings_save_btn" class="btn btn-primary">
                            {{__a('save_settings')}}
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>


@endsection


@section('page-js')
    <script>
        $(document).ready(function(){

            $('input[type="checkbox"], input[type="radio"]').click(function(){
                var input_name = $(this).attr('name');
                var input_value = 0;
                if ($(this).prop('checked')){
                    input_value = $(this).val();
                }
                $.ajax({
                    url : '{{ route('save_settings') }}',
                    type: "POST",
                    data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' },
                });
            });


            $('input[name="date_format"]').click(function(){
                $('#date_format_custom').val($(this).val());
            });
            $('input[name="time_format"]').click(function(){
                $('#time_format_custom').val($(this).val());
            });

        });
    </script>
@endsection
