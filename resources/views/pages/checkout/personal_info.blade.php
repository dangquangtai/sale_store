@extends('layout')
@section('content')
<section class="checkout_area section-padding40 info">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
            <?php
                    $message = Session::get('message');
                    if ($message) {
                    echo ' <div class="badge badge-light">
                        ' .
                        $message .
                        '</div>';
                    Session::put('message', null);
                    }
                    ?>
                <h3>Thông tin cá nhân</h3>
                @foreach($avt as $item)
                <form class="row contact_form" action="{{URL::to('/update-profile')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 form-group p_star"> <br>
                        <span>Email:</span>
                        <input type="text" class="form-control" id="first" name="email" value="{{$item->customer_email}}" />

                    </div>
             
                    <div class="col-md-6 form-group">
                        <span>Tên:</span>
                        <input type="text" class="form-control" id="company" name="name" value="{{$item->customer_name}}" />
                    </div>
              
                    <div class="col-md-6 form-group p_star">
                        <span>Số điện thoại:</span>
                        <input type="text" class="form-control" id="email" name="phone" value="{{$item->customer_phone}}" />

                    </div>
           
                    <div class="col-md-3">
                        <span>Ảnh đại diện:</span>
                    </div>

                    <div class="col-md-6 form-group p_star">

                        <?php
                        if ($item->customer_avt == null) {
                            echo '
                   <img style="width: 150px;" src="' . url('public/frontend/assets/img/icon/unnamed.png') . '" alt="">
                   ';
                        } else {
                            echo '
                <img style="width: 150px;" src="' . url('public/uploads/avatar/' . $item->customer_avt) . '" alt="">
                ';
                        }
                        ?>

                    </div>
                    <div class="col-md-3"></div>
                
                    <div class="col-md-3"></div>
                    <div class="col-md-2 form-group">
                        <input type="file" class="form-control" accept="image/*" name="avatar">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button class="btn " type="submit"> Lưu</button>
                        <a href="#" class="btn change_pass">Đổi mật khẩu</a>
                 
                    </div>
                    <div class="col-md-6">
                    </div>
          
                </form>
              
                                @endforeach
                            </div>
                            <div class="col-lg-2">
                               
                            </div>

                        </div>
                    </div>
                </section>
                <section class="checkout_area section-padding40 change_pass" style="display: none;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">

                            </div>
                            <div class="col-lg-8">
                            <h3>Đổi mật khẩu</h3>
                
                <form class="row contact_form" action="{{URL::to('/update-password')}}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="col-md-6 form-group p_star"> <br>
                        <span>Mật khẩu mới:</span>
                        <input type="password" class="form-control" id="first" name="pass"  />

                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 form-group">
                        <span>Xác nhận mật khẩu:</span>
                        <input type="password" class="form-control" id="company" name="cfpass"  />
                    </div>
                   <div class="col-md-6"></div>
                   
                    <div class="col-md-6">
                        <button class="btn btn_change_pass"> Đổi mật khẩu</button>
                    </div>
                    <div class="col-md-6">
                    </div>
                   
                </form>
                            </div>
                            <div class="col-lg-2">
                            
                            </div>
                            </div>
                            </div>
                            </section>


                @endsection