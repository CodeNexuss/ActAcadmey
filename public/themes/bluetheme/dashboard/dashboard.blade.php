@extends(theme('dashboard.layout'))

@section('content')
    @php
        $user_id = $auth_user->id;

        $enrolledCount = \App\Enroll::whereUserId($user_id)->whereStatus('success')->count();
        $wishListed = \Illuminate\Support\Facades\DB::table('wishlists')->whereUserId($user_id)->count();

        $myReviewsCount = \App\Review::whereUserId($user_id)->count();
        $purchases = $auth_user->purchases()->take(10)->get();
    @endphp

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card mb-3 p-3">
                <div class="card-icon mb-3">
                    <span><i class="la la-user"></i> </span>
                </div>

                <div class="card-info pl-2">
                    <div class="text-value"><h4><Strong>{{$enrolledCount}}</Strong></h4></div>
                    <p>{{__t('enrolled_courses')}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card mb-3 p-3">
                <div class="card-icon mb-3">
                    <span><i class="la la-heart"></i> </span>
                </div>

                <div class="card-info pl-2">
                    <div class="text-value"><h4><strong>{{$wishListed}}</strong></h4></div>
                    <p>{{__t('in_wishlist')}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card mb-3 p-3">
                <div class="card-icon mb-3">
                    <span><i class="la la-star-half-alt"></i> </span>
                </div>

                <div class="card-info pl-2">
                    <div class="text-value"><h4><strong>{{$myReviewsCount}}</strong></h4></div>
                    <p>{{__t('my_reviews')}}</p>
                </div>
            </div>
        </div>

    </div>

    @if($chartData)
        <div class="p-4 bg-white">
            <h4 class="mb-4">{{__t('my_reviews_for_month')}} ({{date('M')}})</h4>

            <canvas id="ChartArea"></canvas>
        </div>
    @endif

    @if($purchases->count() > 0)
        <h4 class="my-4"> {{sprintf(__t('my_last_purchases'), $purchases->count())}} </h4>
        <div class="cls_table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__t('amount')}}</th>
                        <th>{{__t('method')}}</th>
                        <th>{{__t('time')}}</th>
                        <th>{{__t('status')}}</th>
                        <th>{{__t('actions')}}</th>
                    </tr>
                </thead>
                    <tbody>

                    @foreach($purchases as $purchase)
                        <tr>
                            <td>
                                #{{$purchase->id}}
                            </td>
                            <td>
                                {!!price_format($purchase->amount)!!}
                            </td>
                            <td>{!!ucwords(str_replace('_', ' ', $purchase->payment_method))!!}</td>

                            <td>
                                
                                    {!!$purchase->created_at->format(get_option('date_format'))!!} 
                                    {!!$purchase->created_at->format(get_option('time_format'))!!}
                                
                            </td>

                            <td>
                                {!! $purchase->status_context !!}
                            </td>
                            <td>
                                @if($purchase->status == 'success')
                                    <span class="text-success" data-toggle="tooltip" title="{!!$purchase->status!!}"><i class="fa fa-check-circle-o"></i> </span>
                                @else
                                    <span class="text-warning" data-toggle="tooltip" title="{!!$purchase->status!!}"><i class="fa fa-exclamation-circle"></i> </span>
                                @endif

                                <a href="{!!route('purchase_view', $purchase->id)!!}" class="text-link" style="font-size: 17px;background: #5022C3;color: #fff;padding: 5.5px 9px;border-radius: 8px;"><i class="la la-eye"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection

@section('page-js')

    @if($chartData)
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
    @endif
@endsection
