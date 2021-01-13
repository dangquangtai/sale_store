@extends('admin_layout')
@section('admin_content')


<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa danh mục sản phẩm
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
                        @foreach ($edit as $key => $order_edit)
                        <form role="form" action="{{ URL::to('/update-order/' . $order_edit->order_id) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">ID đơn hàng</label>
                                <input disabled type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="user_name" value="{{ $order_edit->order_id }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID người dùng</label>
                                <input disabled type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="user_name" value="{{ $order_edit->customer_id }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tình trạng đơn hàng: </label>
                                <select class="custom-select" name="status">
                                    <?php
                                    if ($order_edit->status == 'chờ xác nhận') {
                                        echo '
                                   <option selected >chờ xác nhận</option>
                                   <option >đang vận chuyển</option>
                                  
                                   
                                   ';
                                    } elseif ($order_edit->status == 'đang vận chuyển') {
                                        echo '
                                 <option selected>đang vận chuyển</option>
                                 <option ">đã nhận hàng</option>
                                
                                 ';
                                    } elseif ($order_edit->status == 'đã nhận hàng') {

                                        echo '
                                <option selected">đã nhận hàng</option>
                                
                               
                                ';
                                    } else {
                                        echo '<option disable >huỷ đơn</option>
                                             
                              
                                ';
                                    }


                                    ?>




                                </select>
                                <?php
                                if ($order_edit->status == 'huỷ đơn') {
                                    echo ' <a href="#" class="btn">Đơn hàng đã bị huỷ</a>';
                                } else {
                                    echo '
                                    <a href="' . url('cancel-order/' . $order_edit->order_id) . '" class="btn">Huỷ đơn hàng</a>
                                    ';
                                }
                                ?>


                            </div>



                            <button type="submit" class="btn btn-info" name="add_category_product">Cập nhật đơn hàng</button>
                        </form>
                        @endforeach
                    </div>

                </div>
        </section>

    </div>

</div>
@endsection