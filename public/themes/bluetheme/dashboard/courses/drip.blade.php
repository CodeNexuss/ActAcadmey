@extends(theme('dashboard.layout'))


@section('content')
    @include(theme('dashboard.courses.course_nav'))

    @if($course->sections->count())

        <div class="row mb-3 py-3">
            <div class="col-md-12">
                <div class="drip_works p-4">
                    <h4 class="mb-3">{{__t('how_drip_works')}}</h4>
                    <div class="">
                        <ol class="drip_ol">
                            <li>
                                {{__t('how_drip_works_1')}}
                            </li>
                            <li>
                                {{__t('how_drip_works_2')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <form id="drip_form" action="" method="post">
            @csrf

            <div class="course-drip-wrap">
                @foreach($course->sections as $section)
                    <div class="drip-x-section bg-white border mb-4">
                        <div class="dashboard-section-header p-3 border-bottom">

                            <h3 class="mb-3">{{$section->section_name}}</h3>

                            <div class="course-section-drip-wrap">

                                <p>{!! __t('release_by_date_or_days') !!}</p>

                                <div class="form-row">
                                    <!-- <div class="form-group col-md-6">
                                        <label>{{__t('specific_date')}}</label>
                                        <input type="text" class="form-control date_picker" name="section[{{$section->id}}][unlock_date]" value="{{$section->unlock_date}}">

                                        <p class="text-muted mb-0"><small> {{__t('when_sec_unlock')}}</small></p>
                                    </div> -->

                                    <div class="form-group col-md-4">
                                        <label>{{__t('days_after_enrollment')}}</label>

                                        <input type="number" min="0" class="form-control section-unlock-days" name="section[{{$section->id}}][unlock_days]" id="section_{{$section->id}}_unlock_days" value="{{$section->unlock_days}}" @if($section->unlock_days == 0 && ($section->items->count() > 0) && $section->items[ count($section->items) - 1 ]->unlock_days > 0) disabled @endif>
                                        <p class="text-muted mb-0"><small>{{__t('place_noof_days')}}</small></p>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-purple section-unlock-days-submit mt-1" @if($section->unlock_days == 0 && ($section->items->count() > 0) && $section->items[ count($section->items) - 1 ]->unlock_days > 0) disabled @endif>
                                    <i class="la la-save"></i> {{__t('save_drip_preference')}}
                                </button>

                                <button type="button" class="btn btn-dark drip-x-clear mt-1">{{__t('clear')}}</button>

                            </div>

                        </div>

                        @if($section->items->count() > 0)
                        <div class="bg-light p-3">
                            @php $sub = 0; @endphp
                            @foreach($section->items as $item)
                                <div class="edit-drip-item mb-2 edit-drip-{{$item->item_type}}">

                                    <div class="section-item-top border p-3 row bg-white">
                                        <div class="form-group col-lg-6 col-md-12"> {!! $item->icon_html !!} {{$item->title}}</div>

                                        <!-- <div class="form-group col-lg-3 col-md-6">
                                            <label>{{__t('specific_date')}}</label>
                                            <input type="text" class="form-control date_picker" name="section[{{$section->id}}][content][{{$item->id}}][unlock_date]" value="{{$item->unlock_date}}" >

                                            <p class="text-muted mb-0"><small>{{__t('when_sec_unlock')}}</small></p>
                                        </div> -->

                                        <div class="form-group col-lg-3 col-md-6">
                                            <label>{{__t('days_after_enrollment')}}</label>

                                            <input type="number" min="0" class="form-control lecture-unlock-days {{ $sub == 0 ? 'first-sub-days' : '' }}" name="section[{{$section->id}}][content][{{$item->id}}][unlock_days]" id="section_{{$section->id}}_content_{{$item->id}}_unlock_days" value="{{$item->unlock_days}}" @if($section->unlock_days > 0) disabled @endif>
                                            <p class="text-muted mb-0"><small>{{__t('place_noof_days')}}</small></p>
                                        </div>
                                    </div>
                                </div>
                                @php $sub++ @endphp
                            @endforeach

                            <button type="submit" class="btn btn-purple mt-3 lecture-unlock-days-submit" @if($section->unlock_days > 0) disabled @endif>
                                <i class="la la-save"></i> {{__t('save_drip_preference')}}
                            </button>
                        </div>
                        @endif

                        <div class="section-item-form-wrap"></div>
                    </div>
                @endforeach
            </div>
        </form>

    @else

        <div class="card">
            <div class="card-body">
                {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-5' ) !!}
            </div>
        </div>
    @endif


@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css')}}">
@endsection

@section('page-js')
    <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('.date_picker').datetimepicker({format: 'YYYY-MM-DD'});

            $(document).on('keyup', 'input.section-unlock-days', function(event) {
                var _this = $(this);
                if(_this.val() != '') {
                    _this.closest('.drip-x-section').find('.lecture-unlock-days-submit').attr('disabled', 'disabled');
                    _this.closest('.drip-x-section').find('.lecture-unlock-days').each(function() {
                        $(this).val(_this.val());
                        $(this).attr('disabled', 'disabled');
                    });

                    $('span.text-danger').remove();
                } else {
                    _this.closest('.drip-x-section').find('.lecture-unlock-days-submit').removeAttr('disabled');
                    _this.closest('.drip-x-section').find('.lecture-unlock-days').each(function() {
                        $(this).val('');
                        $(this).removeAttr('disabled');
                    });
                }
            });

            $(document).on('keyup', 'input.first-sub-days', function(event) {
                var _this = $(this);
                if(_this.val() != '') {
                    _this.closest('.drip-x-section').find('.section-unlock-days-submit').attr('disabled', 'disabled');
                    _this.closest('.drip-x-section').find('.section-unlock-days').val('').attr('disabled', 'disabled');

                    // $('span.text-danger').remove();
                } else {
                    _this.closest('.drip-x-section').find('.section-unlock-days-submit').removeAttr('disabled');
                    _this.closest('.drip-x-section').find('.section-unlock-days').val('').removeAttr('disabled');
                }
            });

            $(document).on('click', '.drip-x-clear', function(event) {
                let drip_x_section = $(this).closest('.drip-x-section');
                drip_x_section.find('.section-unlock-days').removeAttr('disabled').val('');
                drip_x_section.find('.lecture-unlock-days').each(function() {
                    $(this).removeAttr('disabled').val('');
                });

                drip_x_section.find('.section-unlock-days-submit').removeAttr('disabled');
                drip_x_section.find('.lecture-unlock-days-submit').removeAttr('disabled');

                $('span.text-danger').remove();
            });

            $('button[type="submit"]').on('click', function() {

                $('#drip_form').validate({
                    rules : {

                    },
                    submitHandler: function(form) {
                        let valid = true;
                        let error_fields = [];
                        $('input.lecture-unlock-days').each(function() {
                            let next = $(this).closest('.edit-drip-item').next('.edit-drip-item').find('input.lecture-unlock-days');
                            let prev = $(this).closest('.edit-drip-item').prev('.edit-drip-item').find('input.lecture-unlock-days');
                            let section = $(this).closest('.drip-x-section').find('.section-unlock-days');

                            if(next.val() != '' && Number($(this).val()) >= Number(next.val())) {
                                if(Number($(this).val()) > 0 && (section.val() == '' || Number(section.val()) == 0) ) {

                                    next.parent().find('.text-danger').remove();
                                    next.after('<span class="text-danger">{{__t("days_after_enrollment_greater_than")}} '+$(this).val() +'</span>');
                                    valid = false;
                                    error_fields.push(next.attr('id'));

                                }
                            } else if($(this).val() != '' && next.val() == '') {
                                next.parent().find('.text-danger').remove();
                                next.after('<span class="text-danger">{{__t("days_after_enrollment_greater_than")}} '+$(this).val() +'</span>');
                                valid = false;
                                error_fields.push(next.attr('id'));
                            } else {
                                if($(this).val() == '' && ((prev.val() != '' && prev.val() !== undefined) || (next.val() != '' && next.val() !== undefined)) ) {
                                    console.log(prev, next);
                                    $(this).parent().find('.text-danger').remove();
                                    $(this).after('<span class="text-danger">{{__t("this_field_required")}}</span>');
                                    valid = false;
                                    error_fields.push($(this).attr('id'));
                                }
                                next.parent().find('.text-danger').remove();
                            }
                        });


                        if(valid && error_fields.length == 0) {
                            form.submit();
                        } else if(error_fields.length > 0) {                        

                            $('html, body').animate({
                                scrollTop: $('#'+error_fields[0]).offset().top - 100 }, 
                                'slow', function() {
                                $('#'+error_fields[0]).focus();
                            }); 
                        }
                    }
                }); 

            });



        });
    </script>
@endsection
