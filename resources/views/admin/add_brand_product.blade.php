@extends('admin_layout')
@section('admin_content')


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="brand_product_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1" name="brand_product_desc"></Textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="brand_product_status">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="add_brand_product">Thêm thương hiệu</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
