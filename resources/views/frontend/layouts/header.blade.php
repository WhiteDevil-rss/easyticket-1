<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/boleto/demo/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2022 09:11:12 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{url('public/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/odometer.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/jquery.animatedheadline.css')}}">
    <link rel="stylesheet" href="{{url('public/frontend/css/main.css')}}">
    <script src="{{url('public/frontend/js/jquery-3.3.1.min.js')}}"></script>

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

    <title>@yield('title') {{ env('APP_NAME') }} | Book Movie Show Easily!!!</title>


</head>

<body>
    <!-- ==========Preloader========== -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ==========Preloader========== -->
    <!-- ==========Overlay========== -->
    <div class="overlay"></div>
    <a href="#0" class="scrollToTop">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- ==========Overlay========== -->

    <!-- ==========Header-Section========== -->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{url('public/frontend/images/logo/logo.png')}}" alt="logo">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="{{route('home')}}" class="{{ Request::path() == "/" ? "active": "" }}">Home</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('movie')}}" class="{{ Request::path() == "movie" ? "active": "" }}">movies</a>
                    </li> --}}
                    {{-- add label for authenticated user --}}
                    @if(Auth::user())
                    <li class="profile-button-hover">
                        <a href="#0" class="profile-button pr-3 pl-3"><i class="fa fa-user mr-2"> </i>Hi, {{Auth::user()->name}}..</a>
                        <ul class="submenu">
                            <li>
                                <a href="#">Profile</a>
                            </li>
                            <li>
                                <a href="{{route('movie.tickets')}}">Tickets</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}">Logout</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(!Auth::check())
                    <li class="header-button pr-0">
                            <a href="{{route('login')}}">Login</a>
                        </li>
                    @endif
                </ul>
                <div class="header-bar d-lg-none">
					<span></span>
					<span></span>
					<span></span>
				</div>
            </div>
        </div>
    </header>
    <!-- ==========Header-Section========== -->