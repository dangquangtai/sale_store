@extends('admin_layout')
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa danh mục bài viết
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
                        @foreach ($edit_cate_post as $key => $item)
                        <form role="form" action="{{ URL::to('/update-cate-post/' . $item->cate_post_id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID danh mục</label>
                                <input type="text" maxlength="17" placeholder="Enter email" name="id_cate_post" value="{{ $item->cate_post_id}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" maxlength="17" placeholder="Enter email" name="name_cate_post" value="{{ $item->cate_post_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" name="desc_cate_post" >{!! $item->cate_post_desc !!}</Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">slug</label>
                                <input type="text" maxlength="17" placeholder="Enter email" name="slug_cate_post" value="{{ $item->cate_post_slug}}">


                            </div>



                            <button type="submit" class="btn btn-info" name="add_category_product">Cập nhật danh mục bài viết</button>
                        </form>
                        @endforeach
                    </div>

                </div>
        </section>

    </div>

</div>
@endsection