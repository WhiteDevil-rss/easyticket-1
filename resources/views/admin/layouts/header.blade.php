<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP_NAME')}} Admin | @yield('title') </title>

  <!-- jQuery -->
  <script src="{{url('public/admin/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public/admin/css/adminlte.min.css')}}">

  <link rel="stylesheet" href="{{url('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  {{-- Toast notification message --}}
  <link rel="stylesheet" href="{{url('public/admin/plugins/toastr/toastr.min.css')}}">
  <script src="{{url('public/admin/js/toastr.min.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{url('public/admin/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.home')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="user-panel d-flex">
            <div class="image">
              <img src="{{url('public/admin/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
          </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('public/frontend/images/logo/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{env('APP_NAME')}} Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.home')}}" class="nav-link {{Route::currentRouteName() == 'admin.home' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.users')}}" class="nav-link {{Route::currentRouteName() == 'admin.users' || Route::currentRouteName() == 'admin.users.add' || Route::currentRouteName() == 'admin.users.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.city')}}" class="nav-link {{Route::currentRouteName() == 'admin.city' || Route::currentRouteName() == 'admin.city.add' || Route::currentRouteName() == 'admin.city.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                City
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.theatres')}}" class="nav-link {{Route::currentRouteName() == 'admin.theatres' || Route::currentRouteName() == 'admin.theatres.add' || Route::currentRouteName() == 'admin.theatres.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-theater-masks"></i>
              <p>
                Theatres
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.movies')}}" class="nav-link {{Route::currentRouteName() == 'admin.movies' || Route::currentRouteName() == 'admin.movies.add' || Route::currentRouteName() == 'admin.movies.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Movies
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.screens')}}" class="nav-link {{Route::currentRouteName() == 'admin.screens' || Route::currentRouteName() == 'admin.screen.add' || Route::currentRouteName() == 'admin.screen.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Screens
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.showtimes')}}" class="nav-link {{Route::currentRouteName() == 'admin.showtimes' || Route::currentRouteName() == 'admin.showtimes.add' || Route::currentRouteName() == 'admin.showtime.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Showtimes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.bookings')}}" class="nav-link {{Route::currentRouteName() == 'admin.bookings' || Route::currentRouteName() == 'admin.bookings.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Bookings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>