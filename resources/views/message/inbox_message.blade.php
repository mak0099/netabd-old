@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('asset/plugins/iCheck/flat/blue.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Inbox</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Search Mail">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            @if(count($messages)>0)
            <div class="box-body no-padding">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>

                    <a href="{{route('compose_message')}}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Compose</a>
                    <div class="pull-right">
                        {{$messages->firstItem() . '-' . $messages->lastItem() . '/' . $messages->total()}} 
                        <div class="btn-group">
                            <a href="{{$messages->previousPageUrl()}}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                            <a href="{{$messages->nextPageUrl()}}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                </div>
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                            @foreach($messages as $message)
                            <tr>
                                <td style="width: 40px;"><input type="checkbox"></td>
                                <td class="mailbox-star text-center" style="width: 40px"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                <td class="mailbox-name text-left {{$message->seen_by ? '':'text-bold'}}"><a href="{{route('view_inbox', ['id' => $message->id])}}">{{$message->from_unit()}}</a></td>
                                <td class="mailbox-subject {{$message->seen_by ? '':'text-bold'}}">{{$message->subject}}</td>
                                <td class="mailbox-attachment">@if($message->file_name)<i class="fa fa-paperclip"></i>@endif</td>
                                <td class="mailbox-date">{{$message->humanTiming()}} ago</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->

            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <a href="{{route('compose_message')}}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Compose</a>
                    <div class="pull-right">
                        {{$messages->firstItem() . '-' . $messages->lastItem() . '/' . $messages->total()}} 
                        <div class="btn-group">
                            <a href="{{$messages->previousPageUrl()}}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                            <a href="{{$messages->nextPageUrl()}}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                </div>
            </div>
            @else
            <div class="box-body text-center text-muted">
                <span>Empty</span>
            </div>
            @endif
        </div>
        <!-- /. box -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
@section('after_script')
<script src="{{asset('asset/plugins/iCheck/icheck.min.js')}}"></script>
<script>
$(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
        var clicks = $(this).data('clicks');
        if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
        e.preventDefault();
        //detect type
        var $this = $(this).find("a > i");
        var glyph = $this.hasClass("glyphicon");
        var fa = $this.hasClass("fa");

        //Switch states
        if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
        }

        if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
        }
    });
});
</script>
@endsection