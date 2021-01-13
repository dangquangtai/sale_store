@extends('admin_layout')
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm ảnh sản phẩm
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
                      </span>
                <div class="panel-body">
                    <div class="position-center">
                      
                        <form role="form" action="{{ URL::to('/save-add-product-image')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <select class="custom-select" name="create_name">

                                @foreach ($choose_product as $key => $item)
                                    <option value="{{$item->product_id}}" selected>{{$item->product_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn ảnh để thêm</label>
                                <input type="file" class="form-control" accept="image/*" name="create_image">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn chức năng ảnh</label>
                                <select class="custom-select" name="create_status">


                                    <option value="1" selected>show chính</option>
                                    <option value="0">show phụ</option>

                                </select>


                            </div>



                            <button type="submit" class="btn btn-info" name="add_category_product">Thêm ảnh sản phẩm</button>
                        </form>
                      
                    </div>

                </div>
        </section>

    </div>

</div>
@endsection