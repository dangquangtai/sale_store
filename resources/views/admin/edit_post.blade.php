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
                  Sửa bài viết
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($edit_post as $item)
                        <form role="form" action="{{ URL::to('/update-post/'.$item->post_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên bài viết</label>
                                <input type="text" class="form-control" id="product_name"
                                    name="new_post_name" value="{{ $item->post_tittle }}" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">slug</label>
                                <input type="text" class="form-control" id="post_slug"
                                    name="new_post_slug" value="{{ $item->post_slug }}" >
                            </div>
                           
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                <Textarea style="resize: none" rows="3" class="form-control"
                                    name="new_post_desc" id="editor2">{{ $item->post_desc }}</Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung bài viết</label>
                                <Textarea style="resize: none" rows="6" class="form-control"
                                    name="new_post_content" id="editor1">{{ $item->post_content }}</Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Meta từ khoá</label>
                                <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" name="new_post_meta_key" >{{ $item->post_meta_keyword }}</Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Meta nội dung</label>
                                <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" name="new_post_content_meta" >{{ $item->post_meta_desc }}</Textarea>
                            </div>
                            
                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="product_price" required>
                            </div> -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh đại diện bài viết</label>
                                <img src="{{asset('public/uploads/post/'.$item->post_image)}}" alt="">
                                <input type="file" class="form-control" id="exampleInputEmail1" name="new_post_image"  accept="image/*" >
                             
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục bài viết</label>
                                <select class="form-control input-sm m-bot15" name="new_post_cate" required>
                                    @foreach ($list_cate_post as $key => $itemm)
                                        <option value="{{ $itemm->cate_post_id }}">{{ $itemm->cate_post_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="new_post_status" required>
                                    <option value="0">Ẩn</option>
                                    <option value="1" selected>Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="add_product">Sửa bài viết</button>

                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection