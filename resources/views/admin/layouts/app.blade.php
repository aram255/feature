<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/backend/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/backend/vendor/bootstrap-toastr/toastr.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/backend/css/custom.css" rel="stylesheet">
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>

    @stack('css')
    <style>
        .counter{
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 73px;
            color: #0f6674;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if(isset($menu) && $menu == 'dashboard') active @endif">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Users
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item @if(isset($menu) && $menu == 'practitioners') active @endif">
                <a class="nav-link d-flex align-center" href="{{ route('adminPractitioners') }}">
                    <i class="fas fa-user-md"></i>
                    <span>Practitioners</span><div class="counter">{{$ShowPractitionersNewCount}}</div></a>
            </li>

            <li class="nav-item @if(isset($menu) && $menu == 'clients') active @endif">
                <a class="nav-link" href="{{ route('adminClients') }}">
                    <i class="fas fa-user-md"></i>
                    <span>Clients</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Content
            </div>
            <?php $contentMenuItems = array('practices','specialities','blog'); ?>
            <li class="nav-item @if(isset($menu) && in_array($menu,$contentMenuItems)) active @endif">
                <a class="nav-link @if(isset($menu) && !in_array($menu,$contentMenuItems)) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Content</span>
                </a>
                <div id="collapseTwo" class="collapse @if(isset($menu) && in_array($menu,$contentMenuItems)) active show @endif"" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a  class="collapse-item @if(isset($menu) && ($menu == 'blog')) active @endif" href="{{ route('adminBlog') }}">Blog</a>
                        <a  class="collapse-item @if(isset($menu) && ($menu == 'practices')) active @endif" href="{{ route('adminPractices') }}">Practices</a>
                        <a  class="collapse-item @if(isset($menu) && ($menu == 'specialities')) active @endif" href="{{ route('adminSpecialities') }}">Specialities</a>
                        <a  class="collapse-item @if(isset($menu) && ($menu == 'practices-teg-management')) active @endif" href="{{ route('adminPracticesTegManagement') }}">Add Tag</a>
                        <a  class="collapse-item @if(isset($menu) && ($menu == 'admincategory')) active @endif" href="{{ route('adminCategory') }}">Add Category</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="/backend/img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id='admin_name_lbl'>{{auth()->guard('admin')->user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="/backend/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <a class="dropdown-item" href="{{ route('adminProfile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('adminLogout') }}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('adminLogout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/backend/vendor/jquery/jquery.min.js"></script>
    <script src="/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/backend/js/sb-admin-2.min.js"></script>
    <script src="/backend/vendor/bootstrap-toastr/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script src="/backend/vendor/popup.js"></script>
    <script src="/backend/vendor/simpleUpload.min.js"></script>
    <script src="/backend/js/script.js"></script>

    @stack('script')
    <!-- Page level plugins -->
    <!-- <script src="/backend/vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="/backend/js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="/backend/js/demo/chart-pie-demo.js"></script> -->

</body>
<!-- Modal -->

<div id="modal-container"></div>

</html>
