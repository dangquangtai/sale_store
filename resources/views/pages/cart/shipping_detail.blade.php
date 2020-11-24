@extends('layout')
@section('content')

<section class="checkout_area section-padding40">
    <div class="container">
        <div class="returning_customer">
            <!-- <div class="check_title">
                            <h2>
                                Returning Customer?
                                
                                <a href="login.html">Click here to login</a>
                            </h2>
                        </div> -->
            <!-- <p>
                        If you have shopped with us before, please enter your details in the
                        boxes below. If you are a new customer, please proceed to the
                        Billing & Shipping section.
                    </p> -->
            <?php

            use Illuminate\Support\Facades\Session;

            $message = Session::get('message');
            ?>
            <span style="color: green;">
                <?php
                if ($message) {
                    echo $message;
                    Session::put('message', NULL);
                }
                ?>
            </span>
            <?php
            $user = Session::get('customer_name');
            $email = Session::get('customer_email');

            ?>
            <form class="row contact_form" action="#" method="post">

                <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user ?> " disabled />

                </div>
                <div class="col-md-6 form-group p_star">
                    <input type="email" class="form-control" id="password" name="password" value="<?php echo $email ?>" disabled />

                </div>


            </form>
            <?php
            $count = Cart::count();
            ?>
             <?php
           Session::put('a', 'abc');
           Session::put('a', 'xyz');
           $b =Session::get('a')
            ?>
            <input type="hidden" id="count_input" value="<?php echo $count ?> <?php echo $b ?>">
        </div>
    
        <div class="cupon_area">
            <div class="check_title">
                <h1 style=" text-align: center; margin-bottom: 50px;">Lịch sử mua hàng</h1>

            </div>
            <!-- <input type="text" placeholder="Enter coupon code" /> -->

            <div class="contain">
                <form action="">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID đơn hàng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($list_order as $item)
                                <th scope="row"><span id="display_history">{{ $item->order_id }}</span></th>
                                <td>{{ $item->order_total }} VNĐ</td>
                                <td>{{ $item->created_at }} </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <a class="btn" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a>

            </div>

           

        </div>
        <div class="billing_details">

        </div>
    </div>
</section>
@push('ajax-edit-cart')
<script>
    $('#display_history').click(function() {
        var order_id = $(this).text();
        var _token = $("input[name='_token']").val();
        $.ajax({
            type: "POST",
            cache: false,
            url: "{{url('/display-history')}}",
            data: {
                order_id: order_id,
                _token: _token
            },
            dataType: "html",
            success: function(data) {
                $('.contain').html(data);

            }
        });
        return false;
    });
   
</script>

@endpush
@endsection