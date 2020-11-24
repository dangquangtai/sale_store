@extends('admin_layout')
@section('admin_content')


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($edit_category_product as $key => $edit_value)
                            <form role="form" action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="category_product_name"
                                        value="{{ $edit_value->category_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="category_product_desc">{{ $edit_value->category_desc }}</Textarea>
                                </div>

                                <button type="submit" class="btn btn-info" name="add_category_product">Sửa danh
                                    mục</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
