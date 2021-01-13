@extends('admin_layout')
@section('admin_content')

<section class="checkout_area section-padding40" style="background-color: white;">
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

        <div class="cupon_area">
            <div class="check_title">
                <h1 style=" text-align: center; margin-bottom: 50px;">Quản lý đơn hàng</h1>

            </div>
            <!-- <input type="text" placeholder="Enter coupon code" /> -->

            <div class="contain">
                <form action="">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID đơn hàng</th>
                                <th scope="col">ID tài khoản</th>
                                <th scope="col">Tên người nhận</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày mua</th>
                                <th scope="col">Tình trạng đơn</th>
                                <th scope="col">Quản lý đơn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($all_order as $item)
                                <th scope="row"><span id="display_history">{{ $item->order_id }}</span></th>
                                <td>{{ $item->customer_id }} </td>
                                <td>{{ $item->receive_name }} </td>
                                <td>{{ $item->order_total }} VNĐ</td>
                                <td>{{ $item->created_at }} </td>
                                <td>{{ $item->status }} </td>
                                <td> <a href="{{ URL::to('/edit-order/' . $item->order_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a href="{{ URL::to('/delete-order/' . $item->order_id) }}"><i class="fa fa-times text-danger text"></i></a>
                                    <a href="{{ URL::to('/view-order/' . $item->order_id) }}"><i class="fas fa-eye"></i></a>
                                </td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <!-- <a class="btn" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a> -->

            </div>
            <div class="col-sm-7 text-right text-center-xs">
                    <span>{!! $all_order->render('vendor.pagination.name') !!}</span>
                    
                </div>


        </div>
        <div class="billing_details">

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