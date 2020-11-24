@extends('layout')
@section('content')
<!-- header end -->
<main>
    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="slider-active">
            <div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-8">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="fadeInUp" data-delay=".4s">Products</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Products</a></li>
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
    <!--? Properties Start -->
    <section class="properties new-arrival fix">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-60 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <h2>Popular products</h2>
                        <P>Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare,
                            eros dolor interdum nulla.</P>
                    </div>
                </div>
            </div>
           <form action="">
               @csrf
           <h4> lọc giá sản phẩm</h4>
            <input type="text" id="from" min="0">
            <input type="text" id="to" min="0">
            <input type="submit" id="search_price">
           </form>
            <div class="row">
                <div class="col-xl-12">
                    <div class="properties__button text-center">
                        <!--Nav Button  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @if ($this_category==0)
                                <a class="nav-item nav-link active" id="nav-Sofa-tab" href="{{ URL::to('/san-pham/') }}">All</a>
                                @else
                                <a class="nav-item nav-link" id="nav-Sofa-tab" href="{{ URL::to('/san-pham/') }}">All</a>
                                @endif

                                @foreach ($category as $item)
                                @if ($item->category_id==$this_category)
                                <a class="nav-item nav-link active" id="nav-Sofa-tab" href="{{ URL::to('/danh-muc-san-pham/'.$item->category_id) }}">{{ $item->category_name }}</a>
                                @else
                                <a class="nav-item nav-link" id="nav-Sofa-tab" href="{{ URL::to('/danh-muc-san-pham/'.$item->category_id) }}">{{ $item->category_name }}</a>
                                @endif
                                @endforeach
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                </div>
            </div>
            <div class="row" >
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-Sofa" role="tabpanel" aria-labelledby="nav-Sofa-tab">
                        <div class="row" id="page_display">
                            @foreach ($product as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="{{ URL::asset('public/uploads/product/'.$item->product_image) }}" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="{{ URL::to('/chi-tiet-san-pham/'.$item->product_id) }}">{{ $item->product_name }}</a>
                                        </h3>
                                        <span>{{ number_format($item->product_price) }} VNĐ</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- End Nav Card -->
            </div>
            <!-- Button -->
            <div class="row justify-content-center">
                {{-- <div class="room-btn">
                    <a href="#" class="border-btn">Discover More</a>
                </div> --}}
              
                <span>{!! $product->render('vendor.pagination.name') !!}</span>

            </div>
         <form action="">
         @csrf
         <h4>trang hiển thị</h4>
            <input type="number" value="6" id="number_page" min="1" max="9">
         </form>

        </div>
    </section>
    <!-- Properties End -->

    <!--? New Arrival End -->
    <!-- Popular Locations End -->
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
@push('ajax-updatepage-cart')
<script>
       $(function() {
    $('#number_page').change(function() {
        var pages = $(this).val();
       
var _token = $("input[name='_token']").val();


$.ajax({
    type: "POST",
    cache: false,
    url: "{{url('/update-page')}}",
    data: {
        numberpage: pages,

        _token: _token
    },
    dataType: "html",
    success: function(data) {
      $('#page_display').html(data);
          
      
    
    }
});
return false;


});


$('#search_price').click(function() {
        var from_price = $('#from').val();
        var to_price = $('#to').val();
        var number_page = $('#number_page').val();
var _token = $("input[name='_token']").val();

$.ajax({
    type: "POST",
    cache: false,
    url: "{{url('/search-price')}}",
    data: {
        from: from_price,
        to: to_price,
        number_page: number_page,
        _token: _token
    },
    dataType: "html",
    success: function(data) {
      $('#page_display').html(data);
//    alert(data)
      
    
    }
});
return false;


});





  });
</script>
@endpush
          

@endsection