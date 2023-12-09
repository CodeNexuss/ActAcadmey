@extends('layouts.admin')

@section('content')

    <form method="get">


        <div class="row flex-wrap">

            <div class="col-md-4">
                <div class="input-group flex-wrap">
                    <select name="status" class="mr-3 mb-2 form-control" style="flex:0 0 180px; border-radius: 8px;">
                        <option value="">{{__a('set_status')}}</option>

                        <option value="1">{{__a('active')}}</option>
                        <option value="2">{{__a('block')}}</option>
                    </select>

                    <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2 mb-2">{{__a('update')}}</button>
                    <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm mb-2"> <i class="la la-trash"></i> {{__a('delete')}}</button>
                </div>
            </div>

            <div class="col-md-8">

                <div class="search-filter-form-wrap mb-3">
                    <div class="input-group flex-wrap justify-content-end">
                        <input type="text" class="form-control ml-3 mb-2" style="flex:0 0 220px;" name="q" value="{{request('q')}}" placeholder="Filter by Name, E-Mail">
                        <select name="filter_status" class="ml-3 mb-2 form-control" style="flex:0 0 180px;">
                            <option value="">Status</option>
                            <option value="1" {{selected(1, request('filter_status'))}} > {{__a('active')}} </option>
                            <option value="2" {{selected(2, request('filter_status'))}} > {{__a('blocked')}} </option>
                        </select>
                        <select name="filter_user_group" class="ml-3 mb-2 form-control" style="flex:0 0 180px;">
                            <option value="">{{__a('user_group')}}</option>
                            <option value="student" {{selected('student', request('filter_user_group'))}} > {{__a('students')}} </option>
                            <option value="instructor" {{selected('instructor', request('filter_user_group'))}} > {{__a('instructors')}} </option>
                            <option value="admin" {{selected('admin', request('filter_user_group'))}} > {{__a('admin')}} </option>

                        </select>

                        <button type="submit" class="btn btn-primary btn-purple mb-2 ml-3"><i class="la la-search-plus"></i> {{__a('filter_results')}}</button>
                    </div>
                </div>
            </div>

        </div>


        @if($users->total())

            <div class="row">
                <div class="col-sm-12">
                     <div class="cls_table table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th><input class="bulk_check_all" type="checkbox" /></th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.email') }}</th>
                                <th>{{__a('type')}}</th>
                            </tr>
                            @foreach($users as $u)
                                <tr>
                                    <td>
                                        <label>
                                            <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$u->id}}" />
                                            <span class="text-muted">#{{$u->id}}</span>
                                        </label>
                                    </td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ protectedString($u->email) }}</td>
                                    <td>

                                        @if($u->isAdmin)
                                            <span class="badge badge-success">{{__a('admin')}}</span>
                                        @elseif($u->isInstructor)
                                            <span class="badge badge-info">{{__a('instructors')}}</span>
                                        @else
                                            <span class="badge badge-dark">{{__a('students')}}</span>
                                        @endif

                                        @if($u->active_status == 2)
                                            <span class="badge badge-danger">{{__a('blocked')}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>


                    {!! $users->appends(request()->input())->links() !!}

                </div>
            </div>

        @else
            {!! no_data() !!}
        @endif

    </form>

@endsection
