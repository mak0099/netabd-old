@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('asset/plugins/select2/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div class="box-header">
                    <h3>Edit Status<a href="{{route('list_status')}}" class="btn bg-purple pull-right"><span class="ion-arrow-return-left"></span> Status List</a></h3>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('update_status', ['id' => $status->id])}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{$status->title}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="5">{{$status->description}}</textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Status</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="publication_status" value="1" {{$status->publication_status ? 'checked' : ''}}> Publish</label>
                            <label class="radio-inline"><input type="radio" name="publication_status" value="0" {{!$status->publication_status ? 'checked' : ''}}> Draft</label>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{route('list_status')}}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')

<script src="{{asset('asset/plugins/select2/select2.full.min.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
@endsection