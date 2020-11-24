@extends('layout')
@section('content')


<main>
    <!--? slider Area Start-->
    <div class="slider-area ">
        <div class="slider-active">
            <div class="single-slider hero-overly1 slider-height d-flex align-items-center slider-bg1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-8 col-md-8">
                            <div class="hero__caption">
                                <span>Giảm giá 70% </span>
                                <h1 data-animation="fadeInUp" data-delay=".4s" style="font-family:Serif,arial,helvetica;">
                                    Nội thất với giá siêu rẻ</h1>
                                <p data-animation="fadeInUp" data-delay=".6s">Luôn mang đến cho bạn không gian gia đình ấm cúng..một nơi
                                    hoàn hảo để trở về với những người yêu thương. </p>
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInUp" data-delay=".7s">
                                    <a href="{{ URL::to('/san-pham') }}" class="btn hero-btn">Khám phá ngay</a>
                                </div>
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
                        <h2>Sản phẩm mới nhất</h2>
                        <P>Phong cách nội thất sang trọng..tinh tế thể hiện đẳng cấp của bạn...đến với chúng tôi và bạn sẽ không bao giờ hối hận
                            về lựa chọn của mình</P>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="properties__button text-center">
                        <!--Nav Button  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($category as $item)
                                <a class="nav-item nav-link" id="nav-Sofa-tab" href="{{ URL::to('/danh-muc-san-pham/'.$item->category_id) }}">{{ $item->category_name }}</a>
                                @endforeach
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-Sofa" role="tabpanel" aria-labelledby="nav-Sofa-tab">
                        <div class="row">
                            @foreach ($product as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="{{ URL::to('/chi-tiet-san-pham/'.$item->product_id) }}">
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
                                </a>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Card two -->
                    <div class="tab-pane fade" id="nav-Table" role="tabpanel" aria-labelledby="nav-Table-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular1.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular2.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular3.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card three -->
                    <div class="tab-pane fade" id="nav-Chair" role="tabpanel" aria-labelledby="nav-Chair-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular1.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular2.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular3.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card FOUR -->
                    <div class="tab-pane fade" id="nav-Bed" role="tabpanel" aria-labelledby="nav-Bed-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular1.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular2.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular3.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card FIVE -->
                    <div class="tab-pane fade" id="nav-Lightning" role="tabpanel" aria-labelledby="nav-Lightning-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular1.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular2.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular3.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card SIX -->
                    <div class="tab-pane fade" id="nav-Decore" role="tabpanel" aria-labelledby="nav-Decore-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular1.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular2.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="assets/img/gallery/popular3.png" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless
                                                Loveseat</a></h3>
                                        <span>$367</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Nav Card -->
            </div>
        </div>
    </section>
    <!-- Properties End -->
    <!--? Visit Our Tailor Start -->
    <div class="visit-tailor-area fix">
        <!--Right Contents  -->
        <div class="tailor-offers"></div>
        <!-- left Contents -->
        <div class="tailor-details">
            <h2>Nội thất hiện đại<br> tỏa sáng mọi không gian</h2>
            <p>Khởi nguồn từ 1999 với ý tưởng tạo ra sự khác biệt và gu thẩm mỹ Tinh Tế,
                 chúng tôi đã trở thành và giữ vững vị trí thương hiệu nội thất hàng đầu Việt Nam.</p>
            <p class="pera-bottom"> Một quá trình dài của sự tìm tòi và đầy cảm hứng, chúng tôi đã thiết kế và 
                sản xuất ra những sản phẩm nội thất hợp thời và độc đáo, kết hợp với quá trình chọn lọc kỹ lưỡng những món
                 đồ trang trí để tạo nên không gian sống hài hòa, Tinh Tế và sang trọng. Nội thất Nhà Xinh chính là sự lựa chọn 
                 của những người Tinh Tế.</p>
            <a href="#" class="btn">Khám phá</a>
        </div>

    </div>
    <!-- Visit Our Tailor End -->
    <!--? New Arrival-2 Start -->
    <!-- <div class="new-arrival new-arrival2">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="section-tittle mb-60 text-center wow fadeInUp" data-wow-duration="2s" data-wow-delay=".2s">
                        <h2>Products you may like</h2>
                        <P>Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare,
                            eros dolor interdum nulla.</P>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <div class="popular-img">
                            <img src="assets/img/gallery/popular4.png" alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless Loveseat</a></h3>
                            <span>$367</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="popular-img">
                            <img src="assets/img/gallery/popular5.png" alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless Loveseat</a></h3>
                            <span>$367</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="popular-img">
                            <img src="assets/img/gallery/popular6.png" alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless Loveseat</a></h3>
                            <span>$367</span>
                        </div>
                    </div>
                </div>
            </div>
            < Button -->
    <!-- <div class="row justify-content-center">
                <div class="room-btn">
                    <a href="product.html" class="border-btn">Discover More</a>
                </div>
            </div>
        </div>
    </div>  -->
    <!--? New Arrival End -->
    <!--? instagram-social start -->
    <!-- <div class="instagram-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="instra-tittle mb-40">
                        <div class="section-tittle">
                            <img src="assets/img/gallery/insta.png" alt="">
                            <h2>Get Inspired with Instagram</h2>
                            <P class="mb-35">Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis
                                viverra ornare, eros dolor interdum nulla.</P>
                            <a href="product.html" class="border-btn">Discover More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row no-gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="single-instagram">
                                <img src="assets/img//gallery/instra1.png" alt="" class="w-100">
                                <a href="#"><i class="ti-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="single-instagram">
                                <img src="assets/img//gallery/instra2.png" alt="" class="w-100">
                                <a href="#"><i class="ti-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- instagram-social End -->
    <!--? New Arrival-3 Start -->
    <!-- <div class="new-arrival new-arrival2">
        <div class="container">
            
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-60 text-center wow fadeInUp" data-wow-duration="2s" data-wow-delay=".2s">
                        <h2>Top Pick</h2>
                        <P>Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare,
                            eros dolor interdum nulla.</P>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <div class="popular-img">
                            <img src="assets/img/gallery/popular7.png" alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless Loveseat</a></h3>
                            <span>$367</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="popular-img">
                            <img src="assets/img/gallery/popular8.png" alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless Loveseat</a></h3>
                            <span>$367</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="popular-img">
                            <img src="assets/img/gallery/popular9.png" alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.html">Bly Microfiber / Microsuede 56" Armless Loveseat</a></h3>
                            <span>$367</span>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row justify-content-center">
                <div class="room-btn">
                    <a href="product.html" class="border-btn">Discover More</a>
                </div>
            </div>
        </div>
    </div> -->
    <!--? New Arrival End -->
    <!-- Popular Locations End -->
    <!--? Services Area Start -->
    <div class="categories-area section-padding40 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="cat-icon">
                            <img src="{{URL::to('public/frontend/assets/img/icon/services1.svg')}}" alt="">
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
                            <img src="{{URL::to('public/frontend/assets/img/icon/services2.svg')}}" alt="">
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
                            <img src="{{URL::to('public/frontend/assets/img/icon/services3.svg')}}" alt="">
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
                            <img src="{{URL::to('public/frontend/assets/img/icon/services4.svg')}}" alt="">
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
@endsection