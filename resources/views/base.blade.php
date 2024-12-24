<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>@yield('title', 'GstBiller Software')</title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extra-libs/calendar/calendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-white">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <h4 class="text-white">GST Biller Admin</h4>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5"
                    style="background-color: white!important;">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.add') }}">Admin Or Vendor</a>
                                <a class="dropdown-item" href="{{ route('admin.bills.add') }}">Bill</a>
                                <a class="dropdown-item" href="{{ route('admin.logs') }}">See Logs</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="{{ asset('storage/' . Auth::user()->image) }}" alt="No Image"
                                    class="rounded-circle" width="45"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                        class="ti-user m-r-5 m-l-5"></i>
                                    My Profile</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"
                                        style="border: none; background: none;">
                                        <i class="fa fa-power-off m-r-5 m-l-5 text-danger"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <style>
                    .sidebar-item.active a {
                        background-color: #007bff;
                        /* Change to your desired active background color */
                        color: white;
                    }
                </style>

                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-10">
                        <li class="sidebar-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('admin/index') ? 'active' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.index') }}" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Admins &
                                    Vendors</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('admin/bills*') ? 'active' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.bills.index') }}" aria-expanded="false">
                                <i class="mdi mdi-border-inside"></i><span class="hide-menu">Bills</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('admin/logs*') ? 'active' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.logs') }}" aria-expanded="false">
                                <i class="mdi mdi-file-chart"></i><span class="hide-menu">Logs</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::is('admin/profile') ? 'active' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.profile') }}" aria-expanded="false">
                                <i class="mdi mdi-account-circle"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                    </ul>
                </nav>


                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>

            <footer class="footer text-center">
                All Rights Reserved by Abdul Waheed. Designed and Developed by <a
                    href="https://abdulwaheed78.github.io/"> Abdul Waheed </a>.
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.ui.touch-punch-improved.js') }}"></script>
    <script src="{{ asset('dist/js/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!-- Wave Effects -->
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <!-- Menu sidebar -->
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!-- This page JS -->
    <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/calendar/cal-init.js') }}"></script>

    {{-- data tables --}}
    <script src="{{ asset('assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable({
            "order": [
                [0, "desc"]
            ] // This will order the records by the first column (ID) in descending order
        });
    </script>
</body>

</html>
