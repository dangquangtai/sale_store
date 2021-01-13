
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
</span>
  
 
  <div class="billing_details">
        <div class="check_title">
                <div class="panel-heading" >
                    Chi tiết ảnh sản phẩm

                </div>

            </div>
            <input type="text" class="form-control" disabled value="Ảnh cho sản phẩm {{$name}}" >
         
        <table class="table table-striped" style="background-color: white;">
  <thead>
    <tr>
      <th scope="col">ID ảnh</th>
      <th scope="col">Chi tiết ảnh</th>
      <th scope="col">chức năng ảnh</th>
      <th scope="col"></th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($list_img as $item)
    <tr>
      <th scope="row">{{$item->id_product_image}}</th>
      <td><img  style="max-width: 200px;" src="{{URL::to('public/uploads/product/'.$item->product_image)}}" ></td>
     
      <td>
          <?php
          if($item->img_status==1){
           echo 'Ảnh show chính';
          }
          else echo 'Ảnh show phụ';
          ?>
      </td>
      <td>
      <a href="{{ URL::to('/edit-image/' . $item->id_product_image) }}" class="active" ui-toggle-class=""><i class="fas fa-edit"></i></a>
                            <a href="{{ URL::to('/delete-image/' . $item->id_product_image) }}"><i class="fa fa-times text-danger text"></i></a>


      </td>
    </tr>
    @endforeach 
  </tbody>
</table>

        </div>


        @endsection