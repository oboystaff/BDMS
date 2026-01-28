<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Book Distribution Management System">
    <meta property="og:title" content="Book Distribution Management System">
    <meta property="og:description" content="Book Distribution Management System">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Book Distribution Management System</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet">

    <!-- tagify-css -->
    <link href="{{ asset('assets/vendor/tagify/dist/tagify.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('page-styles')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div>
            {{-- <img src="{{ asset('assets/images/pre.gif') }}" alt=""> --}}
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="background: white;">
            <a href="javascript:void(0);" class="brand-logo">
                <span style="color: blue;margin-left:40px">
                    {{-- <i class="fa-solid fa-trash-can" style="margin-right: 5px"></i>Zoil W.Ms System --}}
                    <img src="{{ asset('assets/images/appointed_logo.jpeg') }}" class="h-100" alt="Appointed"
                        style="width:80px;height:80px">
                </span>
            </a>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************

        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>
                        <div class="header-right d-flex align-items-center">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
                                        <svg id="icon-light" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                                <path
                                                    d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <svg id="icon-dark" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </a>
                                </li>

                                <li class="nav-item ps-3">
                                    <div class="dropdown header-profile2">
                                        <a class="nav-link" href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="header-info2 d-flex align-items-center">
                                                <div class="header-media">
                                                    <img src="{{ asset('assets/images/users.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <div class="card border-0 mb-0">
                                                <div class="card-header py-2">
                                                    <div class="products">
                                                        <img src="{{ asset('assets/images/users.jpg') }}"
                                                            class="avatar avatar-md" alt="">
                                                        <div>
                                                            <h6>{{ request()->user()->name }}</h6>
                                                            <span>Application User</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer px-0 py-2">

                                                    <a href="javascript:void(0);" class="dropdown-item ai-icon"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 24 24" fill="none"
                                                            stroke="var(--primary)" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                            <polyline points="16 17 21 12 16 7"></polyline>
                                                            <line x1="21" y1="12" x2="9"
                                                                y2="12"></line>
                                                        </svg>
                                                        <span class="ms-2">Logout </span>
                                                    </a>

                                                    <form id="logout-form" action="{{ route('auth.logout') }}"
                                                        method="GET" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    {{-- <li class="menu-title">YOUR COMPANY</li> --}}
                    {{-- @canany(['dashboards.operational']) --}}
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                            <div class="menu-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
                                        fill="#90959F" />
                                </svg>
                            </div>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- @can('dashboards.operational') --}}
                            <li><a href="{{ route('dashboard.operational') }}">Operational</a></li>
                            {{-- @endcan --}}

                            {{-- @can('dashboards.operational') --}}
                            <li><a href="{{ route('dashboard.financial') }}">Financial</a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcanany --}}

                    {{-- @canany(['companies.view', 'sites.view', 'customers.view']) --}}
                    <li><a href="javascript:void(0);" class="has-arrow " aria-expanded="false">
                            <div class="menu-icon">
                                <i class="fs-20 fa-solid fa-boxes-stacked"></i>
                            </div>
                            <span class="nav-text mx-2">Stock</span>
                        </a>
                        <ul aria-expanded="false">

                            {{-- @can('companies.view')
                                    <li><a href="{{ route('companies.index') }}">Companies</a></li>
                                @endcan --}}

                            {{-- @can('sites.view') --}}
                            <li><a href="{{ route('new-stocks.index') }}">New Stock</a></li>
                            {{-- @endcan --}}

                            {{-- @can('customers.view') --}}
                            <li><a href="{{ route('inventories.index') }}">Inventory</a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcanany --}}

                    {{-- @canany(['drivers.view', 'vehicles.view', 'transporters.view']) --}}
                    <li><a href="javascript:void(0);" class="has-arrow " aria-expanded="false">
                            <div class="menu-icon">
                                <i class="fs-20 mx-2 fa-solid fa-users"> </i>
                            </div>
                            <span class="nav-text">Personnel</span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- @can('drivers.view') --}}
                            <li><a href="{{ route('schools.index') }}">Schools</a></li>
                            {{-- @endcan --}}

                            {{-- @can('vehicles.view') --}}
                            <li><a href="{{ route('bookshops.index') }}">Bookshops</a></li>
                            {{-- @endcan --}}

                            @can('transporters.view')
                                <li><a href="{{ route('transporters.index') }}">Transporters</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- @endcanany --}}

                    {{-- @canany(['waste-types.view', 'hazard-classes.view', 'handling-dispositions.view', 'location-types.view', 'schedules.view', 'pickups.view']) --}}
                    <li><a href="javascript:void(0);" class="has-arrow " aria-expanded="false">
                            <div class="menu-icon">
                                <i class="fs-20 mx-2 fa-solid fa-envelope-open-text"></i>
                            </div>
                            <span class="nav-text"> Request </span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- @can('waste-types.view') --}}
                            <li><a href="{{ route('requisitions.index') }}">Requisitions</a></li>
                            {{-- @endcan --}}

                            {{-- @can('hazard-classes.view') --}}
                            <li><a href="{{ route('book-returns.index') }}">Returns</a></li>
                            {{-- @endcan --}}

                            @can('handling-dispositions.view')
                                <li><a href="{{ route('handling-dispositions.index') }}">Handling Dispositions</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    {{-- @endcanany --}}


                    @canany(['reports.view'])
                        <li><a href="javascript:void(0);" class="has-arrow " aria-expanded="false">
                                <div class="menu-icon">
                                    <i class="fs-20 mx-2 fa-solid fa-file-invoice"></i>
                                </div>
                                <span class="nav-text">Reports</span>
                            </a>
                            <ul aria-expanded="false">
                                @can('reports.view')
                                    <li><a href="{{ route('customer-reports.index') }}">Customer Report</a></li>
                                    <li><a href="{{ route('vehicle-reports.index') }}">Vehicle Report</a></li>
                                    <li><a href="{{ route('driver-reports.index') }}">Driver Report</a></li>
                                    <li><a href="{{ route('transporter-reports.index') }}">Transporter Report</a></li>
                                    <li><a href="{{ route('schedule-reports.index') }}">Schedule Report</a></li>
                                    <li><a href="{{ route('pickup-reports.index') }}">Pickup Report</a></li>
                                    <li><a href="{{ route('waste-management-reports.index') }}">Waste Management</a></li>
                                    <li><a href="{{ route('waste-tracking-reports.index') }}">Waste Tracking Log</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- @canany(['users.view', 'roles.view', 'permissions.view']) --}}
                    <li><a href="javascript:void(0);" class="has-arrow " aria-expanded="false">
                            <div class="menu-icon">
                                <i class="fs-20 mx-2 fa-solid fa-gears"></i>
                            </div>
                            <span class="nav-text">Settings</span>
                        </a>
                        <ul aria-expanded="false">
                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('users.index') }}"> Users</a></li>
                            {{-- @endcan --}}

                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('zonal-sales-officers.index') }}"> Zonal Sales Officers</a></li>
                            {{-- @endcan --}}

                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('zones.index') }}"> Zones</a></li>
                            {{-- @endcan --}}

                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('territories.index') }}"> Territories</a></li>
                            {{-- @endcan --}}

                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('subjects.index') }}"> Subjects</a></li>
                            {{-- @endcan --}}

                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('levels.index') }}"> Levels</a></li>
                            {{-- @endcan --}}

                            {{-- @can('users.view') --}}
                            <li><a href="{{ route('books.index') }}"> Books</a></li>
                            {{-- @endcan --}}

                            @can('roles.view')
                                <li><a href="{{ route('roles.index') }}"> Roles</a></li>
                            @endcan

                            @can('permissions.view')
                                <li><a href="{{ route('permissions.index') }}"> Permissions</a></li>
                            @endcan
                        </ul>
                    </li>
                    {{-- @endcanany --}}
                </ul>
            </div>
        </div>

        <!--**********************************
                            Content body start
                        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                @yield('page-content')

            </div>
        </div>
        <!--**********************************
                            Content body end
                        ***********************************-->


        <!--**********************************
                            Footer start
                        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Developed by <a href="#" target="_blank">Cyber Solutions Limited</a>
                    <?php echo date('Y'); ?>
                </p>
            </div>
        </div>
        <!--**********************************
                            Footer end
                        ***********************************-->

        <!--**********************************
                           Support ticket button start
                        ***********************************-->

        <!--**********************************
                           Support ticket button end
                        ***********************************-->


    </div>
    <!--**********************************
                        Main wrapper end
                    ***********************************-->

    <!--**********************************
                        Scripts
                    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('assets/vendor/draggable/draggable.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>


    <!-- tagify -->
    <script src="{{ asset('assets/vendor/tagify/dist/tagify.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>

    <!-- Apex Chart -->

    <script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
