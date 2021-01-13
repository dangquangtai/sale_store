<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://kit.fontawesome.com/a076d05399.js">
    <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>
    <script src="{{ asset('public/backend/ckeditor/ckeditor.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{ asset('public/backend/js/validation.js') }}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    VISITORS
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="45">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Product Delivery</h5>
                                            <p>45% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="78">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Payment collection</h5>
                                            <p>87% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="60">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>33% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="90">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/3.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/1.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Jane Doe</span>
                                        <span class="time">2 min ago</span>
                                    </span>
                                    <span class="message">
                                        Nice admin template
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/3.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Tasi sam</span>
                                        <span class="time">2 days ago</span>
                                    </span>
                                    <span class="message">
                                        This is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="{{ asset('public/backend/images/2.png') }}"></span>
                                    <span class="subject">
                                        <span class="from">Mr. Perfect</span>
                                        <span class="time">2 hour ago</span>
                                    </span>
                                    <span class="message">
                                        Hi there, its a test
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notifications</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-danger clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #2 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-success clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #3 overloaded.</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('public/backend/images/2.png') }}">
                            <span class="username"><?php
                                                    $name = Session::get('admin_name');
                                                    if ($name) {
                                                        echo $name;
                                                    }
                                                    ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('add-category-product') }}">Thêm danh mục</a></li>
                                <li><a href="{{ URL::to('all-category-product') }}">Liệt kê danh mục</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-barcode"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('add-brand-product') }}">Thêm hiệu sản phẩm</a></li>
                                <li><a href="{{ URL::to('all-brand-product') }}">Liệt kê thương hiệu sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('add-product') }}">Thêm sản phẩm</a></li>
                                <li><a href="{{ URL::to('all-product') }}">Xem sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fab fa-product-hunt"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-order') }}">Quản lí đơn hàng</a></li>
                            </ul>
                        </li>
                        @hasrole(['author','admin'])
                        <li class="sub-menu">
                            <a href="#">
                                <i class="fa fa-users-cog"></i>
                                <span>Người dùng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-user') }}">Quản lí user</a></li>
                            </ul>
                        </li>
                        @endhasrole
                        <li class="sub-menu">
                            <a href="#">
                                <i class="fas fa-images"></i>
                                <span>Thư viện ảnh sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/view-product-image') }}">Xem ảnh sản phẩm</a></li>
                            </ul>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-product-image') }}">Thêm ảnh sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#">
                                <i class="fas fa-newspaper"></i>
                                <span>Bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-cate-post') }}">Thêm danh mục bài viết</a></li>
                            </ul>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/view-cate-post') }}">Xem danh mục bài viết</a></li>
                            </ul>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-post') }}">Thêm bài viết</a></li>
                            </ul>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/view-post') }}">Xem bài viết</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#">
                                <i class="fas fa-images"></i>
                                <span>Quản lý ảnh trang web</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/edit-website-image') }}">Sửa ảnh trang web</a></li>
                            </ul>

                        </li>
                        <li class="sub-menu">
                            <a href="#">
                                <i class="fas fa-comments"></i>
                                <span>Bình luận</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-comment') }}">Quản lý bình luận</a></li>
                            </ul>

                        </li>
                      @hasrole('admin')
                        <li class="sub-menu">
                            <a href="#">
                                <i class="fas fa-comments"></i>
                                <span>Phân quyền</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/phan-quyen') }}">Quản lý quyền</a></li>
                                <li><a href="{{ URL::to('/them-admin') }}">Thêm người quản trị</a></li>
                            </ul>

                        </li>
                      @endhasrole

                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>

    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]>
<script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- morris JavaScript -->

    @stack('ajax-edit_order')
    <script>
        $(document).ready(function() {
            load_filter();
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            // function gd(year, day, month) {
            //     return new Date(year, month - 1, day).getTime();
            // }

            var chart = new Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,

                lineColors: ['#eb6f6f', '#926383', '#31f541', '#565eba'],
                xkey: 'period',
                redraw: true,
                ykeys: ['order', 'sales',  'quantity'],
                labels: ['Đơn hàng', 'Doanh số',  'Số lượng'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });

            function load_filter() {

                var _token = $("input[name='_token']").val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/load-filter')}}",
                    data: {


                        _token: _token


                    },
                    dataType: "json",
                    success: function(data) {

                        chart.setData(data);
                        console.log(data);

                    }
                });
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/load-info-30day')}}",
                    data: {


                        _token: _token


                    },
                    dataType: "json",
                    success: function(data) {
                        var order = data.order;
                        var sales =addCommas(data.sales); 
                        var order_today = data.order_today;
                        var sales_today =addCommas(data.sales_today); 
                        
                        $('#get_sales').text(sales + " " + "VNĐ");
                        $('#get_order').text(order + " " + "Đơn");
                        $('#get_sales_today').text(sales_today + " " + "VNĐ");
                        $('#get_order_today').text(order_today + " " + "Đơn");

                    }
                });
            }
            $(document).on('click', '#btn-dasboard-filter', function() {
                var date_from = $('#datepicker').val();
                var date_to = $('#datepicker2').val();
                var _token = $("input[name='_token']").val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/filter-by-day')}}",
                    data: {
                        date_from: date_from,
                        date_to: date_to,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        // Swal.fire({
                        //     position: 'center',
                        //     icon: 'success',
                        //     title: 'Thêm vào giỏ hàng thành công',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // })

                        console.log(data);
                        chart.setData(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/get-info-by-day')}}",
                    data: {
                        date_from: date_from,
                        date_to: date_to,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        var order = data.order;
                        var sales =addCommas(data.sales); ;
                        
                        $('#get_sales').text(sales + " " + "VNĐ");
                        $('#get_order').text(order + " " + "Đơn");
                    }
                });
                return false;
            });

            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            $(document).on('change', '.dasboard-filter', function() {
                var select_fil = $('.dasboard-filter').val();
                var _token = $("input[name='_token']").val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/dasboard-filter')}}",
                    data: {
                        select_fil: select_fil,

                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        // Swal.fire({
                        //     position: 'center',
                        //     icon: 'success',
                        //     title: 'Thêm vào giỏ hàng thành công',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // })

                        console.log(data);
                        chart.setData(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/get-info-dasboard-filter')}}",
                    data: {
                        select_fil: select_fil,

                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        var order = data.order;
                        var sales =addCommas(data.sales); ;
                        
                        $('#get_sales').text(sales + " " + "VNĐ");
                        $('#get_order').text(order + " " + "Đơn");
                    }
                });
                return false;
            });


        });
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
            $("#datepicker2").datepicker({
                dateFormat: "yy-mm-dd"
            });


        });
    </script>

    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('public/backend/js/monthly.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        CKEDITOR.replace('editor5');
    </script>
    <!-- //calendar -->
</body>

</html>