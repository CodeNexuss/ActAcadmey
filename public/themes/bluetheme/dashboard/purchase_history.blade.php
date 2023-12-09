@extends(theme('dashboard.layout'))

@section('content')

    @php
        $purchases = $auth_user->purchases()->paginate(50);
    @endphp

    @if($purchases->count() > 0)
        <p class="text-muted my-3"> <small>{{ sprintf(__t('pagination_info_show'), $purchases->count(), $purchases->total()) }}</small> </p>
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
                           
                                {!!$purchase->created_at->format(get_option('date_format'))!!} <br />
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

                            <a href="{!!route('purchase_view', $purchase->id)!!}" class="btn btn-info"><i class="la la-eye"></i> </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {!! $purchases->appends(request()->input())->links() !!}

    @else
        {!! no_data(__t('nothing_here'), __t('nothing_here_desc')) !!}
    @endif




@endsection
