@extends(theme('dashboard.layout'))

@section('content')

    <div class="dashboard-inline-submenu-wrap mb-4 border-bottom">
        <a href="{{route('earning')}}" class="">{{__t('earnings')}}</a>
        <a href="{{route('earning_report')}}" class="active">{{__t('report_statements')}}</a>
    </div>

    <div class="report-top-sub-menu mb-2 list-group list-group-horizontal-md">
        <a href="{{route('earning_report', ['time_period' => 'last_year'])}}" class="{{request('time_period') == 'last_year' ? 'active' : ''}} list-group-item list-group-item-action ">{{__t('last_year')}}</a>
        <a href="{{route('earning_report', ['time_period' => 'this_year'])}}" class="{{request('time_period') == 'this_year' ? 'active' : ''}} list-group-item list-group-item-action ">{{__t('this_year')}}</a>
        <a href="{{route('earning_report', ['time_period' => 'last_month'])}}" class="{{request('time_period') == 'last_month' ? 'active' : ''}} list-group-item list-group-item-action ">{{__t('last_month')}}</a>
        <a href="{{route('earning_report', ['time_period' => 'this_month'])}}" class="{{request('time_period') ? request('time_period') == 'this_month' ? 'active' : '' : 'active' }} list-group-item list-group-item-action ">{{__t('this_month')}}</a>
        <a href="{{route('earning_report', ['time_period' => 'last_week'])}}" class="{{request('time_period') == 'last_week' ? 'active' : ''}} list-group-item list-group-item-action ">{{__t('last_week')}}</a>

        <a href="{{route('earning_report', ['time_period' => 'this_week'])}}" class="{{request('time_period') == 'this_week' ? 'active' : ''}} list-group-item list-group-item-action ">{{__t('this_week')}}</a>
    </div>

    <form action="" method="get">
        <div class="report-filter-date-range-wrap  d-flex my-4 flex-wrap">
            <input type="hidden" name="time_period" value="date_range">

            <div class="d-flex mr-lg-3 my-2">
                <input type="text" class="form-control date_picker border-right-0" name="date_from" value="{{request('date_from')}}" style="border-top-right-radius:0;border-bottom-right-radius:0;">
                <div class="input-group-append ml-3">
                    <span class="input-group-text border-dark" style="border-radius:0px 8px 8px 0px;" ><i class="la la-calendar"></i> </span>
                </div>
            </div>

            <div class="d-flex my-2">
                <input type="text" class="form-control date_picker border-right-0" name="date_to" value="{{request('date_to')}}" style="border-top-right-radius:0;border-bottom-right-radius:0;">
                <div class="input-group-append ml-3">
                    <span class="input-group-text border-dark" style="border-radius:0px 8px 8px 0px;"><i class="la la-calendar"></i> </span>
                </div>
            </div>

            <div class="input-group-append my-2 ml-sm-3 ml-0" >
                <button class="btn btn-purple filter_purple ml-md-3 ml-0" type="submit">{{__t('filter_results')}}</button>
            </div>
        </div>
    </form>


    <h4 class="mb-4">{!! $page_title !!}</h4>

    <div class="row cls_bg_gray">
        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('sales')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($total_amount) !!}</h4>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('earnings')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($total_earning) !!}</h4>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('commission_deducted')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($commission) !!}</h4>
            </div>
        </div>

    </div>


    <div class="p-4 bg-white">
        <canvas id="ChartArea"></canvas>
    </div>


    <div class="statements-report my-5">


        @if($statements->count())
            <h4 class="my-4">{{__t('statements_show_by_time_period')}}</h4>
            <p class="text-muted my-3"> Showing {{$statements->count()}} from {{$statements->total()}} results </p>

            <table class="table">
                <thead>
                <tr>
                    <th>{{__t('course_details')}}</th>
                    <th>{{__t('earning')}}</th>
                    <th>{{__t('commission')}}</th>
                </tr>
                </thead>

                @foreach($statements as $statement)
                    <tr>
                        <td>
                            @if($statement->course)
                                <h5>
                                    <a href="{{route('course', $statement->course->slug )}}" target="_blank">
                                        {{$statement->course->title}}
                                    </a>
                                </h5>

                            @else
                                <h5 class="text-muted">Course not found, either deleted or removed</h5>
                            @endif

                            <p class="mb-0">{{__t('price')}}: {!! price_format($statement->amount) !!}</p>
                            <p class="text-muted mb-0">
                                <small>{{__t('payments')}} #{{$statement->payment->id}}</small>
                                {!! $statement->payment->status_context !!}
                                <small>{{__t('date')}}: {!! $statement->created_at->format(date_time_format()) !!}</small>
                            </p>

                            @if( ! empty($statement->payment->user))
                                <h5 class="my-3"><i class="la la-user"></i> Customer</h5>

                                <p class="mb-0">{{$statement->payment->user->name}} </p>
                                <p class="text-muted mb-0">
                                    <small>
                                        @if($statement->payment->user->address)
                                            {{$statement->payment->user->address}},
                                        @endif
                                        @if($statement->payment->user->address_2)
                                            {{$statement->payment->user->address_2}},
                                        @endif
                                        @if($statement->payment->user->city)
                                            {{$statement->payment->user->city}},
                                        @endif
                                        @if($statement->payment->user->zip_code)
                                            {{$statement->payment->user->zip_code}}
                                        @endif
                                    </small>
                                </p>
                                @if($statement->payment->user->country)
                                    <small class="text-muted">
                                        {{$statement->payment->user->country->name}}
                                    </small>
                                @endif


                            @endif
                        </td>
                        <td>

                            <p class="mb-0">
                                {!! price_format($statement->instructor_amount) !!}
                            </p>
                            <p class="text-muted mb-0"><small>As per {{$statement->instructor_share}} (percent)</small>
                            </p>


                        </td>
                        <td>
                            <p class="mb-0">
                                {!! price_format($statement->admin_amount) !!}
                            </p>
                            <p class="text-muted mb-0"><small>As per {{$statement->admin_share}} (percent)</small></p>
                        </td>
                    </tr>

                @endforeach

            </table>

        @else

            {!! no_data(__t('no_statement_found')) !!}

        @endif

        <div class="mt-5">
            {!! $statements->appends(request()->input())->links() !!}
        </div>

    </div>

@endsection


@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css')}}">
@endsection


@section('page-js')

    <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('assets/plugins/chartjs/Chart.min.js')}}"></script>

    <script>
        var ctx = document.getElementById("ChartArea").getContext('2d');
        var ChartArea = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($chartData)) !!},
                datasets: [{
                    label: 'Earning ',
                    backgroundColor: '#216094',
                    borderColor: '#216094',
                    data: {!! json_encode(array_values($chartData)) !!},
                    borderWidth: 2,
                    fill: false,
                    lineTension: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0, // it is for ignoring negative step.
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return '{{get_currency()}} ' + value;
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(t, d) {
                            var xLabel = d.datasets[t.datasetIndex].label;
                            var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '{{get_currency()}} ' + t.yLabel;
                            return xLabel + ': ' + yLabel;
                        }
                    }
                },
                legend: {
                    display: false
                }
            }
        });
    </script>

    <script>
        $(function () {
            $('.date_picker').datetimepicker({format: 'YYYY-MM-DD'});
        });
    </script>

@endsection
