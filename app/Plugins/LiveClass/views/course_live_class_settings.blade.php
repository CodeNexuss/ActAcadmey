@extends(theme('dashboard.layout'))


@section('content')

    @include(theme('dashboard.courses.course_nav'))

    <div class="card">
        <div class="card-body">

            <form action="" method="post">
                @csrf

                @php
                $option = (array) array_get(json_decode($course->video_src, true), 'live_class');
                @endphp


                <div class="form-group row {{ $errors->has('live_class.schedule') ? ' has-error' : '' }}">
                    <label for="schedule" class="col-md-4">{{__t('live_schedule')}} </label>

                    <div class="col-md-6">
                        <input type="text" name="live_class[schedule]" class="form-control date_picker" id="schedule" value="{{array_get($option, 'schedule' )}}">
                        @if ($errors->has('live_class.schedule'))
                            <span class="invalid-feedback"><strong>{{__t('this_field_required')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('live_class.note_to_student') ? ' has-error' : '' }}">
                    <label for="note_to_student" class="col-md-4"> {{__t('note_to_stud')}} </label>

                    <div class="col-md-6">
                        <textarea name="live_class[note_to_student]" id="note_to_student" class="form-control ckeditor" rows="3">{{array_get($option, 'note_to_student' )}}</textarea>

                        @if ($errors->has('live_class.note_to_student'))
                            <span class="invalid-feedback"><strong>{{__t('this_field_required')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('live_class.zoom_meeting_id') ? ' has-error' : '' }}">
                    <label for="zoom_meeting_id" class="col-md-4">{{__t('zoom_meeting_id')}} </label>

                    <div class="col-md-6">
                        <input type="text" name="live_class[zoom_meeting_id]" class="form-control" id="zoom_meeting_id" value="{{array_get($option, 'zoom_meeting_id' )}}"  >
                        @if ($errors->has('live_class.zoom_meeting_id'))
                            <span class="invalid-feedback"><strong>{{__t('this_field_required')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('live_class.zoom_meeting_password') ? ' has-error' : '' }}">
                    <label for="zoom_meeting_password" class="col-md-4">{{__t('zoom_meeting_password')}} </label>

                    <div class="col-md-6">
                        <input type="text" name="live_class[zoom_meeting_password]" class="form-control" id="zoom_meeting_password" value="{{array_get($option, 'zoom_meeting_password' )}}"  >
                        @if ($errors->has('live_class.zoom_meeting_password'))
                            <span class="invalid-feedback"><strong>{{__t('this_field_required')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-warning" name="save" value="save"> <i class="la la-save"></i> {{__t('save')}}</button>
                    <button type="submit" class="btn btn-warning"  name="save" value="save_next"> <i class="la la-save"></i> {{__t('save_next')}}</button>
                </div>

            </form>

        </div>
    </div>

@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css')}}">
@endsection

@section('page-js')
    <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('.date_picker').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss', inline: true,
                sideBySide: true});
        });
    </script>
@endsection
