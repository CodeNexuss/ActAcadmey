@extends('layouts.admin')

@section('page-header-right')
    @if(count(request()->input()))
        <a href="{{route('payments')}}"> <i class="la la-arrow-circle-left"></i> {{__a('reset_filter')}}  </a>
    @endif
@endsection

@section('content')

    <form method="get">

        <div class="row">

            <div class="col-md-5">
                <div class="input-group">
                    <select name="status" class="mr-3 form-control" style="flex: 0 0 200px;border-radius: 8px;">
                        <option value="">{{__a('set_status')}}</option>

                        <option value="initial">{{__a('initial')}}</option>
                        <option value="pending">{{__a('pending')}}</option>
                        <option value="onhold">{{__a('onhold')}}</option>
                        <option value="success">{{__a('success')}}</option>
                        <option value="failed">{{__a('failed')}}</option>
                        <option value="declined">{{__a('declined')}}</option>
                        <option value="dispute">{{__a('dispute')}}</option>
                        <option value="expired">{{__a('expired')}}</option>
                    </select>

                    <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2">{{__a('update')}}</button>
                    <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm"> <i class="la la-trash"></i> {{__a('delete')}}</button>
                </div>
            </div>

            <div class="col-md-7">

                <div class="search-filter-form-wrap mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control mr-3" name="q" value="{{request('q')}}" placeholder="{{__a('filter_by_name_email')}}">
                        <select name="filter_status" class="form-control mr-3">
                            <option value="">{{__a('filter_by_status')}}</option>
                            <option value="initial" {{selected('initial', request('filter_status'))}} >{{__a('initial')}}</option>
                            <option value="pending" {{selected('pending', request('filter_status'))}} >{{__a('pending')}}</option>
                            <option value="onhold" {{selected('onhold', request('filter_status'))}} >{{__a('onhold')}}</option>
                            <option value="success" {{selected('success', request('filter_status'))}} >{{__a('success')}}</option>
                            <option value="failed" {{selected('failed', request('filter_status'))}} >{{__a('failed')}}</option>
                            <option value="declined" {{selected('declined', request('filter_status'))}} >{{__a('declined')}}</option>
                            <option value="dispute" {{selected('dispute', request('filter_status'))}} >{{__a('dispute')}}</option>
                            <option value="expired" {{selected('expired', request('filter_status'))}} >{{__a('expired')}}</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-purple"><i class="la la-search-plus"></i> {{__a('filter_results')}}</button>
                    </div>
                </div>
            </div>

        </div>

        @if($payments->count() > 0)


             <div class="cls_table table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <th><input class="bulk_check_all" type="checkbox" /></th>
                        <th>{{__a('paid_by')}}</th>
                        <th>{{__a('amount')}}</th>
                        <th>{{__a('method')}}</th>
                        <th>{{__a('time')}}</th>
                        <th>{{__a('status')}}</th>
                        <th>{{__a('actions')}}</th>
                    </tr>

                    @foreach($payments as $payment)
                        <tr>
                            <td>
                                <label>
                                    <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$payment->id}}" />
                                    <span class="text-muted">#{{$payment->id}}</span>
                                </label>
                            </td>
                            <td>
                                <a href="{!!route('payment_view', $payment->id)!!}">
                                    {!!$payment->name!!} <br />
                                    <span>{!!$payment->email!!}</span>
                                </a>
                            </td>

                            <td>
                                {!!price_format($payment->amount)!!}
                            </td>
                            <td>{!!ucwords(str_replace('_', ' ', $payment->payment_method))!!}</td>

                            <td>
                                <span>
                                    {!!$payment->created_at->format(get_option('date_format'))!!} <br />
                                    {!!$payment->created_at->format(get_option('time_format'))!!}
                                </span>
                            </td>

                            <td>
                                {!! $payment->status_context !!}
                            </td>
                            <td>
                                @if($payment->status == 'success')
                                    <span class="text-success" data-toggle="tooltip" title="{!!$payment->status!!}"><i class="fa fa-check-circle-o"></i> </span>
                                @else
                                    <span class="text-warning" data-toggle="tooltip" title="{!!$payment->status!!}"><i class="fa fa-exclamation-circle"></i> </span>
                                @endif

                                <a href="{!!route('payment_view', $payment->id)!!}" class="btn btn-info"><i class="la la-eye"></i> </a>
                                <a href="{!!route('payment_delete', $payment->id)!!}" class="btn btn-danger delete_confirm"><i class="la la-trash"></i> </a>
                            </td>

                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="file-manager-footer-pagination-wrap my-5"> 
                {!! $payments->appends(['q' => request('q'), 'status'=> request('filter_status') ])->links() !!}
            </div>
        @else
            {!! no_data() !!}
        @endif

    </form>


@endsection

