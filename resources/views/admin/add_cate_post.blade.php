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
                    <form role="form" action="{{ URL::to('/save-add-cate-post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" class="form-control" id="product_name" name="cate_post_name">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">slug</label>
                            <input type="text" class="form-control" id="product_name" name="cate_post_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">mô tả danh mục bài viết</label>
                            <Textarea style="resize: none" rows="6" class="form-control" name="cate_post_desc" id="editor1"></Textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="cate_post_status" required>
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