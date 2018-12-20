@extends('layout')
@section('after_style')
@endsection
@section('content_header')

<a href="{{route('inbox_message')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Inbox</a>
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Read Mail</h3>

        <div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
    @include('partials/messages')
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3>{{$message->subject}}</h3>
            <h5>From: {{$message->from_unit()}}
                <span class="mailbox-read-time pull-right">{{date('F d, Y h:m a', strtotime($message->updated_at . '+6hours'))}}</span></h5>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="fa fa-trash-o"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fa fa-share"></i></button>
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                <i class="fa fa-print"></i></button>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            <?php echo $message->body ?>
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        @if($message->file_name)
        <ul class="mailbox-attachments clearfix">
            <li>
                <span class="mailbox-attachment-icon"><i class="fa fa-file-o"></i></span>

                <div class="mailbox-attachment-info">
                    <a href="{{URL::to($message->file_directory . $message->file_name)}}" class="mailbox-attachment-name" target="_blank"><i class="fa fa-paperclip"></i> {{$message->file_name}}</a>
                    <span class="mailbox-attachment-size">
                        attachment
                        <a href="{{URL::to($message->file_directory . $message->file_name)}}" class="btn btn-default btn-xs pull-right" target="_blank" title="Download"><i class="fa fa-cloud-download"></i></a>
                    </span>
                </div>
            </li>
        </ul>
        @endif
    </div>
    <!-- /.box-footer -->
    <div class="box-footer">
        <div class="pull-right">
            <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
            <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
        </div>
        <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
        <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /. box -->
@endsection
@section('after_script')

@endsection