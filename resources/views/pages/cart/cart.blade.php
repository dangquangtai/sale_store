@extends('layout')
@section('content')
<main>


    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="slider-active">
            <div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-8">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="fadeInUp" data-delay=".4s">Cart List</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Cart List</a></li>
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
    <!--================Cart Area =================-->
    <section class="cart_area section-padding40">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="data-cart" id="content_cart">
                            @php
                            $cart = Cart::content();
                            @endphp
                            @foreach ($cart as $item)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ URL::asset('public/uploads/product/'.$item->options->image) }}" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $item->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><span class="p-price" data-price="{{ $item->price }}">{{ number_format($item->price) }}</span> đ</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input class="input-number" type="number" value="{{ $item->qty }}" min="1" max="10" data-rowid="{{ $item->rowId }}">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="p-total">{{ number_format($item->price*$item->qty) }} đ</h5>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm edit-cart" data-rowid="{{ $item->rowId }}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach

                            <tr class="bottom_button">
                                <td>
                                    <a class="btn" href="{{ URL::to('/cart-destroy') }}">Delete cart</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 class="sub-total">{{ Cart::total() }} đ</h5>
                                </td>
                            </tr>
                            {{-- <tr class="shipping_area">
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li>
                                                Flat Rate: $5.00
                                                <input type="radio" aria-label="Radio button for following text input">
                                            </li>
                                            <li>
                                                Free Shipping
                                                <input type="radio" aria-label="Radio button for following text input">
                                            </li>
                                            <li>
                                                Flat Rate: $10.00
                                                <input type="radio" aria-label="Radio button for following text input">
                                            </li>
                                            <li class="active">
                                                Local Delivery: $2.00
                                                <input type="radio" aria-label="Radio button for following text input">
                                            </li>
                                        </ul>
                                        <h6>
                                            Calculate Shipping
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </h6>
                                        <select class="shipping_select">
                                            <option value="1">Bangladesh</option>
                                            <option value="2">India</option>
                                            <option value="4">Pakistan</option>
                                        </select>
                                        <select class="shipping_select section_bg">
                                            <option value="1">Select a State</option>
                                            <option value="2">Select a State</option>
                                            <option value="4">Select a State</option>
                                        </select>
                                        <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                                        <a class="btn" href="#">Update Details</a>
                                    </div>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <?php
                    $content = Cart::content();
                    $count = Cart::count();
                    ?>
                    <input id="count" type="hidden" value="<?php echo $count ?>">
                    <div class="checkout_btn_inner float-right">
                        <a class="btn " href="{{URL::to('/san-pham')}}">Continue Shopping</a>
                        <a class="btn checkout_btn " href="#">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
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

    <div id="received"></div>
    <!--? Services Area End -->
    <form action="">
        @csrf
    </form>
</main>

@push('ajax-edit-cart')
<script>
    $(function() {

        $('.edit-cart').click(function() {

            var rowid = $(this).data('rowid');

            var _token = $("input[name='_token']").val();
            var this_row = $(this).parent().parent();
            $.ajax({
                type: "POST",
                cache: false,
                url: "{{url('/delete-cart-product')}}",
                data: {
                    rowId: rowid,
                    _token: _token

                },
                dataType: "html",
                success: function(data) {
                    this_row.remove();
                    $('#received').html(data);


                    var a = $('#recount').val();
                    if (a) {
                        $('#product_count').html(a);
                    } else {
                        $('#product_count').html('0');
                    }
                    var b = $('#retotal').val();
                    if (b) {
                        $('.sub-total').html(b);
                    } else {
                        $('.sub-total').html('0');
                    }
                }
            });


        });



        $('.checkout_btn').click(function() {
            $count = $('#count').val();
            if ($count == 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Giỏ hàng bạn đang trống...vui lòng kiểm tra',
                    footer: '<a href>Why do I have this issue?</a>'
                })




            } else {
                window.location.href = "  {{URL::to('/get-shipping')}} ";

            }
        });




        $('.input-number').change(function() {
            var qty = $(this).parent().parent().children().find('.input-number').val();

            var rowid = $(this).data('rowid');
            var _token = $("input[name='_token']").val();
            // alert(qty+" "+rowid+" "+_token)
            var this_row = $(this).parent().parent().parent();
            $.ajax({
                type: "POST",
                cache: false,
                url: "{{url('/update-cart-quantity')}}",
                data: {
                    rowId: rowid,
                    quantity: qty,
                    _token: _token
                },
                dataType: "json",
                success: function(data) {
                    $('.sub-total').html(data.subtotal);
                    var price = this_row.children().find('.p-price').data('price');
                    //    alert(price)
                    var x = qty * price;
                    var value = x.toLocaleString(
                        undefined, // leave undefined to use the browser's locale,
                        // or use a string like 'en-US' to override it.
                        {
                            minimumFractionDigits: 2
                        }
                    );
                    this_row.children().find('.p-total').text(value);
                }
            });
            return false;
        });



    });
</script>
@endpush



@endsection