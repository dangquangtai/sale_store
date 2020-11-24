@extends('admin_layout')
@section('admin_content')


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($product as $key => $item)
                            <form role="form" action="{{ URL::to('/update-product/' . $item->product_id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="product_name" required
                                        value="{{ $item->product_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                    <select class="form-control input-sm m-bot15" name="product_category" required>
                                        @foreach ($category_product as $key => $cate)
                                            <?php if ($item->category_id == $cate->category_id) { ?>
                                            <option value="{{ $cate->category_id }}" selected>{{ $cate->category_name }}
                                            </option>
                                            <?php } else { ?>
                                            <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                            <?php } ?>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thương hiệu sản phẩm</label>
                                    <select class="form-control input-sm m-bot15" name="product_brand" required>
                                        @foreach ($brand_product as $key => $brand)
                                            <?php if ($item->brand_id == $brand->brand_id) { ?>
                                            <option value="{{ $brand->brand_id }}" selected>{{ $brand->brand_name }}
                                            </option>
                                            <?php } else { ?>
                                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}
                                                <?php } ?>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <Textarea style="resize: none" rows="3" class="form-control" id="editor2"
                                        name="product_desc">{{ $item->product_desc }}</Textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <Textarea style="resize: none" rows="8" class="form-control" id="editor1"
                                        name="product_content">{{ $item->product_content }}</Textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="product_image">
                                    <img src="{{ URL::to('public/uploads/product/' . $item->product_image) }}"
                                        style="width: 300px" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="product_price" required
                                        value="{{ $item->product_price }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select class="form-control input-sm m-bot15" name="product_status" required>
                                        <option value="0">Ẩn</option>
                                        <option value="1" selected>Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info" name="add_product">Sửa sản phẩm</button>

                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
