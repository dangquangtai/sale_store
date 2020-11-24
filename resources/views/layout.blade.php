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
   label.error{
       color: red;
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
                    <img src="{{ URL::asset('public/frontend/assets/img/logo/loder.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start-->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row menu-wrapper align-items-center justify-content-between">
                        <div class="header-left d-flex align-items-center">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="{{ URL::to('/trang-chu') }}"><img src="{{ URL::asset('public/frontend/assets/img/logo/logo.png') }}" alt=""></a>
                            </div>
                            <!-- Logo-2 -->
                            <div class="logo2">
                                <a href="{{ URL::to('/trang-chu') }}"><img src="{{ URL::asset('public/frontend/assets/img/logo/logo2.png') }}" alt=""></a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
                                        <li><a href="{{ URL::to('/san-pham') }}">Product</a></li>
                                        <li><a href="{{URL::to('/trang-chi-tiet')}}">About</a></li>
                                        <li><a href="#">Page</a>
                                            <ul class="submenu">
                                                @php
                                                $account = Session::get('customer_name');
                                                @endphp
                                                @if ($account)
                                                <li><a href="{{ URL::to('/logout-checkout') }}">Logout</a></li>
                                                @else
                                                <li><a href="{{ URL::to('/login-checkout') }}">Login</a></li>
                                                @endif

                                                <li><a href="{{ URL::to('/show-cart') }}">Card</a></li>
                                                <!-- <li><a href="categories.html">Categories</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="product_details.html">Product Details</a></li> -->
                                            </ul>
                                        </li>
                                        <!-- <li><a href="blog.html">Blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog_details.html">Blog Details</a></li>
                                                <li><a href="elements.html">Elements</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="{{URL::to('/lien-he')}}">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-right1 d-flex align-items-center">
                            <div class="search">
                                <ul class="d-flex align-items-center">
                                    <li>
                                        <!-- Search Box -->
                                        <form action="{{URL::to('/search-product')}}" class="form-box f-right " method="get">

                                            <input type="text" name="Search" placeholder="Search products" required>
                                            <div class="search-icon">
                                                <button class=" btn " type="submit"> <i class="ti-search"></i></button>
                                            </div>
                                        </form>
                                    </li>
                                    <li>

                                        @if ($account)
                                        <a href="{{URL::to('/get-shipping')}}" class="account-btn name">{{ $account }}</a>
                                        <a href="{{ URL::to('/logout-checkout') }}" class="account-btn">Logout</a>
                                        @else
                                        <a href="{{ URL::to('/login-checkout') }}" class="account-btn">Log in</a>
                                        @endif

                                    </li>
                                    <li>
                                        <div class="card-stor">

                                            <img src="{{ URL::asset('public/frontend/assets/img/icon/card.svg') }}" id="to-cart">


                                            <?php
                                            $count = Cart::content()->count();
                                            if ($account) {
                                                echo '  <span id="product_count"> ' . $count . '</span>';
                                            }
                                            ?>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <!-- header end -->

    @yield('content')

    <footer>
        <div class="footer-wrapper">
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container ">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-3 col-md-8 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo mb-35">
                                        <a href="index.html"><img src="{{URL::to('public/frontend/assets/img/logo/logo2_footer.png')}}" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis
                                                viverra ornare, eros dolor interdum nulla.</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Quick links</h4>
                                    <ul>
                                        <li><a href="#">Image Licensin</a></li>
                                        <li><a href="#">Style Guide</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Shop Category</h4>
                                    <ul>
                                        <li><a href="#">Image Licensin</a></li>
                                        <li><a href="#">Style Guide</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Pertners</h4>
                                    <ul>
                                        <li><a href="#">Image Licensin</a></li>
                                        <li><a href="#">Style Guide</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                        Copyright &copy;<script>
                                            document.write(new Date().getFullYear());
                                        </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </div>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

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
   
    @stack('ajax-add-cart')
    @stack('ajax-edit-cart')
    @stack('ajax-updatepage-cart')
    @stack('ajax-history-product')
    @stack('ajax-place')
    <script>
        //   if ($('#validation').valid()) {
        //                 window.location.href = "{{ URL::to('info-shipping') }}";
        //             }
        $(document).ready(function() {





            // $("#order").click(function() {
            //     $count = $('#count_input').val();
            //     if ($count == 0) {
            //         alert('Có vẻ giỏ hàng bạn đang trống...vui lòng kiểm tra');
            //     }



            // });

            $("#to-cart").click(function() {
                var a = $('.name').text();
                if (a) {
                    window.location.href = "{{asset('/show-cart')}}";
                } else {
                    alert('Vui lòng đăng nhập để thực hiện thao tác này...')
                }




            });
            $("form[name='validate_form']").validate({


                rules: {
                    full_name: {
                        required: true,
                        maxlength: 20
                    },
                    phone: {
                        required: true,
                        number :true,
                        minlength: 10
                       
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    addr: {
                        required: true

                    }

                },
                messages: {
                    full_name: {
                        required: " Không được bỏ trống tên",
                        maxlength: "Hãy nhập tối đa 20 kí tự"
                    },
                    phone: {
                        required: "không được bỏ trống số điện thoại",
                        number: "số điện thoại không bao gồm kí tự",
                        minlength: "số điện thoại tối thiểu 10 số"
                       
                    },
                    email: {
                        required: "không được bỏ trống email",
                        email: "vui lòng nhập đúng định dạng email"
                    },
                    addr: "yêu cầu nhập địa chỉ"

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });





        });
    </script>




</body>

</html>