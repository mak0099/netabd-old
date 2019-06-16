@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('asset/plugins/select2/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h4><a href="{{route('view_news', ['id'=>$news->id])}}">{{$news->title}}</a> <span class="time pull-right text-muted text-sm"><i class="fa fa-clock-o"></i> {{$news->humanTiming()}} ago</span></h4>
                <span class="text-muted text-sm">by <a href="#"> {{$news->user()->username}}</a> at {{date('F d, Y', strtotime($news->created_at . '+6 hours'))}} </span>
                <span class="pull-right text-muted text-sm"> Unit Name : <a href="#">{{$news->unit()->unit_name}}</a></span>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <div class="box-body">
                <div class="row">
                    @if($news->file_name)
                    <div class=" col-md-offset-4 col-md-4">
                        <img src="{{asset($news->file_directory . $news->file_name)}}" class="img-responsive img-thumbnail">
                    </div>
                    <br>
                    @endif
                    <div class="col-md-12 text-justify">
                        <?php echo $news->description; ?> 
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('list_news')}}" class="btn btn-default">Back</a>
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