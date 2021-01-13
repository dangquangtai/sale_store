@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê thương hiệu
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
                <form action="search-brand" method="get">
                    @csrf
                    <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" name="brand_name" placeholder="Search" required>
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
                            <th>Tên thương</th>
                            <th>Mô tả</th>
                            <th>Tình trạng</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_brand_product as $key => $cate_pro)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>{{ $cate_pro->brand_name }}</td>
                                <td>{{ $cate_pro->brand_desc }}</td>
                                <td>
                                    <?php if ($cate_pro->brand_status == 1) { ?>
                                    <a href="{{ URL::to('/unactive-brand-product/' . $cate_pro->brand_id) }}"><span
                                            class="fa fa-thumbs-up fa-thumbs-styling"></span></a>
                                    <?php } else { ?>
                                    <a href="{{ URL::to('/active-brand-product/' . $cate_pro->brand_id) }}"><span
                                            class="fa fa-thumbs-down fa-thumbs-styling"></span></a>
                                    <?php } ?>
                                </td>

                                <td>
                                    <a href="{{ URL::to('/edit-brand-product/' . $cate_pro->brand_id) }}"
                                        class="active" ui-toggle-class=""><i
                                            class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a href="{{ URL::to('/delete-brand-product/' . $cate_pro->brand_id) }}"><i
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
                    <span>{!! $all_brand_product->render('vendor.pagination.name') !!}</span>
                    
                </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
