@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('add_labels')}}" class=" ml-1 btn btn-primary btn-xl" data-toggle="tooltip" title="Add Label"> <i class="la la-plus"></i> </a>

    <a href="{{route('manage_labels')}}" class="ml-1 btn btn-secondary btn-xl" data-toggle="tooltip" title="Manage Labels"> <i class="la la-folder-open"></i> </a>
@endsection

@section('content')

    <div class="row content-row">

        <div class="col-md-12">

            @if($labels->count())
            <div class="cls_table table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label Name</th>
                        <th>Label Color</th>
                        <th>Order</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($labels as $label)
                            <tr>
                                <td>{{ $label->id }}</td>
                                <td>{{ $label->label_name }}</td>
                                <td>
                                    <div style="width: 20px; height: 20px; background-color: <?php echo $label->label_color ?>;"></div>
                                </td>
                                <td>{{ $label->order }}</td>
                                <td>
                                    <a href="{{route('edit_labels', $label->id)}}" class="btn btn-primary btn-sm"><i class="la la-pencil"></i> </a>
                                    <a href="{{route('delete_labels', $label->id)}}" class="btn btn-info btn-sm delete-label-btn"><i class="la la-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else

                {!! no_data() !!}

            @endif
            <div class="file-manager-footer-pagination-wrap my-5">
                {!! $labels->links() !!}
            </div>

        </div>

    </div>

@endsection
@section('page-js')
    <script type="text/javascript">
        
        $(function() {

            $(document).on('click', '.delete-label-btn', function(e) {
                if(!confirm('Do you want to continue?')) {
                    e.preventDefault();
                }
            });

        });

    </script>
@endsection
