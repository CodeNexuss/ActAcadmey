@extends(theme('dashboard.layout'))

@section('content')

    <div class="dashboard-inline-submenu-wrap mb-4 border-bottom">
        <a href="{{route('earning')}}" class="active">{{__t('earnings')}}</a>
        <a href="{{route('earning_report')}}" class="">{{__t('report_statements')}}</a>
    </div>


    <div class="row cls_bg_gray">
        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('lifetime_sales')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($user->earning->sales_amount) !!}</h4>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('lifetime_earnings')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($user->earning->earnings) !!}</h4>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('commission_deducted')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($user->earning->commission) !!}</h4>
            </div>
        </div>


        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('lifetime_withdraws')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($user->earning->withdrawals) !!}</h4>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card card-body border border-dark mb-4">
                <h6 class="text-muted text-uppercase">{{__t('balance')}}</h6>
                <h4 class="earning-stats amount">{!! price_format($user->earning->balance) !!}</h4>
                <a href="{{route('withdraw')}}"> <small><i class="la la-cash-register"></i> {{__t('withdraw')}}</small></a>
            </div>
        </div>

    </div>


    <div class="p-4 bg-white">
        <h4 class="mb-4">{{__t('earning_for_this_month')}}</h4>

        <canvas id="ChartArea"></canvas>
    </div>
@endsection


@section('page-js')
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

@endsection
