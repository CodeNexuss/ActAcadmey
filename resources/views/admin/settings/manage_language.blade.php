@extends('layouts.admin')

@section('content')

    <form method="get">


        <div class="row flex-wrap">

            <div class="col-md-10">
                <div class="input-group flex-wrap">
                    <select name="status" class="mr-3 mb-2 form-control" style="flex:0 0 180px; border-radius: 8px;">
                        <option value="">{{__a('set_status')}}</option>
                        <option value="1">{{ __a('active') }}</option>
                        <option value="0">{{ __a('inactive') }}</option>
                    </select>


                    <button type="button" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2 mb-2 bulk_action_btn">{{__a('update')}}</button>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{route('language_add')}}" class=" ml-1 btn btn-primary btn-xl" data-toggle="tooltip" title="{{ __a('add_language') }}"> <i class="la la-plus"></i> </a>
                <a href="#" class=" ml-1 btn btn-danger btn_delete" data-toggle="tooltip" title="@lang('admin.delete')"><i class="la la-trash-o"></i> </a>
            </div>

        </div>


        @if($languages->total())

            <div class="row">
                <div class="col-sm-12 warning-msg" style="display: none;">
                    <p class="alert alert-danger">Data add,edit & delete Operation are restricted in live</p>
                </div>

                <div class="col-sm-12">
                     <div class="cls_table table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" /></th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.value') }}</th>
                                <th>{{ trans('admin.status') }}</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                            @foreach($languages as $lang)
                                <tr>
                                    <td>
                                        <label>
                                            <input class="check_language" name="bulk_ids[]" type="checkbox" value="{{$lang->id}}" @if($lang->default_language == 1) disabled="disabled" @endif />
                                            <span class="text-muted">#{{$lang->id}}</span>
                                        </label>
                                    </td>
                                    <td>
                                        {{ $lang->name }}
                                        @if($lang->default_language == 1)
                                            <span class="badge badge-info">{{ __a('default') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $lang->value }}</td>
                                    <td>

                                        @if($lang->status == 1)
                                            <span class="badge badge-success">{{ __a('active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __a('inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('language_edit', $lang->id)}}" class="btn btn-primary btn-sm"><i class="la la-pencil"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>

        @else
            {!! no_data() !!}
        @endif

    </form>

@endsection

@section('page-js')
    <script type="text/javascript">

        let env = "{{ is_live_env() ? 'live' : 'local' }}";

        $(document).on('click', '.btn_delete', function(e){
            e.preventDefault();
            if(env=='live') {
                $('.warning-msg').show();
                $('input').prop('checked', false);
                setTimeout(function() { $('.warning-msg').hide(); }, 3000);
                return;
            }

            var checked_values = [];
            $('.check_language:checked').each(function(index){
                if(!$(this).prop('disabled')) {
                    checked_values.push(this.value);
                }
            });

            if (checked_values.length){
                if ( ! confirm('@lang('admin.deleting_confirm')')){
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{route('language_destroy')}}',
                    data: { languages: checked_values, _token: pageData.csrf_token},
                    success: function(data){
                        if (data.success){
                            window.location.reload(true);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.bulk_action_btn', function(e){
            e.preventDefault();
            if(env=='live') {
                $('.warning-msg').show();
                $('input').prop('checked', false);
                setTimeout(function() { $('.warning-msg').hide(); }, 3000);
                return;
            }

            let status_val = $('select[name="status"]').val();

            if(status_val != '') {
                var checked_values = [];
                $('.check_language:checked').each(function(index){
                    if(!$(this).prop('disabled')) {
                        checked_values.push(this.value);
                    }
                });

                if (checked_values.length){
                    $.ajax({
                        type: 'POST',
                        url: '{{route('language_bulk_status_update')}}',
                        data: { languages: checked_values, status:  status_val, _token: pageData.csrf_token},
                        success: function(data){
                            if (data.success){
                                window.location.reload(true);
                            }
                        }
                    });
                }
            } else {
                return;
            }

        });

        $(document).on('change', '#bulk_check_all', function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
            $('input:disabled').prop('checked', false);
        });
    </script>
@endsection