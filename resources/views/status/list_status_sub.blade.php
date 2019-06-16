@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3>Status List </h3>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped data-table" style="min-width: 500px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $key => $status)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a href="{{route('view_status',['id' => $status->id])}}">{{$status->title}}</a></td>
                            <td>
                                @if($status->publication_status)
                                <a href="{{route('unpublish_status', ['id' => $status->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_status', ['id' => $status->id])}}"><span class="label label-warning">Draft</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('view_status',['id' => $status->id])}}" class="btn btn-default"><i class="fa fa-eye"></i> View</a>
                                <a href="{{route('edit_status',['id' => $status->id])}}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_status',['id' => $status->id])}}" class="btn btn-default" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{route('add_status')}}" class="btn btn-default"><span class="fa fa-plus"></span> Add Status</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
                                    $(function () {
                                        $('.data-table').DataTable({
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": true,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": false
                                        });
                                    });
</script>
@endsection