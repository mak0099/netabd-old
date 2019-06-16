@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content_header')
<h2 class="page-header">Announcements</h2>
@endsection
@section('content')
@if(count($announcements) > 0)
@foreach($announcements as $announcement)
<div class="box box-solid">
    <div class="box-header with-border">
        <h4>{{$announcement->title}} <span class="time pull-right text-muted text-sm"><i class="fa fa-clock-o"></i> {{date('h:m a', strtotime($announcement->created_at . '+6 hours'))}}</span></h4>
        <span class="text-muted">by <a href="#"> {{$announcement->user()->username}}</a> at {{date('F d, Y', strtotime($announcement->created_at . '+6 hours'))}}</span>
    </div>
    <div class="box-body">
        <p class="text-justify">{{$announcement->description}}</p>
    </div>
</div>
@endforeach
<div class="text-center">
    {{$announcements->links()}}
</div>
@else
<div class="box box-solid">
    <div class="box-body">
        <p class="text-justify">No announcement available</p>
    </div>
</div>
@endif
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