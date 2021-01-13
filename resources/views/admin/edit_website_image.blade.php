@extends('admin_layout')
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                 Chỉnh sửa sửa nội dung website
            </header>
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

                <div class="panel-body">
                    <div class="position-center">

                        <form role="form" action="{{ URL::to('/update-slider/') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @foreach($edit_slider as $item)

                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh chính trang chủ</label>
                                <img class="img-fluid" style="max-width: 200px; margin-bottom: 20px;" src="{{URL::to('public/frontend/assets/img/hero/h1_hero.png')}}" alt="Responsive image"><br>
                                <input type="file" class="form-control" accept="image/*" name="update_header_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung ảnh chính trang chủ</label>
                                <Textarea style="resize: none" rows="3" class="form-control" id="editor1" name="content_header">{!! $item->content_header_index !!}</Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh footer trang chủ</label>
                                <img class="img-fluid" style="max-width: 200px;  margin-bottom: 20px; " src="{{URL::to('public/frontend/assets/img/gallery/visit_bg.png')}}" alt="Responsive image"><br>
                                <input type="file" class="form-control" accept="image/*" name="update_footer_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nộ dung ảnh footer trang chủ</label>
                                <Textarea style="resize: none" rows="3" class="form-control" id="editor2" name="content_footer">{!! $item->content_footer_index !!}</Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh chính các trang khác</label>
                                <img class="img-fluid" style="max-width: 200px;  margin-bottom: 20px; " src="{{URL::to('public/frontend/assets/img/hero/h2_hero1.png')}}" alt="Responsive image"><br>
                                <input type="file" class="form-control" accept="image/*" name="update_other_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung lời quảng cáo sản phẩm</label>
                                <Textarea style="resize: none" rows="3" class="form-control" id="editor3" name="intro_product">{!! $item->intro_product !!}</Textarea>
                            </div>





                            <button type="submit" class="btn btn-info" name="add_category_product">Cập nhật ảnh website</button>
                       @endforeach
                        </form>

                    </div>

                </div>
        </section>

    </div>

</div>
@endsection