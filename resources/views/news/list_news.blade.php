@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('public/asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection
@section('content_header')
<h2 class="page-header">Newses <a href="#" class="btn btn-success pull-right" id="add_news"><i class="fa fa-plus"></i> Add news</a></h2>
@endsection
@section('content')
<div class="box box-success" id="add_news_area">
    <div class="box-header with-border">
        <h3 class="box-title">Add a news</h3>
    </div>
    <!-- /.box-header -->
    @include('partials/messages')
    <form action="{{route('save_news')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="box-body">
            <div class="form-group">
                <input class="form-control" placeholder="Title" name="title" value="{{Request::old('title')}}" required>
            </div>
            <div class="form-group">
                <textarea id="compose-textarea" name="description" class="form-control" rows="5" style="resize: vertical" placeholder="Description" required>{{Request::old('description')}}</textarea>
            </div>
            <div class="form-group">
                <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Picture
                    <input type="file" name="attach_file" accept="image/jpeg">
                </div>
                <p class="help-block">Max. 500 KB</p>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Post</button>
            </div>
            <a href="#" class="btn btn-danger" id="close_add_news"><i class="fa fa-times"></i> Close</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
@if(count($newses) > 0)
@foreach($newses as $news)
<div class="box box-solid">
    <div class="box-header with-border">
        <h4><a href="{{route('view_news', ['id'=>$news->id])}}">{{$news->title}}</a> <span class="time pull-right text-muted text-sm"><i class="fa fa-clock-o"></i> {{$news->humanTiming()}} ago</span></h4>
        <span class="text-muted text-sm">by <a href="#"> {{$news->user()->username}}</a> at {{date('F d, Y', strtotime($news->created_at . '+6 hours'))}} </span>
        <span class="pull-right text-muted text-sm"> Unit Name : <a href="{{route('view_unit',['id'=>$news->unit()->id])}}">{{$news->unit()->unit_name}}</a></span>
    </div>
    <div class="box-body">
        <div class="row">
            @if($news->file_name)
            <div class="col-md-3">
                <img src="{{asset($news->file_directory . $news->file_name)}}" class="img-responsive img-thumbnail">
            </div>
            <br>
            <div class="col-md-9 text-justify">
                <?php echo str_limit($news->description, 500) ?> 
                <a href="{{route('view_news', ['id'=>$news->id])}}">read more</a>
            </div>
            @else
            <div class="col-md-12 text-justify">
                <?php echo str_limit($news->description, 500) ?> 
                <a href="{{route('view_news', ['id'=>$news->id])}}">read more</a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="text-center">
    {{$newses->links()}}
</div>
@endforeach
@else
<div class="box box-solid">
    <div class="box-body">
        <p class="text-justify">No news available</p>
    </div>
</div>
@endif
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
<script>
    $(function () {
        $('#add_news_area').hide();
        $('#add_news').click(function () {
            $('#add_news_area').slideDown();
        });
        $('#close_add_news').click(function () {
            $('#add_news_area').slideUp();
        });
    });
</script>
@endsection