<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop | eCommerce</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/frontend/assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/progressbar_barfiller.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/lightslider.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/price_rangs.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/assets/css/style.css') }}">
    <style>
        .social a img {
            width: 50px;
        }

        .social .sociallg img:hover {
            width: 60px;
            transition-delay: 0.1s;
            transition-duration: 0.8s;
        }
    </style>
</head>


<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start-->

    <main class="login-bg">
        <!-- login Area Start -->
        <div class="login-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <form action="{{ URL::to('/login-customer') }}" method="POST">
                            @csrf
                            <div class="login-form">
                                <!-- Login Heading -->
                                <div class="login-heading">
                                    <span>Login</span>
                                    <p>Enter Login details to get access</p>
                                    @php
                                    $message = Session::get('message');
                                    @endphp
                                    @if ($message)
                                    <p class="text-danger">{{ $message }}</p>
                                    @php
                                    Session::put('message', null);
                                    @endphp
                                    @endif
                                </div>
                                <!-- Single Input Fields -->
                                <div class="input-box">
                                    <div class="single-input-fields">
                                        <label>Email Address</label>
                                        <input type="Email" placeholder="Email address" required name="email_account">
                                    </div>
                                    <div class="single-input-fields">
                                        <label>Password</label>
                                        <input type="password" placeholder="Enter Password" required name="password_account">
                                    </div>
                                    <div class="single-input-fields login-check">
                                        <input type="checkbox" id="fruit1" name="keep-log">
                                        <label for="fruit1">Keep me logged in</label>
                                        <a href="#" class="f-right">Forgot Password?</a>
                                    </div>
                                    <div class="single-input-fields social">
                                        <a class="sociallg" href="{{URL::to('/login-facebook')}}"> <img src="{{asset('public/frontend/assets/img/logo/logofacebook.png')}}" alt=""></a>
                                        <a class="sociallg" href="{{URL::to('/login-google')}}"> <img src="{{asset('public/frontend/assets/img/logo/logogoogle.png')}}" alt=""></a>
                                    </div>
                                </div>
                                <!-- form Footer -->
                                <div class="login-footer">
                                    <p>Don’t have an account? <a href="{{ URL::to('/register-checkout') }}">Sign Up</a> here</p>
                                    <button type="submit" class="submit-btn3">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login Area End -->
    </main>

    <!-- JS here -->
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ URL::asset('public/frontend/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/bootstrap.min.js') }}"></script>

    <!-- Slick-slider , Owl-Carousel ,slick-nav -->
    <script src="{{ URL::asset('public/frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/slick.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- One Page, Animated-HeadLin, Date Picker , price, light-slider -->
    <script src="{{ URL::asset('public/frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/animated.headline.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/gijgo.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/lightslider.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/price_rangs.js') }}"></script>

    <!-- Nice-select, sticky,Progress -->
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.barfiller.js') }}"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ URL::asset('public/frontend/assets/js/contact.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.form.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/mail-script.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ URL::asset('public/frontend/assets/js/plugins.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/assets/js/main.js') }}"></script>


</body>

</html>