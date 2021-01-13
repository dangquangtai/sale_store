@extends('admin_layout')
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa chi tiết ảnh sản phẩm
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
                        @foreach ($edit_img as $key => $item)
                        <form role="form" action="{{ URL::to('/update-image/' . $item->id_product_image) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID ảnh</label>
                                <input disabled type="text" maxlength="17" placeholder="Enter email" name="id_img" value="{{ $item->id_product_image }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh hiện tại</label>
                                <img class="img-fluid" style="max-width: 200px; " src="{{URL::to('public/uploads/product/'.$item->product_image)}}" alt="Responsive image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh thay thế</label>
                                <input type="file" class="form-control" accept="image/*" name="update_image">
                                   <!-- <input type="text" name="wow">  -->
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chức năng ảnh</label>
                                <select class="custom-select" name="new_status">

                                    <?php
                                    if ($item->img_status == 1) {
                                        echo '
                                   <option  value="1" selected >show chính</option>
                                   <option disabled value="0" >show phụ</option>
                                 
                                   ';
                                    } else {
                                        echo '<option  value="0" selected >show phụ</option>
                                <option  value="1" >show chính</option>
                             
                                ';
                                    }


                                    ?>




                                </select>


                            </div>



                            <button type="submit" class="btn btn-info" name="add_category_product">Cập nhật ảnh sản phẩm</button>
                        </form>
                        @endforeach
                    </div>

                </div>
        </section>

    </div>

</div>
@endsection