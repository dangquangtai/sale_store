@extends('layout')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Payment</li>
            </ol>
        </div>
        <!--/breadcrums-->


        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
                ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $item)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ URL::to('public/uploads/product/'. $item->options->image) }}" alt=""
                                    style="width: 100px;"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{ URL::to('/chi-tiet-san-pham/'. $item->id) }}">{{ $item->name }}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($item->price)}} đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                {{-- <a class="cart_quantity_up" href=""> + </a> --}}
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item->qty }}"
                                    autocomplete="off" size="2">
                                {{-- <a class="cart_quantity_down" href=""> - </a> --}}
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ number_format($item->price*$item->qty) }} đ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
        <div class="payment-options">
            <form action="{{ URL::to('/order-place') }}" method="post">
                @csrf
                <span>
                    <label><input type="radio" value="1" name="payment_option"> ATM</label>
                </span>
                <span>
                    <label><input type="radio" value="2" name="payment_option"> Tiền mặt</label>
                </span>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</section>
<!--/#cart_items-->
@endsection