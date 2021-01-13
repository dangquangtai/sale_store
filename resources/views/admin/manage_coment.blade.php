@extends('admin_layout')
@section('admin_content')
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách người dùng
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-3 m-b-xs">
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
            <div class="col-sm-6">
             <form action="{{URL::to('admin-reply-coment')}}" method="post">
             @csrf
             <textarea name="reply_coment" id="reply_cmt" cols="30" rows="3" placeholder="Nhập" style="resize: none;"></textarea>
             <input name="id_coment" type="text" id="coment_id" value="0" hidden>
             <input  name="reply_for" type="text" id="reply_for" value="0" hidden >
               <button type="submit" class="rpl_btn btn" data-coment_id="0"  style="margin-bottom: 30px;">Gửi</button>
             </form>
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
                        <th>Tên người comment</th>
                        <th>Nội dung</th>
                        <th>Thời gian gửi</th>
                        <th>Chức năng</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_comment as $key => $item)

                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td><a href="{{URL::to('edit-user/'.$item->customer_id)}}">{{ $item->customer_name }}</a></td>
                        <td>{{ $item->coment }}</td>
                        <td>{{ $item->send_at }}</td>
                        <td>
                            <h6>Bình luận</h6>
                        </td>



                        <td>
                            <a href="#" class="reply_click" ui-toggle-class="" data-reply_for="{{ $item->customer_id }}" data-id_coment="{{ $item->id_coment }}"><i class="fas fa-comment-dots"></i></a>
                            <a href="{{ URL::to('/delete-coment/' . $item->id_coment) }}" ><i class="fa fa-times text-danger text"></i></a>
                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $item->product_id) }}" ><i class="fas fa-eye"></i></a>
                         
                        </td>
                    </tr>
                    @foreach ($list_reply_comment as $key => $itemm)
                    <?php

                    if ( $item->id_coment==$itemm->id_coment) {
                        echo '
                        <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td><a href="'.url('edit-user/'.$itemm->customer_id).'" > '.$itemm->customer_name.'</a> </td>
                        <td> '.$itemm->content_coment.' </td>
                        <td>  '.$itemm->send_time.'</td>
                        <td>
                            <h6>Trả lời bình luận</h6>
                        </td>



                        <td>
                            <a href="#" class="reply_click" ui-toggle-class="" data-reply_for="{{ $item->customer_id }}" data-id_coment="{{ $item->id_coment }}"><i class="fas fa-comment-dots"></i></a>
                            <a href="'.url('/delete-reply-coment/' . $itemm->id).'"><i class="fa fa-times text-danger text"></i></a>
                            <a href="'.url('/chi-tiet-san-pham/' . $item->product_id).'"><i class="fas fa-eye"></i></a>

                        </td>
                    </tr>
                        ';
                    }
                    ?>
                    @endforeach
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
                    <span>{!! $list_comment->render('vendor.pagination.name') !!}</span>

                </div>
            </div>
        </footer>
    </div>
</div>
<script>
       $(document).on('click', '.reply_click', function() {
        $('#reply_cmt').focus();
        var id_coment = $(this).data('id_coment');
        var rpl_for = $(this).data('reply_for');
        $("#coment_id").val(id_coment);
        $("#reply_for").val(rpl_for);
      
        
       });
</script>
@endsection