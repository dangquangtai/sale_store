@extends('admin_layout')
@section('admin_content')


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        {{-- @foreach ($edit_brand_product as $key => $edit_value)
                            <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="brand_product_name"
                                        value="{{ $edit_value->brand_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thươngc</label>
                                    <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="brand_product_desc">{{ $edit_value->brand_desc }}</Textarea>
                                </div>

                                <button type="submit" class="btn btn-info" name="add_brand_product">Sửa thương hiệu</button>
                            </form>
                        @endforeach --}}


                            <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_brand_product->brand_id) }}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="brand_product_name"
                                        value="{{ $edit_brand_product->brand_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thươngc</label>
                                    <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="brand_product_desc">{{ $edit_brand_product->brand_desc }}</Textarea>
                                </div>

                                <button type="submit" class="btn btn-info" name="add_brand_product">Sửa thương hiệu</button>
                            </form>

                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
