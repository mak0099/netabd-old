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
                <h3>Add Status<a href="{{route('list_status')}}" class="btn bg-purple pull-right"><span class="ion-arrow-return-left"></span> Status List</a></h3>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_status')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-12">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{Request::old('title')}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="5">{{Request::old('description')}}</textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Status</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="publication_status" value="1" checked=""> Publish</label>
                            <label class="radio-inline"><input type="radio" name="publication_status" value="0"> Draft</label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
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