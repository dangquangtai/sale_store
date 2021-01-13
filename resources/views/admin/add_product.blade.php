@extends('admin_layout')
@section('admin_content')


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/save-product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product_name"
                                    name="product_name"  >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_category" required>
                                    @foreach ($category_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thương hiệu sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_brand" required>
                                    @foreach ($brand_product as $key => $brand)
                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <Textarea style="resize: none" rows="3" class="form-control"
                                    name="product_desc" id="editor2"></Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <Textarea style="resize: none" rows="6" class="form-control"
                                    name="product_content" id="editor1"></Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" name="product_image[]"  multiple = "true " accept="image/*" required>
                             
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="product_price" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng trong kho</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="number_product" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status" required>
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
