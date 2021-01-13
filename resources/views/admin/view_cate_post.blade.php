@extends('admin_layout')
@section('admin_content')

<section class="checkout_area section-padding40" >
    <div class="container">
        <div class="returning_customer">
            <!-- <div class="check_title">
                            <h2>
                                Returning Customer?
                                
                                <a href="login.html">Click here to login</a>
                            </h2>
                        </div> -->
            <!-- <p>
                        If you have shopped with us before, please enter your details in the
                        boxes below. If you are a new customer, please proceed to the
                        Billing & Shipping section.
                    </p> -->
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
           

           
            

        </div>

        <div class="cupon_area" style="background-color: white;">
            <div class="check_title">
                <h1 style=" text-align: center; margin-bottom: 50px;">Danh sách danh mục</h1>

            </div>
            <!-- <input type="text" placeholder="Enter coupon code" /> -->

            <div class="contain">
                <form action="">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id danh mục</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">mô tả danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">slug</th>
                                <th scope="col">Quản lý</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($view_cate_post as $item)
                                <th scope="row"><span id="display_history">{{ $item->cate_post_id }}</span></th>
                                <td>{{ $item->cate_post_name }} </td>
                                <td>{!! $item->cate_post_desc !!} </td>
                                <td>
                                 <?php
                                 if( $item->cate_post_status ==1 )
                                 echo ' <a href="'."unactive-cate-post/".$item->cate_post_id.'"><i class="fas fa-thumbs-up"></i></a>';
                                 else echo ' <a href="'."active-cate-post/".$item->cate_post_id.'"><i class="fas fa-thumbs-down"></i></a>';
                                 ?>

                                </td>
                                <td>{{ $item->cate_post_slug }}</td>
                                <td> <a href="{{ URL::to('/edit-cate-post/' . $item->cate_post_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a href="{{ URL::to('/delete-cate-post/' . $item->cate_post_id) }}"><i class="fa fa-times text-danger text"></i></a>
                                   
                                </td>

                                  

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <!-- <a class="btn" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a> -->

            </div>
            <div class="col-sm-7 text-right text-center-xs">
                    <span>{!! $view_cate_post->render('vendor.pagination.name') !!}</span>
                    
                </div>


        </div>
        <div class="billing_details">

        </div>
    </div>
</section>
@push('ajax-edit_order')
<!-- <script>
    $('#display_history').click(function() {
        var order_id = $(this).text();
        var _token = $("input[name='_token']").val();
        $.ajax({
            type: "POST",
            cache: false,
            url: "{{url('/display-history')}}",
            data: {
                order_id: order_id,
                _token: _token
            },
            dataType: "html",
            success: function(data) {
                $('.contain').html(data);

            }
        });
        return false;
    });
   
</script> -->

@endpush
@endsection