@extends('admin_layout')
@section('admin_content')
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê bài viết
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
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
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
                        <th>Tên bài viết</th>
                        <th>Hình ảnh</th>
                        <th>slug</th>
                        <th>Mô tả bài viết</th>
                        <th>Từ khoá bài viết</th>
                        <th>Danh mục bài viết</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($view_post as $key => $item)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $item->post_tittle }}</td>
                        <td><img src="{{asset('public/uploads/post/'.$item->post_image)}}" alt="" style="width: 150px;"></td>
                        <td>{{ $item->post_slug }}</td>
                        <td>{!! $item->post_desc !!}</td>
                        <td>{{ $item->post_meta_keyword }}</td>
                        <td>{!! $item->cate_post_name !!}</td>
                        <td>
                        <td>
                            <?php
                            if ($item->post_status == 1)
                               {
                                echo ' <a href="' . "unactive-post/" . $item->post_id . '"><i class="fas fa-thumbs-up"></i></a>';
                               }
                            else echo ' <a href="' . "active-post/" . $item->post_id . '"><i class="fas fa-thumbs-down"></i></a>';
                            ?>

                        </td>

                        <td>
                            <a href="{{ URL::to('/edit-post/' . $item->post_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a href="{{ URL::to('/delete-post/' . $item->post_id) }}"><i class="fa fa-times text-danger text"></i></a>

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
                    <span>{!! $view_post->render('vendor.pagination.name') !!}</span>

                </div>
            </div>
        </footer>
    </div>
</div>
@endsection