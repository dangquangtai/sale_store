@extends('admin_layout')
@section('admin_content')
<?php
use Illuminate\Support\Facades\Session;
?>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
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
            </div>
            <div class="col-sm-4">
            </div>
           <form action="search-admin-product" method="get">
               @csrf
           <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" name="admin_product" placeholder="Search" required>
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="submit">Go!</button>
                    </span>
                </div>
            </div>
           </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Mô tả</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_product as $key => $cate_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $cate_pro->product_name }}</td>
                        <td><img src="public/uploads/product/{{ $cate_pro->product_image }}" alt=""
                                style="width: 150px;"></td>
                        <td>{{ $cate_pro->category_name }}</td>
                        <td>{{ $cate_pro->brand_name }}</td>
                        <td>{{ $cate_pro->product_price }}</td>
                        <td>{{ $cate_pro->number_product }}</td>
                        <td>{!! $cate_pro->product_desc !!}</td>
                        <td>{!! $cate_pro->product_content !!}</td>
                        <td>
                            <?php if ($cate_pro->product_status == 1) { ?>
                            <a href="{{ URL::to('/unactive-product/' . $cate_pro->product_id) }}"><span
                                    class="fa fa-thumbs-up fa-thumbs-styling"></span></a>
                            <?php } else { ?>
                            <a href="{{ URL::to('/active-product/' . $cate_pro->product_id) }}"><span
                                    class="fa fa-thumbs-down fa-thumbs-styling"></span></a>
                            <?php } ?>
                        </td>

                        <td>
                            <a href="{{ URL::to('/edit-product/' . $cate_pro->product_id) }}" class="active"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a href="{{ URL::to('/delete-product/' . $cate_pro->product_id) }}"><i
                                    class="fa fa-times text-danger text"></i></a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <span>{!! $all_product->render('vendor.pagination.name') !!}</span>
                    
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection