@extends('layout')
@section('content')


<section class="cart_area section-padding40">
<?php

use Illuminate\Support\Facades\Session;

$message = Session::get('message');
?>
<span style="color: green; margin-left:150px;">
    <?php
    if ($message) {
        echo $message;
        Session::put('message', NULL);
    }
    ?>
</span>
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <form action="">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id đơn hàng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày mua</th>
                                <th scope="col">Tình trang đơn</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="data-cart" id="content_cart">

                            @foreach ($list_order as $item)
                            <tr>
                                <td id="display_history">
                                    <div class="media">

                                        <div class="media-body">
                                            <p>{{ $item->order_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><span class="p-price">{{ $item->order_total }} </span> VNĐ</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        {{ $item->created_at }}
                                    </div>
                                </td>
                                <td>
                                    <h5 class="p-total">{{ $item->status }}</h5>
                                </td>
                                <td>
                                    <?php
                                    if ($item->status == 'đang vận chuyển') {
                                        echo '
                                 <a style="border-radius: 10px; padding: 15px 20px;" href="' . url('confirm-order/' . $item->order_id) . '" class="btn btn-outline-danger btn-sm ">
                                 Đã nhận hàng <i class="fas fa-check-circle"></i>
                                 </a>
                                  ';
                                    }elseif($item->status == 'chờ xác nhận'){
                                    echo '
                                    <a style="border-radius: 10px; padding: 15px 20px;" href="' . url('cancel-order/' . $item->order_id) . '" class="btn btn-outline-danger btn-sm ">
                                    Huỷ đơn hàng <i class="fas fa-check-circle"></i>
                                    </a>
                                    ';
                                    }
                                    elseif($item->status == 'huỷ đơn'){
                                        echo '
                                        <a style="border-radius: 10px; padding: 15px 20px;" href="#" class="btn btn-outline-danger btn-sm ">
                                       Đơn đã bị huỷ <i class="fas fa-check-circle"></i>
                                        </a>
                                        ';
                                        }else{
                                            echo '
                                        <a style="border-radius: 10px; padding: 15px 20px;" href="#" class="btn btn-outline-danger btn-sm ">
                                      Đơn đã nhận<i class="fas fa-check-circle"></i>
                                        </a>
                                        ';
                                        }
                                    ?>
                                </td>
                            </tr>
                            @endforeach

                            <tr class="bottom_button">
                                <td>
                                    <a class="btn" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a>
                                </td>


                            </tr>


                        </tbody>
                        
                    </table>
                    <div class="row justify-content-center">
                

                <span>{!! $list_order->render('vendor.pagination.name') !!}</span>

            </div>
                </form>

            </div>
        </div>
    </div>
</section>
@push('ajax-edit-cart')
<script>
    $(document).on('click', '#display_history', function() {

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
                $('.cart_inner').html(data);

            }
        });
        return false;

    });
</script>

@endpush
@endsection