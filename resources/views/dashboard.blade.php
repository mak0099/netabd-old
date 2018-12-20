@extends('layout')

@section('content_header')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endsection

@section('content')
@if(Auth::user()->in_sub_unit() && $announcement)
<div class="box">
    <div class="box-header">
        <h3>Announcement</h3>
    </div>
    <div class="box-body">
        <div class="callout callout-success">
            <h4>{{$announcement->title}}</h4>

            <p class="text-justify">{{$announcement->description}}</p>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('list_announcement')}}" class="btn btn-link">View all</a>
    </div>
</div>
@endif
<!-- Small boxes (Stat box) -->

@endsection