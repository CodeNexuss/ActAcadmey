@extends(theme('dashboard.layout'))

@section('content')

    <div class="purchase-ful-view-wrap p-4 bg-white">

        <h4 class="mb-4">{{__t('purchase_details')}}</h4>
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

    </div>


    <div class="my-4">

        @if($payment->courses->count() > 0)
         <div class="cls_table table-responsive">
            <table class="table table-bordered bg-white">
                <thead>
                <tr>
                    <th>{{__t('thumbnail')}}</th>
                    <th>{{__t('title')}}</th>
                    <th>{{__t('price')}}</th>
                    <th>{{__t('actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payment->courses as $course)
                    <tr>
                        <td>
                            <img src="{{$course->thumbnail_url}}" width="80" />
                        </td>
                        <td>
                            <p class="mb-3">
                                <strong>{{$course->title}}</strong>
                                {!! $course->status_html() !!}
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
                </tbody>
            </table>
        </div>
        @else
            <div class="no-data-wrap">
                {!! no_data(__t('nothing_here'), __t('nothing_here_desc'), 'my-5' ) !!}
            </div>
        @endif



    </div>




@endsection
