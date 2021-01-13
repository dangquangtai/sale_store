
@extends('layout')
@section('content')

<div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider hero-overly2  slider-height2 d-flex align-items-center slider-bg2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-8 col-md-8">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="fadeInUp" data-delay=".4s" >Blog</h1>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Blog</a></li> 
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
        <!-- Hero Area End-->
        <!--? Blog Area Start-->
        <section class="blog_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">
                         @foreach($get_post as $item)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{asset('public/uploads/post/'.$item->post_image)}}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>15</h3>
                                        <p>Jan</p>
                                    </a>
                                </div>
                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{URL::to('/post-detail/'.$item->post_id)}}">
                                        <h2 class="blog-head" style="color: #2d2d2d;">{{$item->post_tittle}}</h2>
                                    </a>
                                    <p>{!! $item->post_desc !!}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                    </ul>
                                </div>
                            </article>
                            @endforeach
                        
                            <nav class="blog-pagination justify-content-center d-flex">
                            <span>{!! $get_post->render('vendor.pagination.name') !!}</span>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget search_widget">
                                <form action="#">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                            <div class="input-group-append">
                                                <button class="btns" type="button"><i class="ti-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                                </form>
                            </aside>
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="widget_title" style="color: #2d2d2d;">Category</h4>
                                <ul class="list cat-list">
                                    @foreach($get_cate_post as $itemm)
                                    <li>
                                        <a href="{{URL::to('/post-cate-detail/'.$itemm->cate_post_id)}}" class="d-flex">
                                            <p>{{$itemm->cate_post_name}}</p>
                                          
                                        </a>
                                    </li>
                                    @endforeach
                                    <!-- <li>
                                        <a href="#" class="d-flex">
                                            <p>Travel news</p>
                                            <p>(10)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p>Modern technology</p>
                                            <p>(03)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p>Product</p>
                                            <p>(11)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p>Inspiration</p>
                                            <p>21</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p>Health Care (21)</p>
                                            <p>09</p>
                                        </a>
                                    </li> -->
                                </ul>
                            </aside>
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title" style="color: #2d2d2d;">Recent Post</h3>
                                @foreach($get_post as $item)
                                <div class="media post_item">
                                    <img style="width: 100px;" src="{{asset('public/uploads/post/'.$item->post_image)}}" alt="post">
                                    <div class="media-body">
                                        <a href="{{URL::to('/post-detail/'.$item->post_id)}}">
                                            <h3 style="color: #2d2d2d;">{{$item->post_tittle}}</h3>
                                        </a>
                                        <p>January 12, 2019</p>
                                    </div>
                                </div>
                                @endforeach
                        
                            </aside>
                           
                            <aside class="single_sidebar_widget tag_cloud_widget">
                                <h4 class="widget_title" style="color: #2d2d2d;">Tag Clouds</h4>
                                <ul class="list">
                                @foreach($get_post as $item)
                                    <li>
                                        <a href="#">{{$item->post_meta_keyword}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </aside>
                           
                     
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @endsection