@extends('layout')
@section('content')
<!-- header end -->

<div class="slider-area ">
    <div class="slider-active">
        <div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-8">
                        <div class="hero__caption hero__caption2">
                            <h1 data-animation="fadeInUp" data-delay=".4s">Categories</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
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
<!-- listing Area Start -->
<div class="category-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-50">
                    <h2>Shop with us</h2>
                    <p>Browse from 230 latest items</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!--? Left content -->
            <div class="col-xl-3 col-lg-3 col-md-4 ">
                <div class="row">
                    <div class="col-12">
                        <div class="small-tittle mb-45">
                            <div class="ion"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                                    <path fill-rule="evenodd" fill="rgb(27, 207, 107)" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"></path>
                                </svg>
                            </div>
                            <h4>Filter Product</h4>
                        </div>
                    </div>
                </div>
                <!-- Job Category Listing start -->
                <div class="category-listing mb-50">

                    <div class="categories-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <!-- Select State items start -->
                                <div class="select-categories">

                                    <form action="">
                                        @csrf
                                        <select name="select" id="select_brand" class="ignore">
                                            @if ($this_brand==0)
                                            <a href="{{ URL::to('/san-pham/') }}">
                                                <option selected value="0">all</option>
                                            </a>
                                            @else
                                            <option value="0">all</option>
                                            @endif
                                            @foreach ($brand as $item)
                                            @if ($item->brand_id==$this_brand)
                                            <a href="{{ URL::to('/thuong-hieu-san-pham/'.$item->brand_id) }}">
                                                <option selected value="{{$item->brand_id}}">{{ $item->brand_name }}</option>
                                            </a>
                                            @else
                                            <a href="{{ URL::to('/danh-muc-san-pham/'.$item->brand_id) }}">
                                                <option value="{{$item->brand_id}}">{{ $item->brand_name }}</option>
                                            </a>
                                            @endif
                                            @endforeach

                                        </select>

                                    </form>
                                </div>
                                <!--  Select State items End-->
                            </div>
                            <div class="col-12">
                                <!-- Select km items start -->
                                <div class="select-categories">
                                    <select name="select2">
                                        <option value="">Size</option>
                                        <option value="">2.2ft</option>
                                        <option value="">5.5ft</option>
                                        <option value="">8.2ft</option>
                                        <option value="">10.2ft</option>
                                    </select>
                                </div>
                                <!--  Select km items End-->
                            </div>
                            <div class="col-12">
                                <!-- Select km items start -->
                                <div class="select-categories">
                                    <select name="select3">
                                        <option value="">Color</option>
                                        <option value="">Whit</option>
                                        <option value="">Green</option>
                                        <option value="">Blue</option>
                                        <option value="">Sky Blue</option>
                                        <option value="">Gray</option>
                                    </select>
                                </div>
                                <!--  Select km items End-->
                            </div>
                            <div class="col-12">
                                <!-- Select km items start -->
                                <div class="select-categories">
                                    <select name="select4">
                                        <option value="">Price range</option>
                                        <option value="">$10 to $20</option>
                                        <option value="">$20 to $30</option>
                                        <option value="">$50 to $80</option>
                                        <option value="">$100 to $120</option>
                                        <option value="">$200 to $300</option>
                                        <option value="">$500 to $600</option>
                                    </select>
                                </div>
                                <!--  Select km items End-->
                            </div>
                        </div>



                    </div>

                    <!-- Range Slider Start -->
                    <div class="range-slider mt-50">
                        <div class="small-tittle small-tittle2">
                            <h4>Price Range</h4>
                        </div>
                        <div class="range_item">
                            <!-- <div id="slider-range"></div> -->
                            <input type="text" class="js-range-slider" value="" />
                            <form action="{{url('/search-price')}}" method="get">

                                <div class="d-flex align-items-center">
                                    <div class="price_text">
                                        <p>Price :</p>
                                    </div>
                                    <div class="price_value d-flex justify-content-center">
                                        <input type="text" class="js-input-from" id="amount" name="price_from" readonly />
                                        <input type="text" value=".000">
                                        <span>to</span>
                                        <input type="text" class="js-input-to" id="amount" name="price_to" readonly />
                                        <input type="text" value=".0000">
                                    </div>

                                </div>
                                <button style="width: 55%;font-size: 15px;border-radius: 100px;" class=" btn price-range-search btn-search" id="price-range-submit">Find</button>
                            </form>
                        </div>
                    </div>
                    <!-- Range Slider End -->

                    <!-- Check box -->
                    <div class="select-checkbox mt-30 mb-30">
                        <div class="small-tittle" style="margin-top: 20px;">
                            <h4>Latest Product</h4>
                        </div>
                        <label class="container">Any
                            <input type="checkbox" checked="checked active">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Today
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Last 2 days
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Last 5 days
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Last 10 days
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Last 15 days
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <!-- Check box /-->
                </div>
                <!-- Job Category Listing End -->
            </div>
            <!--?  Right content -->
            <div class="col-xl-9 col-lg-9 col-md-8 ">
                <!-- Count of Job list Start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="count-job mb-35">
                            <span>39, 782 Product found</span>



                            <div class="select-cat get-hide">

                                <span>Hiển thị</span>

                                <select name="select" id="number_page">


                                    <option selected value="6">6 sản phẩm</option>


                                    <option value="3">3 sản phẩm</option>

                                    <option value="9">9 sản phẩm</option>
                                    <option value="12">12 sản phẩm</option>
                                    <option value="15">15 sản phẩm</option>





                                </select>

                                </form>

                            </div>

                            <div class="select-cat">

                                <span>Sort by</span>
                                <form action="">
                                    @csrf
                                    <select name="select" id="select_cate">
                                        @if ($this_category==0)
                                        <a href="{{ URL::to('/san-pham/') }}">
                                            <option selected value="0">all</option>
                                        </a>
                                        @else
                                        <option value="0">all</option>
                                        @endif
                                        @foreach ($category as $item)
                                        @if ($item->category_id==$this_category)
                                        <a href="{{ URL::to('/danh-muc-san-pham/'.$item->category_id) }}">
                                            <option selected value="{{$item->category_id}}">{{ $item->category_name }}</option>
                                        </a>
                                        @else
                                        <a href="{{ URL::to('/danh-muc-san-pham/'.$item->category_id) }}">
                                            <option value="{{$item->category_id}}">{{ $item->category_name }}</option>
                                        </a>
                                        @endif
                                        @endforeach

                                    </select>

                                </form>

                            </div>
                            <!--  Select job items End-->
                        </div>
                    </div>
                </div>
                <!-- Count of Job list End -->

                <!--? New Arrival Start -->
                <div class="new-arrival new-arrival3">
                    <div class="row" id="page_display">

                        @foreach ($product as $item)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <a href="{{ URL::to('/chi-tiet-san-pham/'.$item->product_id) }}">
                                <div class="single-new-arrival mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="{{ URL::asset('public/uploads/product/'.$item->product_image) }}" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="{{ URL::to('/chi-tiet-san-pham/'.$item->product_id) }}">{{ $item->product_name }}</a></h3>
                                        <span>{{ number_format($item->product_price) }} VNĐ</span>
                                    </div>
                                </div>
                            </a>

                        </div>

                        @endforeach


                    </div>
                    <!-- Button -->


                </div>

                <div class="row justify-content-center">
                    <span>{!! $product->render('vendor.pagination.name') !!}</span>
                </div>

                <!--? New Arrival End -->
            </div>
        </div>

    </div>
</div>

@push('ajax-updatepage-cart')
<script>
    $(function() {
        /* 6. Nice Selectorp  */
        var nice_Select = $('select');
        if (nice_Select.length) {
            nice_Select.niceSelect();
        }
        if (document.URL != 'http://localhost/shop/san-pham') {
            $('.get-hide').hide();
        }
        // $('select:not(.ignore)').niceSelect();
        // FastClick.attach(document.body);

        $(document).on('change', '#number_page', function() {
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



        // $('#price-range-submit').click(function() {
        //     var from_price = $('.js-input-from').val();
        //     var to_price = $('.js-input-to').val();
        //     var number_page = $('#number_page').val();
        //     var _token = $("input[name='_token']").val();

        //     $.ajax({
        //         type: "POST",
        //         cache: false,
        //         url: "{{url('/search-price')}}",
        //         data: {
        //             from: from_price,
        //             to: to_price,
        //             number_page: number_page,
        //             _token: _token
        //         },
        //         dataType: "html",
        //         success: function(data) {
        //             $('#page_display').html(data);
        //             //    alert(data)


        //         }
        //     });
        //     return false;


        // });
        $(document).on('change', '#select_brand', function() {
            var brand_id = $('.ignore').val();
            var url = $('input[name=get_url]').val();
            if (brand_id == 0) {
                window.location.href = url + '/san-pham';
            } else {
                var a = url + '/thuong-hieu-san-pham/' + brand_id;
                window.location.href = a;
            }


        });
        $(document).on('change', '#select_cate', function() {
            var cate_id = $('#select_cate').val();
            var _token = $("input[name='_token']").val();
            // $('#number_page').val(10);
            // var object = $(this).attr('id');
            // var matp = $(this).val();
            var url = $('input[name=get_url]').val();
            if (cate_id == 0) {
                window.location.href = url + '/san-pham';
            } else {
                var a = url + '/danh-muc-san-pham/' + cate_id;
                window.location.href = a;
            }

            return false;

        });

    });
</script>
<script src="{{url('public/frontend/assets/js/jquery.nice-select.min.js')}}"></script>
@endpush
@push('nice-select')

<link rel="stylesheet" href="{{url('public/frontend/assets/css/nice-select.css')}}">
@endpush

@endsection