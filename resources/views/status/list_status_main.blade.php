@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('asset/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content_header')
<h2 class="page-header">Statuses</h2>
@endsection
@section('content')
@if(count($statuses) > 0)
@foreach($statuses as $status)
<div class="box box-solid">
    <div class="box-header with-border">
        <h4>{{$status->title}} <span class="time pull-right text-muted text-sm"><i class="fa fa-clock-o"></i> {{date('h:m a', strtotime($status->created_at . '+6 hours'))}}</span></h4>
        <span class="text-muted text-sm">by <a href="#"> {{$status->user()->username}}</a> at {{date('F d, Y', strtotime($status->created_at . '+6 hours'))}} </span>
        <span class="pull-right text-muted text-sm"> Unit Name : <a href="{{route('view_unit',['id'=>$status->unit()->id])}}">{{$status->unit()->unit_name}}</a></span>
    </div>
    <div class="box-body">
        <p class="text-justify">{{$status->description}}</p>
    </div>
</div>
@endforeach
<div class="text-center">
    {{$statuses->links()}}
</div>
@else
<div class="box box-solid">
    <div class="box-body">
        <p class="text-justify">No status available</p>
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