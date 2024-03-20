<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/boleto/demo/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2022 09:13:04 GMT -->
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
    <link rel="stylesheet" href="{{url('public/frontend/css/main.css')}}">

    <link rel="shortcut icon" href="{{url('public/frontend/images/favicon.png')}}" type="image/x-icon">

    <title>{{ env('APP_NAME') }}  - Online Ticket Booking Website HTML Template</title>


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
    
    <!-- ==========Sign-In-Section========== -->
    <section class="account-section bg_img" data-background="{{url('public/frontend/images/account/account-bg.jpg')}}">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <span class="cate">hello</span>
                        <h2 class="title">welcome back</h2>
                    </div>
                    <form class="account-form" method="POST" actio="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email<span>*</span></label>
                            <input type="email" placeholder="Enter Your Email" id="email" name="email" required>
                            @if(!empty($errors->get('email')))
                                <label class="error" for="password">{{ $errors->get('email')[0] }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span>*</span></label>
                            <input type="password" placeholder="Password" id="password" name="password" required>
                            @if(!empty($errors->get('password')))
                            <label class="error" for="password">{{ $errors->get('password')[0] }}</label>
                            @endif
                        </div>
                        <div class="form-group checkgroup">
                            <input type="checkbox" id="remember_me" required checked>
                            <label for="remember_me">remember password</label>
                            <a  href="{{ route('password.request') }}" class="forget-pass">Forget Password</a>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="log in">
                        </div>
                    </form>
                    <div class="option">
                        Don't have an account? <a href="{{route('register')}}">sign up now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Sign-In-Section========== -->


    <script src="{{url('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('public/frontend/js/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{url('public/frontend/js/plugins.js')}}"></script>
    <script src="{{url('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/frontend/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{url('public/frontend/js/magnific-popup.min.js')}}"></script>
    <script src="{{url('public/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('public/frontend/js/wow.min.js')}}"></script>
    <script src="{{url('public/frontend/js/countdown.min.js')}}"></script>
    <script src="{{url('public/frontend/js/odometer.min.js')}}"></script>
    <script src="{{url('public/frontend/js/viewport.jquery.js')}}"></script>
    <script src="{{url('public/frontend/js/nice-select.js')}}"></script>
    <script src="{{url('public/frontend/js/main.js')}}"></script>
</body>