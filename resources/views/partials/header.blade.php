<header class="main-header">
    <!-- Logo -->
    <a href="{{route('index')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>D</b>R</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Daily</b>Report</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a>{{Auth::user()->unit_name()}}</a></li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if(Auth::user()->notification_count())<span class="label label-warning">{{Auth::user()->notification_count()}}</span>@endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{Auth::user()->notification_count()}} new notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(Auth::user()->notifications() as $notification)
                                <li>
                                    @if($notification->type == 'announcement')
                                    <a href="{{route('view_announcement', ['id' => $notification->target_id])}}" class="{{$notification->seen_by ? '':'text-bold'}}">
                                        <i class="fa fa-bullhorn text-aqua"></i> 
                                        1 new announcement from {{$notification->from_unit()->unit_name}}
                                    </a>
                                    @elseif($notification->type == 'status')
                                    <a href="{{route('view_status', ['id' => $notification->target_id])}}" class="{{$notification->seen_by ? '':'text-bold'}}">
                                        <i class="fa fa-check text-aqua"></i> 
                                                1 new status from {{$notification->from_unit()->unit_name}}
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                                
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        @if(Auth::user()->unread_message())
                        <span class="label label-success">{{Auth::user()->unread_message()}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{Auth::user()->unread_message()}} unread messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(Auth::user()->unread_messages() as $message)
                                <li><!-- start message -->
                                    <a href="{{route('view_inbox', ['id' => $message->id])}}">
                                        <div class="pull-left">
                                            <i class="fa fa-envelope-o fa-2x"></i>
                                        </div>
                                        <h4 class="{{$message->seen_by ? '':'text-bold'}}">
                                            {{$message->from_unit()}}
                                            <small><i class="fa fa-clock-o"></i> {{$message->humanTiming()}}</small>
                                        </h4>
                                        <p>{{$message->subject}}</p>
                                    </a>
                                </li>
                                <!-- end message -->
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{route('inbox_message')}}">See All Messages</a></li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="{{route('logout')}}">
                        <span class="hidden-xs"><i class="fa fa-sign-out"></i> Sign out [{{Auth::user()->name}}]</span>
                    </a>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>