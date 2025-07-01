<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{ asset('dist/img/AdminLTELogo.png') }}" type="image/x-icon" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Sidebar toggle button -->
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8" />
                <span class="brand-text font-weight-light">Quản Lý Hệ Thống</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">TRANG CHỦ</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Trang Chủ</p>
                            </a>
                        </li>

                        <li class="nav-header">QUẢN LÝ THÔNG TIN</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.index') }}"
                                class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Môn Học</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.lecturers.index') }}"
                                class="nav-link {{ request()->routeIs('admin.lecturers.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>Giảng Viên</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.documents.index') }}"
                                class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Tài Liệu</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.theses.index') }}"
                                class="nav-link {{ request()->routeIs('admin.theses.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-scroll"></i>
                                <p>Luận Văn</p>
                            </a>
                        </li>

                        <li class="nav-header">QUẢN LÝ TUYỂN SINH</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.announcements.index') }}"
                                class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>Thông Báo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.registers.index') }}"
                                class="nav-link {{ request()->routeIs('admin.registers.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-plus"></i>
                                <p>Yêu Cầu</p>
                            </a>
                        </li>

                        <li class="nav-header">HỆ THỐNG</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.index') }}"
                                class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-file"></i>
                                <p>Trang Thông Tin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Đổi Thông Tin</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.logout') }}"
                                class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Đăng Xuất</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>&copy; 2025 - 2026 - Hệ thống quản lý</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>

</html>
