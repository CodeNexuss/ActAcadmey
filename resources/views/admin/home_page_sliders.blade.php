@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('home_page_slider_create')}}" class=" ml-1 btn btn-primary btn-xl" data-toggle="tooltip" title="@lang('admin.create')"> <i class="la la-plus"></i> </a>
    <a href="#" id="delete_home_page_slider" class=" ml-1 btn btn-danger btn_delete" data-toggle="tooltip" title="@lang('admin.delete')"><i class="la la-trash-o"></i> </a>
@endsection

@section('content')

    <div class="row content-row">

        <div class="col-sm-12 warning-msg" style="display: none;">
            <p class="alert alert-danger">Data add,edit & delete Operation are restricted in live</p>
        </div>

        <div class="col-md-12 content-col">

            <form action="" method="post" enctype="multipart/form-data"> @csrf
                @if($sliders->count())
                 <div class="cls_table table-responsive">
                    <table class="table table-bordered admin-categories-list">
                        <thead>
                        <tr>
                            <td><input id="bulk_check_all" class="bulk_check_all" type="checkbox" /></td>
                            <th>@lang('admin.name')</th>
                            <th>@lang('admin.description')</th>
                            <th>@lang('admin.image')</th>
                            <th>@lang('admin.order')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>

                        </thead>

                        <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td><input class="slider_checkbox bulk_check_all" name="bulk_ids[]" type="checkbox" value="{{ $slider->id }}" /></td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ \Str::limit($slider->description, 150) }}</td>
                                    <td><img src="{{media_image_uri($slider->image)->thumbnail}}" alt="" class="img-thumbnail img-50X50" /></td>
                                    <td>{{ $slider->order }}</td>
                                    <td>
                                        <span class="badge {{ $slider->status==1 ? 'badge-success' : 'badge-danger' }}">{{ $slider->status==1 ? __a('active') : __a('inactive') }}</span>
                                    </td>
                                    <td>
                                        <a href="{{route('home_page_slider_edit', $slider->id)}}" class="btn btn-primary btn-sm"><i class="la la-pencil"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>

                @else

                    {!! no_data() !!}

                @endif

            </form>
             <div class="file-manager-footer-pagination-wrap my-5">
            {!! $sliders->links() !!}
        </div>

        </div>

    </div>


@endsection


@section('page-js')
    <script type="text/javascript">
        let env = "{{ is_live_env() ? 'live' : 'local' }}";

        $(document).on('click', '#delete_home_page_slider', function(e){
            e.preventDefault();
            if(env=='live') {
                $('.warning-msg').show();
                $('input').prop('checked', false);
                setTimeout(function() { $('.warning-msg').hide(); }, 3000);
                return;
            }

            var checked_values = [];
            $('.slider_checkbox:checked').each(function(index){
                checked_values.push(this.value);
            });

            if (checked_values.length > 0){
                if ( ! confirm('@lang('admin.deleting_confirm')')){
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{route('home_page_slider_delete')}}',
                    data: { slider_ids: checked_values, _token: pageData.csrf_token},
                    success: function(data){
                        if (data.success){
                            window.location.reload(true);
                        }
                    }
                });
            }
        });

        $(document).on('change', '#bulk_check_all', function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
