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
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thông tin khách hàng
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($user_edit as $key => $userr_edit)
                            <form role="form" action="{{ URL::to('/update-user/' . $userr_edit->customer_id) }}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên người dùng</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="user_name"
                                        value="{{ $userr_edit->customer_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">email người dùng</label>
                                    <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="user_email">{{ $userr_edit->customer_email }}</Textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">password</label>
                                    <Textarea disabled style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="user_password">{{ $userr_edit->customer_password }}</Textarea>
                                </div>

                                <button type="submit" class="btn btn-info" name="add_category_product">Sửa thông tin khách hàng</button>
                                  
                            </form>
                           <?php
                           if($userr_edit->lock_customer==1){
                               echo '
                               <a href="'.url('unlock-customer/'.$userr_edit->customer_id).'" class="btn">Mở khoá tài khoản</a>
                               ';

                               
                           }
                           else{
                               echo '
                               <a href="'.url('lock-customer/'.$userr_edit->customer_id).'" class="btn">Khoá tài khoản</a>
                               ';
                           }
                          
                           ?>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
