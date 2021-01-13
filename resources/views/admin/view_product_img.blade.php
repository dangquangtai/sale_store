@extends('admin_layout')
@section('admin_content')
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thư viện ảnh sản phẩm
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
                        <th>id sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($view_img as $key => $item)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $item->product_id }}</td>
                        <td>{{ $item->product_name }}</td>
                      
                     
                    
                        <td>
                            <a href="{{ URL::to('/list-image/' . $item->product_id) }}" class="active" ui-toggle-class=""><i class="fas fa-cog"></i></a>
                            <!-- <a href="{{ URL::to('/delete-user/' . $item->product_id) }}"><i class="fa fa-times text-danger text"></i></a> -->

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 10-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                  
                <span>{!! $view_img->render('vendor.pagination.name') !!}</span>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection