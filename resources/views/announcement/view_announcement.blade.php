@extends('layout')
@section('after_style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('public/asset/plugins/select2/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <h3>View Announcement<a href="{{route('list_announcement')}}" class="btn bg-purple pull-right"><span class="ion-arrow-return-left"></span> Announcement List</a></h3>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
                <div class="box-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Title</th>
                            <tr>
                            </tr>
                                <td>{{$announcement->title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                            <tr>
                            </tr>
                                <td>{{$announcement->description}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{route('list_announcement')}}" class="btn btn-default">Back</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
@section('after_script')

<script src="{{asset('public/asset/plugins/select2/select2.full.min.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
@endsection