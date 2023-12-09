@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('payments')}}" data-toggle="tooltip" title="{{__a('payments')}}"> <i class="la la-arrow-circle-left"></i> {{__a('back_to_payments')}} </a>
@endsection

@section('content')
    <div class="cls_table table-responsive">
    <table class="table  table-bordered table-sm">
        @foreach($payment->toArray() as $col_name => $col_value)
            @if(trim($col_value))
                <tr>
                    <th>{{ucwords(str_replace('_', ' ', $col_name))}}</th>
                    <td>
                        @if($col_name === 'status')
                            {!! $payment->status_context !!}
                        @elseif($col_name === 'amount' || $col_name === 'fees_amount' || $col_name === 'total_amount' || $col_name === 'fees_total')
                            @if($payment->toArray()['fees_type'] == 'percent' && $col_name == 'fees_amount')
                                {{ intval($col_value) . '%' }}
                            @else
                                {!! price_format($col_value) !!}
                            @endif
                        @elseif($col_name === 'created_at' || $col_name === 'updated_at')
                            {!! date(date_time_format(), strtotime($col_value)) !!}
                        @else
                            {{$col_value}}
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</div>


    <div class="my-4">

        @if($payment->courses->count() > 0)
         <div class="cls_table table-responsive">
            <table class="table table-bordered">

                <tr>
                    <th>{{__t('thumbnail')}}</th>
                    <th>{{__t('title')}}</th>
                    <th>{{__t('price')}}</th>
                    <th>actions</th>
                </tr>

                @foreach($payment->courses as $course)
                    <tr>
                        <td>
                            <img src="{{$course->thumbnail_url}}" width="80" />
                        </td>
                        <td>
                            <p class="mb-3">
                                <strong>{{$course->title}}</strong>
                                {!! $course->status_html() !!} <span class="label-html">{!! labelHtml($course->id) !!}</span>
                            </p>

                            <p class="m-0 text-muted">
                                @php
                                    $lectures_count = $course->lectures->count();
                                    $assignments_count = $course->assignments->count();
                                @endphp

                                <span class="course-list-lecture-count">{{$lectures_count}} {{__t('lectures')}}</span>

                                @if($assignments_count)
                                    , <span class="course-list-assignment-count">{{$assignments_count}} {{__t('assignments')}}</span>
                                @endif
                            </p>
                        </td>
                        <td>{!! $course->price_html() !!}</td>

                        <td>

                            @if($course->status == 1)
                                <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-primary mt-2" target="_blank"><i class="la la-eye"></i> {{__t('view')}} </a>
                            @else
                                <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-purple mt-2" target="_blank"><i class="la la-eye"></i> {{__t('preview')}} </a>
                            @endif

                        </td>
                    </tr>

                @endforeach
            </table>
        </div>
        @else
            <div class="no-data-wrap">
                <h3>{{__a('no_course_found')}}.</h3>
            </div>
        @endif



    </div>



    <form action="{{route('update_status', $payment->id)}}" class="form-inline" method="post">
        @csrf
        <div class="status-update-form-wrap d-flex align-items-center p-3 bg-light">
            <span class="mr-2">{{__a('update_payment_status')}}</span>

            <select name="status" class="form-control mr-2">
                <option value="">{{__a('filter_by_status')}}</option>
                <option value="initial" {{selected('initial', $payment->status)}} >{{__a('initial')}}</option>
                <option value="pending" {{selected('pending', $payment->status)}} >{{__a('pending')}}</option>
                <option value="onhold" {{selected('onhold', $payment->status)}} >{{__a('onhold')}}</option>
                <option value="success" {{selected('success', $payment->status)}} >{{__a('success')}}</option>
                <option value="failed" {{selected('failed', $payment->status)}} >{{__a('failed')}}</option>
                <option value="declined" {{selected('declined', $payment->status)}} >{{__a('declined')}}</option>
                <option value="dispute" {{selected('dispute', $payment->status)}} >{{__a('dispute')}}</option>
                <option value="expired" {{selected('expired', $payment->status)}} >{{__a('expired')}}</option>
            </select>

            <button type="submit" class="btn btn-info mb-0">{{__a('update_status')}}</button>
        </div>
    </form>

@endsection

