@extends('admin_layout')
@section('admin_content')

<section class="checkout_area section-padding40" >
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





        </div>

        <div class="cupon_area" style="background-color: white;">
            <div class="check_title">
                <div class="panel-heading" style="margin-bottom: 60px;">
                    Chi tiết người dùng

                </div>

            </div>
            <!-- <input type="text" placeholder="Enter coupon code" /> -->

            <div class="contain">
                <form action="">
                    @csrf
                    <table class="table"  >
                        <thead>
                            <tr>
                                <th scope="col">ID tài khoản</th>
                                <th scope="col">Tên người dùng</th>
                                <th scope="col">Tên người nhận</th>
                                <th scope="col">Sđt người nhận</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr>
                                <th scope="row">{{$order_id[0]->customer_id}}</th>
                                <td>{{$order_id[0]->customer_name}}</td>
                                <td>{{$order_id[0]->receive_name}}</td>
                                <td>{{$order_id[0]->order_phone}}</td>
                            </tr>
                        

                        </tbody>
                    </table>
                  
                  

                </form>
                <!-- <a class="btn" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a> -->

            </div>



        </div>
        <div class="billing_details">
        <div class="check_title">
                <div class="panel-heading" >
                    Chi tiết đơn hàng

                </div>

            </div>
        <table class="table table-striped" style="background-color: white;">
  <thead>
    <tr>
      <th scope="col">ID sản phẩm</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col"></th>
      <th scope="col">Giá sản phẩm</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Tổng tiền</th>
    </tr>
  </thead>
  <tbody>
       @foreach($order_id as $item)
    <tr>
      <th scope="row">{{$item->product_id}}</th>
      <td>{{$item->product_name}}</td>
      <td><img  style="max-width: 200px;" src="{{URL::to('public/uploads/product/'.$item->product_image)}}" ></td>
      <td>{{number_format($item->product_price,2)}}</td>
      <td>{{$item->product_quantity}}</td>
      <td>{{$item->order_total}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
        </div>
    </div>
</section>
@push('ajax-edit_order')
<!-- <script>
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
   
</script> -->

@endpush
@endsection