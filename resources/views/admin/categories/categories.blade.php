@extends('layouts.admin')

@section('page-header-right')
    <button name="bulk_action_btn" type="button" class=" ml-1 btn btn-primary btn-xl bulk_action_btn" value="1">
        <img src='{{ url("uploads/images/top-menu.png") }}'/> {{__a('mark_as_top')}}
    </button>
    <button name="bulk_action_btn" type="button" class=" ml-1 btn btn-warning btn-xl bulk_action_btn" value="0">
        <img src='https://img.icons8.com/material-outlined/18/000000/top-menu.png'/> {{__a('remove_from_top')}}
    </button>

    <a href="{{route('category_create')}}" class=" ml-1 btn btn-primary btn-xl" data-toggle="tooltip" title="@lang('admin.category_add')"> <i class="la la-plus"></i> </a>
    <a href="#" class=" ml-1 btn btn-danger btn_delete" data-toggle="tooltip" title="@lang('admin.delete')"><i class="la la-trash-o"></i> </a>
@endsection

@section('content')

    <div class="row content-row">

        <div class="col-md-12">
            <p class="float-right">{{ __a('top_categories_not_work_text') }}</p>
        </div>
        <div class="col-md-12 content-col">

            <form action="" method="post" enctype="multipart/form-data"> @csrf
                @if($categories->count())
                 <div class="cls_table table-responsive">
                    <table class="table table-bordered admin-categories-list">
                        <thead>
                        <tr>
                            <td><input id="bulk_check_all" class="bulk_check_all" type="checkbox" /></td>
                            <td>@lang('admin.category_name')</td>
                            <td>@lang('admin.thumb')</td>
                            <td>@lang('admin.image')</td>
                            <td>@lang('admin.action')</td>
                        </tr>

                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            @include('admin.categories.category_loop', ['category' => $category])

                            @foreach($category->sub_categories as $subCategory)
                                @include('admin.categories.category_loop', ['category' => $subCategory])
                                @foreach($subCategory->sub_categories as $lastCategory)
                                    @include('admin.categories.category_loop', ['category' => $lastCategory])
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>


                    </table>
                </div>

                @else

                    {!! no_data() !!}

                @endif

            </form>
             <div class="file-manager-footer-pagination-wrap my-5">
            {!! $categories->links() !!}
        </div>

        </div>

    </div>


@endsection


@section('page-js')
    <script type="text/javascript">
        $(document).on('click', '.btn_delete', function(e){
            e.preventDefault();

            var checked_values = [];
            $('.category_check:checked').each(function(index){
                checked_values.push(this.value);
            });

            if (checked_values.length){
                if ( ! confirm('@lang('admin.deleting_confirm')')){
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{route('delete_category')}}',
                    data: { categories: checked_values, _token: pageData.csrf_token},
                    success: function(resp){
                        if (resp.success){
                            window.location.reload(true);
                        } else {
                            if(resp.success==false) {
                                $('.content-row .content-col .alert').remove();

                                let msg = '<div class="alert alert-danger"><i class="la la-info-circle"></i>';
                                msg += resp.message;
                                msg += '<button class="close" data-dismiss="alert"><i class="la la-close"></i></button></div>';
                                $('.content-row .content-col').prepend(msg);
                                $('input').prop('checked', false);
                            }
                        }
                    }
                });
            }
        });

        $(document).on('change', '#bulk_check_all', function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).on('click', '.bulk_action_btn', function(event) {
            let ids = [];
            let mark_as_top = $(this).val();
            $('input:checked').each(function(elem, key) {
                ids.push($(key).val());
            });
            console.log(ids);
            if(ids.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('update_top_categories')}}',
                    data: { categories: ids, mark_as_top: mark_as_top, _token: pageData.csrf_token},
                    success: function(data){
                        $('.content-row .content-col .alert').remove();
                        if (data.status_code==200){
                            let msg = '<div class="alert alert-success"><i class="la la-info-circle"></i>';
                            msg += data.message;
                            msg += '<button class="close" data-dismiss="alert"><i class="la la-close"></i></button></div>';
                            $('.content-row .content-col').prepend(msg);
                            setTimeout(function() {window.location.reload(true);}, 500);
                        } else if(data.status_code===undefined || data.status_code===null) {
                            let msg = '<div class="alert alert-danger"><i class="la la-info-circle"></i>';
                            msg += 'Data add,edit & delete Operation are restricted in live';
                            msg += '<button class="close" data-dismiss="alert"><i class="la la-close"></i></button></div>';
                            $('.content-row .content-col').prepend(msg);
                        } else {
                            let msg = '<div class="alert alert-danger"><i class="la la-info-circle"></i>';
                            msg += data.message;
                            msg += '<button class="close" data-dismiss="alert"><i class="la la-close"></i></button></div>';
                            $('.content-row .content-col').prepend(msg);
                        }
                        $('input').prop('checked', false);
                    }
                });
            } else {
                return;
            }
            
        });
    </script>
@endsection
