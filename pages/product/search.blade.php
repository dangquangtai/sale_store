@extends('layout')

@section('content')
<div class="features_items">
    <!--features_items-->

    <h2 class="title text-center">Kết quả tìm kiếm</h2>


    @foreach ($search_product as $item => $pro)
    <a href="">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" alt="" />
                        <h2>₫ {{ number_format($pro->product_price) }}</h2>
                        <p>{{ $pro->product_name }}</p>
                        <a href="{{ URL::to('cart') }}" class="btn btn-default add-to-cart"><i
                                class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <p>{{ $pro->product_desc }}</p>
                            <h2>₫ {{ number_format($pro->product_price) }}</h2>
                            <p>{{ $pro->product_name }}</p>
                            <form action="{{ URL::to('/save-cart') }}" method="post">
                                @csrf
                                <input type="hidden" min="1" value="1" name="qty" />
                                <input type="hidden" name="product_id_hidden" value="{{ $pro->product_id }}">
                                <a href="{{ URL::to('chi-tiet-san-pham/' . $pro->product_id) }}"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chi
                                    tiết</a>
                                <button type="submit" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    @endforeach

</div>
<!--features_items-->
@endsection