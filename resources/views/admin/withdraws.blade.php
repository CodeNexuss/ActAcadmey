@extends('layouts.admin')


@section('page-header-right')

    <a href="{{route('withdraws')}}" class="btn btn-dark ml-2"> <i class="la la-clock-o"></i> {{__a('pending')}}</a>
    <a href="{{route('withdraws', ['status' => 'success'])}}" class="btn btn-success ml-2" style="background-color: #28a745;  border-color: #28a745;color: #fff;"> <i class="la la-check-circle"></i> {{__a('success')}}</a>
    <a href="{{route('withdraws', ['status' => 'rejected'])}}" class="btn btn-warning ml-2" style="background-color: #dc3545;  border-color: #dc3545;color: #fff;"> <i class="la la-exclamation-circle"></i> {{__a('rejected')}}</a>
    <a href="{{route('withdraws', ['status' => 'all'])}}" class="btn btn-light ml-2" > <i class="la la-th-list"></i> {{__a('all')}}</a>

@endsection

@section('content')

    <div class="withdraws-list-wrap">

        <form action="" method="get">


            @if($withdraws->count() > 0)

                <div class="row">

                    <div class="col-md-12">
                        <div class="input-group">
                            <select name="update_status" class="mr-3 form-control" style="flex: 0 0 200px;border-radius: 8px;">
                                <option value="">{{__a('set_status')}}</option>

                                <option value="pending">{{__a('pending')}}</option>
                                <option value="approved">{{__a('approved')}}</option>
                                <option value="rejected">{{__a('rejected')}}</option>
                            </select>

                            <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2">{{__a('update')}}</button>
                            <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm"> <i class="la la-trash"></i> {{__a('delete')}}</button>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <div class="cls_table table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th><input class="bulk_check_all" type="checkbox" /></th>
                                    <th>{{__a('amount')}}</th>
                                    <th>{{__a('details')}}</th>
                                    <th>{{__a('date')}} & {{__a('time')}}</th>
                                </tr>

                                @foreach($withdraws as $withdraw)

                                    <tr>

                                        <td>
                                            <label>
                                                <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$withdraw->id}}" />
                                                <span class="text-muted">#{{$withdraw->id}}</span>
                                            </label>
                                        </td>
                                        <td>
                                            <h6 class="mb-4">{{__a('amount')}}: <strong>{!! price_format($withdraw->amount) !!}</strong> {!! $withdraw->status_context !!} </h6>
                                            <h6>{{__a('method')}}: <strong>{{array_get($withdraw->method_data, 'method_name')}}</strong></h6>


                                        </td>

                                        <td>

                                            @if(is_array(array_get($withdraw->method_data, 'form_fields')))
                                                @foreach(array_get($withdraw->method_data, 'form_fields') as $field)
                                                    <p class="mb-0"> {{array_get($field, 'label')}} : <strong>{!! array_get($field, 'value') !!}</strong></p>
                                                @endforeach
                                            @endif

                                            {{clean_html($withdraw->description)}}

                                        </td>

                                        <td>{{$withdraw->created_at->format(date_time_format())}}</td>
                                    </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

                {!! $withdraws->appends(request()->input())->links() !!}

            @else
                {!! no_data() !!}
            @endif

        </form>



    </div>


@endsection
