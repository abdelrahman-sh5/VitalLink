<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blood Bank</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/dist/css/bootstrap.min.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">

    <!--favicon-->
    <link rel="icon" href="{{asset('admin/img/mainadmin.png')}}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/plugins/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/admin/main')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>B</b>B</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Blood</b>Bank</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('admin/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since &nbsp;{{ Auth::user()->created_at->format('F j, Y') }} </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        <button class="btn btn-default btn-flat">Sign out</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder-o"></i> <span>Generals</span>
                        <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @hasanyrole('AdminRole1|governorates')
                        <li><a href="{{route('governorates.index')}}"><i class="fa fa-circle-o"></i> Governorates</a></li>
                        @endrole

                        @hasanyrole('AdminRole1|categories')
                        <li><a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i> Categories</a></li>
                        @endrole

                        @hasanyrole('AdminRole1|cities')
                        <li><a href="{{route('cities.index')}}"><i class="fa fa-circle-o"></i> Cities</a></li>
                        @endrole
                    </ul>
                </li>

                @hasanyrole('AdminRole1|posts')
                <li>
                    <a href="{{route('posts.index')}}">
                        <i class="fa fa-file-text"></i> <span>Posts</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                @endrole

                <li>
                    <a href="{{route('clients.index')}}">
                        <i class="fa fa-user"></i> <span>Clients</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('donations.index')}}">
                        <i class="fa fa-tint"></i> <span>Donations</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('contacts.index')}}">
                        <i class="fa fa-address-book-o"></i> <span>Contacts</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>

                @hasrole('AdminRole1')
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="fa fa-user-circle"></i> <span>Users</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                @endrole

                <!-- same as above one -->
                @role('AdminRole1')
                <li>
                    <a href="{{route('roles.index')}}">
                        <i class="fa fa-code-fork"></i> <span>Roles</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                @endrole

                <li>
                    <a href="{{route('settings.index')}}">
                        <i class="fa fa-cogs"></i> <span>Settings</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('password.request') }}">
                        <i class="fa fa-key"></i> <span>Change your password</span>
                        <span class="pull-right-container"> </span>
                    </a>
                </li>
                <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                @yield('title')
                <small> @yield('small-title') </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@stack('script')
<!-- jQuery 3 -->
<script src="{{asset('admin/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/js/demo.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
</body>
</html>
