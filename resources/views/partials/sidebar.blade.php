<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <img src="{{asset('public/asset/img/logo.png')}}" class="img-circle img-responsive" alt="User Image">
        </div>
        <!--      <div class="user-panel">
                <div class="pull-left image">
                  <img src="{{asset('public/health/img/mak.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>-->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{!! Request::is('dashboard') ? 'active' : '' !!}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->unit_type() == 'Main Unit')
            <li class="{!! Request::is('unit/*') ? 'active' : '' !!}">
                <a href="{{route('list_unit')}}">
                    <i class="fa fa-tree"></i> <span>Units</span>
                </a>
            </li>
            @endif
            <li class="{!! Request::is('employee/*') ? 'active' : '' !!}">
                <a href="{{route('list_employee')}}">
                    <i class="fa fa-id-card"></i> <span>Employees</span>
                </a>
            </li>
            <li class="{!! Request::is('announcement/*') ? 'active' : '' !!}">
                <a href="{{route('list_announcement')}}">
                    <i class="fa fa-bullhorn"></i> <span>Announcement</span>
                </a>
            </li>
            <li class="{!! Request::is('status/*') ? 'active' : '' !!}">
                <a href="{{route('list_status')}}">
                    <i class="fa fa-check"></i> <span>Status</span>
                </a>
            </li>
            <li class="{!! Request::is('news/*') ? 'active' : '' !!}">
                <a href="{{route('list_news')}}">
                    <i class="fa fa-newspaper-o"></i> <span>News</span>
                </a>
            </li>
            <li class="treeview {!! Request::is('message/*') ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Message</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! Request::is('message/inbox') ? 'active' : '' !!}">
                        <a href="{{route('inbox_message')}}">
                            <i class="fa fa-inbox"></i> 
                            <span>Inbox 
                                @if(Auth::user()->unread_message())
                                <span class="label label-primary pull-right">{{Auth::user()->unread_message()}}</span>
                                @endif  
                            </span>
                        </a>
                    </li>
                    <li class="{!! Request::is('message/sent') ? 'active' : '' !!}">
                        <a href="{{route('sent_message')}}">
                            <i class="fa fa-envelope-o"></i> <span>Sent</span>
                        </a>
                    </li>
                    <li class="{!! Request::is('message/compose') ? 'active' : '' !!}">
                        <a href="{{route('compose_message')}}">
                            <i class="fa fa-pencil"></i> <span>Compose</span>
                        </a>
                    </li>
                </ul>
            </li>
            @role('Admin')
            <li class="header">Users, Roles & Permissions</li>

            <li class="{!! Request::is('users','users/*') ? 'active' : '' !!}">
                <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Users</a>
            </li>
            <li class="{!! Request::is('roles','roles/*') ? 'active' : '' !!}">
                <a href="{{route('roles.index')}}"><i class="fa fa-bell"></i> Roles</a>
            </li>
            <li class="{!! Request::is('permissions','permissions/*') ? 'active' : '' !!}">
                <a href="{{route('permissions.index')}}"><i class="fa fa-lock"></i> Permissions</a>
            </li>
            @endrole

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>