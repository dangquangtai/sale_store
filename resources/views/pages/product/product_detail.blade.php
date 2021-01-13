@extends('layout')
@section('content')
<style>
    .stars input {
        position: absolute;
        left: -999999px;
    }

    .stars a {
        display: inline-block;
        padding-right: 4px;
        text-decoration: none;
        margin: 0;
    }

    .stars a:after {
        position: relative;
        font-size: 18px;
        font-family: 'FontAwesome', serif;
        display: block;
        content: "\f005";
        color: #84805e;
    }


    /* span {
        font-size: 0;
        
    } */

    .stars a:hover~a:after {
        color: #9e9e9e !important;
    }

    span.active a.active~a:after {
        color: #9e9e9e;
    }

    span:hover a:after {
        color: #dfeb2a !important;
    }

    span.active a:after,
    .stars a.active:after {
        color: #dfeb2a;
    }
</style>
<main>
    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="slider-active">
            <div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-8">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="fadeInUp" data-delay=".4s">Product details</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Product details</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--? Single Product Area Start-->
    <?php

    use Illuminate\Support\Facades\Session;

    $user_id = Session::get('customer_id');
    ?>
    <input type="hidden" id="user_id" value="<?php echo $user_id ?>">
    @foreach ($detail_product as $item)


    <div class="product_image_area section-padding40">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-5">
                    <div class="product_slider_img">
                        <div id="vertical">
                            @foreach($get_product_img as $itemm)
                            <div data-thumb="{{ URL::asset('public/uploads/product/'.$itemm->product_image) }}">
                                <img src="{{ URL::asset('public/uploads/product/'.$itemm->product_image) }}" class="w-100">
                            </div>
                            @endforeach
                            <!-- <div data-thumb="{{ URL::asset('public/frontend/assets/img/gallery/product-details2.png') }}">
                                <img src="{{ URL::asset('public/frontend/assets/img/gallery/product-details2.png') }}" class="w-100">
                            </div>
                            <div data-thumb="{{ URL::asset('public/frontend/assets/img/gallery/product-details3.png') }}">
                                <img src="{{ URL::asset('public/frontend/assets/img/gallery/product-details3.png') }}" class="w-100">
                            </div>
                            <div data-thumb="{{ URL::asset('public/frontend/assets/img/gallery/product-details4.png') }}">
                                <img src="{{ URL::asset('public/frontend/assets/img/gallery/product-details4.png') }}" class="w-100">
                            </div>
                            <div data-thumb="{{ URL::asset('public/frontend/assets/img/gallery/product-details4.png') }}">
                                <img src="{{ URL::asset('public/frontend/assets/img/gallery/product-details4.png') }}" class="w-100">
                            </div>
                            <div data-thumb="{{ URL::asset('public/frontend/assets/img/gallery/product-details4.png') }}">
                                <img src="{{ URL::asset('public/frontend/assets/img/gallery/product-details4.png') }}" class="w-100">
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <input class="product_id" type="hidden" value="{{ $item->product_id }}">
                    <div class="s_product_text">
                        <h3>{{ $item->product_name }}</h3>
                        <h2>{{ number_format($item->product_price)}} VNĐ</h2>
                        <ul class="list">
                            <li>

                                <a class="active" href="{{ URL::to('/danh-muc-san-pham/'.$item->category_id) }}">
                                    Category : {{ $item->category_name }}</a>
                            </li>
                            <li>
                                <a href="" class="disable">Brand : {{ $item->brand_name }}</a>

                            </li>
                            <li>
                                <a href="#" class="disable"> Availibility : <?php
                                                                            if ($item->number_product == 0) {
                                                                                echo 'Hết sản phẩm';
                                                                            } else echo $item->number_product;
                                                                            ?></a>
                            </li>
                        </ul>
                        <p>
                            {!! $item->product_desc !!}
                        </p>
                        <input type="number" id="number_prd" value="{{$item->number_product}}" hidden>
                        <div class="card_area">
                            <div class="product_count d-inline-block">
                                <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                <input class="input-number" type="text" value="1" min="1" max="{{$item->number_product}}" readonly>
                                <span class="number-increment"> <i class="ti-plus"></i></span>
                            </div>
                            <div class="add_to_cart">
                                <form action="">
                                    @csrf
                                </form>
                                <a href="#" class="btn add-to-cart" data-productid="{{ $item->product_id }}">add to
                                    cart</a>
                                <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
                            </div>
                            <div class="social_icon">
                                <a href="#" class="fb"><i class="ti-facebook"></i></a>
                                <a href="#" class="tw"><i class="ti-twitter-alt"></i></a>
                                <a href="#" class="li"><i class="ti-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product Area End-->
    <!--? Product Description Area Start-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    {!! $item->product_content !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Width</h5>
                                    </td>
                                    <td>
                                        <h5>128mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Height</h5>
                                    </td>
                                    <td>
                                        <h5>508mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Depth</h5>
                                    </td>
                                    <td>
                                        <h5>85mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Weight</h5>
                                    </td>
                                    <td>
                                        <h5>52gm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Quality checking</h5>
                                    </td>
                                    <td>
                                        <h5>yes</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Freshness Duration</h5>
                                    </td>
                                    <td>
                                        <h5>03days</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>When packeting</h5>
                                    </td>
                                    <td>
                                        <h5>Without touch of hand</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Each Box contains</h5>
                                    </td>
                                    <td>
                                        <h5>60pcs</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="comment_list">
                                <div id="show_coment"></div>

                                <!-- <div class="review_item reply">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="assets/img/gallery/review-2.png" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2017 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna
                                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                        ullamco laboris nisi ut aliquip ex ea commodo
                                    </p>
                                </div> -->
                                <!-- <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="assets/img/gallery/review-3.png" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <h5>12th Feb, 2017 at 05:56 pm</h5>
                                            <a class="reply_btn" href="#">Reply</a>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna
                                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                        ullamco laboris nisi ut aliquip ex ea commodo
                                    </p>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4 id="tittle_coment">Post a comment</h4>
                                <form class="row contact_form" action="" method="post" id="contactForm" novalidate="novalidate">

                                </form>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Phone Number" />
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button name="replycmt" value="0" data-customer_id="0" class="btn" id="reply_coment" style="display: none;">
                                        Reply Now
                                    </button>
                                    <button value="0" class="btn " id="send_coment">
                                        Submit Now
                                    </button>
                                    <!-- <a href="{{URL::to('/load-coment')}}" class="btn">test</a> -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>4.0</h4>
                                        <h6>(03 Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on 3 Reviews</h3>
                                        <ul class="list">
                                            <li>
                                                <a href="#">5 Star
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 01</a>
                                            </li>
                                            <li>
                                                <a href="#">4 Star
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 01</a>
                                            </li>
                                            <li>
                                                <a href="#">3 Star
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 01</a>
                                            </li>
                                            <li>
                                                <a href="#">2 Star
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 01</a>
                                            </li>
                                            <li>
                                                <a href="#">1 Star
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 01</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                <!-- <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="assets/img/gallery/review-1.png" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <h4>Blake Ruiz</h4>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna
                                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                        ullamco laboris nisi ut aliquip ex ea commodo
                                    </p>
                                </div> -->


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <p>Your Rating:</p>

                                <p class="stars">
                                    <span>
                                        <a class="star star-1 " value="1" href="#">1</a>
                                        <a class="star star-2 " value="2" href="#">2</a>
                                        <a class="star star-3 " value="3" href="#">3</a>
                                        <a class="star star-4 " value="4" href="#">4</a>
                                        <a class="star star-5 " value="5" href="#">5</a>
                                    </span>
                                </p>
                                <p>Outstanding</p>
                                <form class="row contact_form" action="" novalidate="novalidate">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="review_rating" rows="1" placeholder="Review"></textarea>
                                        </div>
                                    </div>
                                    <input type="text" name="rating" id="rating" value="0" hidden>
                                    <div class="col-md-12 text-right">
                                        <a type="submit" data-ordered="<?php echo $ordered ?>"class="btn rating_btn" data-rating_star="0">Submit now</a>
                                        <!-- <button type="submit" value="<?php echo $ordered ?>" class="btn rating_btn" data-rating_star="0">
                                            Submit Now
                                        </button> -->

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- Product Description Area End-->
    <!--? Services Area Start -->
    <div class="categories-area section-padding40 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="cat-icon">
                            <img src="assets/img/icon/services1.svg" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Fast & Free Delivery</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="cat-icon">
                            <img src="assets/img/icon/services2.svg" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Secure Payment</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="cat-icon">
                            <img src="assets/img/icon/services3.svg" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Money Back Guarantee</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                        <div class="cat-icon">
                            <img src="assets/img/icon/services4.svg" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Online Support</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--? Services Area End -->
</main>
@push('ajax-add-cart')
<script>
    $(document).ready(function() {
        load_coment();
        load_rating();

        function load_coment() {
            var prd_id = $('.product_id').val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                cache: false,
                url: "{{url('/load-coment')}}",
                data: {
                    product_id: prd_id,

                    _token: _token


                },
                dataType: "html",
                success: function(data) {

                    $('#show_coment').html(data);
                    console.log(data);

                }
            });
        }




        $('#send_coment').click(function() {
            var user_id = $('#user_id').val();
            if (user_id) {

                var coment = $('#message').val();
                var prd_id = $('.product_id').val();
                var _token = $("input[name='_token']").val();
                if (coment == '') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nội dung bình luận trống !',
                        footer: '<a href>Why do I have this issue?</a>'
                    })

                    return false;
                }
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/post-coment')}}",
                    data: {
                        product_id: prd_id,
                        user_id: user_id,
                        coment: coment,


                        _token: _token


                    },
                    dataType: "html",
                    success: function(data) {
                        // alert(data);
                        $('#show_coment').html(data);
                        console.log(data);
                        $("#name").val('');
                        $("#email").val('');
                        $("#number").val('');
                        $("#message").val('');
                    }
                });
                // alert()
                return false;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Bạn cần đăng nhập để đăng bình luận !',
                    footer: '<a href>Why do I have this issue?</a>'
                })
                // alert('Bạn cần đăng nhập để đăng bình luận !');
            }

        });



        $(document).on('click', 'a.add-to-cart', function() {
            var user_id = $('#user_id').val();
            var number_product = $('#number_prd').val();

            if (user_id && number_product != 0) {
                var qty = $('input.input-number').val();
                var id = $(this).data('productid');
                var _token = $("input[name='_token']").val();

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/save-cart')}}",
                    data: {
                        product_id_hidden: id,
                        qty: qty,
                        _token: _token
                    },
                    dataType: "html",
                    success: function(data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm vào giỏ hàng thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        console.log(data);
                        $('#product_count').html(data);
                    }
                });
                return false;
            } else if (number_product == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mặt hàng tạm thời ngừng kinh doanh !',

                })

                return false;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Bạn cần đăng nhập để mua hàng !',

                })

                return false;
            }

        });
        
        // $('a.add-to-cart').click(function() {
        //     var qty = $('input.input-number').val();
        //     var id = $(this).data('productid');
        //     var _token = $("input[name='_token']").val();

        //     $.ajax({
        //         type: "POST",
        //         cache: false,
        //         url: "{{url('/save-cart')}}",
        //         data: {
        //             product_id_hidden: id,
        //             qty: qty,
        //             _token: _token
        //         },
        //         dataType: "html",
        //         success: function(data) {
        //             alert('Thêm vào giỏ hàng thành công');
        //             console.log(data);
        //             $('#product_count').html(data);
        //         }
        //     });
        //     return false;
        // });
        // $('.reply_btn').click(function() {
        //     alert('aaaa');
        // });
        $(document).on('click', '.reply_btn', function() {
            $('#tittle_coment').text('Reply a comment');
            $("#name").focus();
            $("#send_coment").hide();
            $("#reply_coment").show();
            var id_comen = $(this).data('id_coment');
            var user_id = $(this).data('customer_id');
            $("button[name=replycmt]").val(id_comen);
            $("button[name=replycmt]").attr('data-customer_id', user_id);
            // $(this).data('name_coment') = $("#reply_coment").data('name_coment') ;
            // $('#reply_coment').data('name_coment', { foo: 'bar' });
            // $('#send_coment').attr('id','reply_coment'); 
            // document.getElementById('send_coment').id = 'reply_coment';
            // if (name == '' || coment == '') {
            //     alert('Cần điền đầy đủ thông tin');

            return false;
            // }

        });
        $(document).on('click', '#reply_coment', function() {
            var user_id = $('#user_id').val();
            if (user_id) {
                var coment = $('#message').val();
                var prd_id = $('.product_id').val();
                var id_coment = $(this).val();
                var customer_id = $(this).data('customer_id');
                var _token = $('input[name=_token]').val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/reply-comment')}}",
                    data: {

                        product_id: prd_id,
                        id_cus: customer_id,
                        coment: coment,
                        id_coment: id_coment,
                        _token: _token
                    },
                    dataType: "html",
                    success: function(data) {
                        // alert('Thêm vào giỏ hàng thành công');
                        $('#show_coment').html(data);
                        // console.log(data);
                        $('#tittle_coment').text('Post a comment');
                        $("#send_coment").show();
                        $("#reply_coment").hide();
                        $("#name").val('');
                        $("#email").val('');
                        $("#number").val('');
                        $("#message").val('');

                        // alert(data)
                        // $('#product_count').html(data);
                    }
                });
                return false;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Bạn cần đăng nhập để đăng bình luận !    ',
                    footer: '<a href>Why do I have this issue?</a>'
                })
                // alert('Bạn cần đăng nhập để đăng bình luận !');
            }


        });
        $(document).on('click', '.delete_coment', function() {
            var user_id = $('#user_id').val();
            if (user_id) {
                var prd_id = $('.product_id').val();
                var id_coment = $('.reply_btn').val();
                var customer_id = $(this).data('customer_id');
                var _token = $('input[name=_token]').val();
          alert(id_coment);
            }

        });
        // document.querySelector('#rating').addEventListener('click', function(e) {
        //     let action = 'add';
        //     var count = 0;
        //     alert($(this).val());
        //     for (const span of this.children) {

        //         span.classList[action]('active');

        //         if (span === e.target) {
        //             action = 'remove';


        //         }

        //     }
        //     alert(count)

        // });

        $('.stars a').on('click', function() {
            var a = 0;

            $('.stars span, .stars a').removeClass('active');


            $(this).addClass('active');

            $('.stars span').addClass('active');
            //   a =$('.stars span').text();



        });

        $(document).on('click', '.stars a', function() {
            var a = $(this).text();
            $(".rating_btn").attr('data-rating_star', a);
            return false;
        });

        $(document).on('click', '.rating_btn', function() {
            var user_id = $('#user_id').val();
            var ordered = $(this).data('ordered');;
          
            if (user_id && ordered > 0) {
                var prd_id = $('.product_id').val();
                var rating = $(this).data('rating_star');
                var review = $("#review_rating").val();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/save-rating')}}",
                    data: {
                        rating: rating,
                        prd_id: prd_id,
                        review: review,
                        _token: _token
                    },
                    dataType: "html",
                    success: function(data) {
                        // alert('Thêm vào giỏ hàng thành công');
                        console.log(data);
                        $('.review_list').html(data);
                    }
                });
                return false;
            } else if (ordered == 0 && user_id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hệ thống ghi nhận bạn chưa mua sản phẩm này !',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Bạn cần đăng nhập để đăng đánh giá !',
                    footer: '<a href>Why do I have this issue?</a>'
                })

            }

        });


        function load_rating() {
            var prd_id = $('.product_id').val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                cache: false,
                url: "{{url('/load-rating')}}",
                data: {
                    product_id: prd_id,

                    _token: _token


                },
                dataType: "html",
                success: function(data) {
                    console.log(data);
                    $('.review_list').html(data);


                }
            });
        }


    });
</script>


@endpush
@endsection