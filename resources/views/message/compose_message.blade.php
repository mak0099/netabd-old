@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('public/asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <form action="{{route('send_message')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <!--<label class="control-label">Select Un it</label>-->
                        <select class="form-control select2" name="to">
                            <option disabled selected>-- To --</option>
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Subject:" name="subject" value="{{Request::old('subject')}}">
                    </div>
                    <div class="form-group">
                        <textarea id="compose-textarea" name="body" class="form-control" rows="10" style="resize: vertical">{{Request::old('body')}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Attachment
                            <input type="file" name="attach_file">
                        </div>
                        <p class="help-block">Max. 5MB</p>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>
                    <a href="{{route('inbox_message')}}" class="btn btn-default"><i class="fa fa-times"></i> Discard</a>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('after_script')

<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('public/asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $("#compose-textarea").wysihtml5();
});
</script>
@endsection