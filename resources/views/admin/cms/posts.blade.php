@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('create_post')}}" class="btn btn-success" data-toggle="tooltip" title="{{__a('create_new_post')}}"> <i class="la la-plus-circle"></i> {{__a('create_new_post')}} </a>
@endsection

@section('content')

    <form action="" method="get">

        <div class="row mb-4">

            <div class="col-md-12">
                <div class="input-group">
                    <select name="status" class="mr-3 form-control mr-auto" style="flex: 0 0 200px;border-radius: 8px;">
                        <option value="">{{__a('set_status')}}</option>

                        <option value="1">{{__a('publish')}}</option>
                        <option value="2">{{__a('unpublish')}}</option>
                    </select>

                    <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2">
                        <i class="la la-refresh"></i> {{__a('update')}}
                    </button>
                    <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm"> <i class="la la-trash"></i> {{__a('delete')}}</button>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-sm-12">
                @if($posts->count())
                 <div class="cls_table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><input class="bulk_check_all" type="checkbox" /></th>
                            <th>{{__a('images')}}</th>
                            <th>@lang('admin.title')</th>
                            <th>{{__a('published_time')}}</th>
                            <th>@lang('admin.actions')</th>
                        </tr>
                        </thead>

                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$post->id}}" />
                                        <span class="text-muted">#{{$post->id}}</span>
                                    </label>
                                </td>
                                <td width="80">
                                    <div class="post_img">
                                     <img src="{{media_image_uri($post->feature_image)->thumbnail}}" class="img-fluid" />
                                    </div>
                                    
                                </td>
                                <td>{{$post->title}} {!! $post->status_context !!}</td>
                                <td>{{$post->published_time}}</td>

                                <td>
                                    <a href="{{route('edit_post',$post->id)}}" class="btn btn-primary">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="{{route('post', $post->slug)}}" class="btn btn-purple"><i class="la la-eye"></i> </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                @else
                    {!! no_data() !!}
                @endif

                {!! $posts->links() !!}

            </div>
        </div>

    </form>

@endsection
