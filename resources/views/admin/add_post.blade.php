@extends('admin_layout')
@section('admin_content')

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

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/save-add-post') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên bài viết</label>
                                <input type="text" class="form-control" id="product_name"
                                    name="post_name"  >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">slug</label>
                                <input type="text" class="form-control" id="post_slug"
                                    name="post_slug"  >
                            </div>
                           
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                <Textarea style="resize: none" rows="3" class="form-control"
                                    name="post_desc" id="editor2"></Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung bài viết</label>
                                <Textarea style="resize: none" rows="6" class="form-control"
                                    name="post_content" id="editor1"></Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Meta từ khoá</label>
                                <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" name="post_meta_key" ></Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Meta nội dung</label>
                                <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" name="post_content_meta" ></Textarea>
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="product_price" required>
                            </div> -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh đại diện bài viết</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" name="post_image"  accept="image/*" required>
                             
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục bài viết</label>
                                <select class="form-control input-sm m-bot15" name="post_cate" required>
                                    @foreach ($add_post as $key => $item)
                                        <option value="{{ $item->cate_post_id }}">{{ $item->cate_post_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="post_status" required>
                                    <option value="0">Ẩn</option>
                                    <option value="1" selected>Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="add_product">Thêm sản phẩm</button>

                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection