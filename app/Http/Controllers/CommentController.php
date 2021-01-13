<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class CommentController extends Controller
{
    public function AuthLogin()
    {
        $login = Auth::id();
        if ($login) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function manage_comment()
    {
        $this->AuthLogin();
        $list_comment = DB::table('tbl_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_coment.customer_id')->orderBy('tbl_coment.id_coment', 'desc')->paginate(5);
        $list_reply_comment = DB::table('tbl_reply_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_reply_coment.customer_id')->orderBy('tbl_reply_coment.id', 'desc')->get();
        //   $list_comment = DB::table('tbl_coment')->join('tbl_reply_coment','tbl_reply_coment.id_coment','=','tbl_coment.id_coment')
        //   ->join('tbl_customer','tbl_customer.customer_id','=','tbl_coment.customer_id')
        //   ->join('tbl_customer','tbl_customer.customer_id','=','tbl_reply_coment.customer_id')->paginate(5);
        return view('admin.manage_coment')->with('list_comment', $list_comment)->with('list_reply_comment', $list_reply_comment);
    }
    public function admin_reply_coment(Request $request)
    {
        $this->AuthLogin();
        $cus = DB::table('tbl_customer')->where('customer_name', 'admin')->count();

        if ($cus == 0) {
            $dataa['customer_name'] = 'admin';
            $dataa['customer_email'] = 'admin@gmail.com';
            $dataa['customer_password'] = md5('123456');
            $dataa['customer_phone'] = '0000000000';
            DB::table('tbl_customer')->insert($dataa);
            $get_idd = DB::table('tbl_customer')->select('customer_id')->where('customer_name', 'admin')->get();
            foreach ($get_idd as $item) {
                $a =  $item->customer_id;
            }
            $data['id_coment'] = $request->id_coment;
            $data['customer_id'] = $a;
            $data['reply_customer_id'] = $request->reply_for;
            $data['content_coment'] = $request->reply_coment;
            DB::table('tbl_reply_coment')->insert($data);
            Session::put('message', 'Đã trả lời bình luận !');
        } else {
            $get_id = DB::table('tbl_customer')->select('customer_id')->where('customer_name', 'admin')->get();
            foreach ($get_id as $item) {
                $b =  $item->customer_id;
            }
            $data['id_coment'] = $request->id_coment;
            $data['customer_id'] = $b;
            $data['reply_customer_id'] = $request->reply_for;
            $data['content_coment'] = $request->reply_coment;
            DB::table('tbl_reply_coment')->insert($data);
            Session::put('message', 'Đã trả lời bình luận !');
        }

        return Redirect()->back();
    }
    public function delete_comment($idComent)
    {
        DB::table('tbl_coment')->where('id_coment', $idComent)->delete();
        Session::put('message', 'Đã xoá bình luận !');
        return Redirect()->back();
    }
    public function delete_reply_comment($idrlpComent)
    {
        DB::table('tbl_reply_coment')->where('id', $idrlpComent)->delete();
        Session::put('message', 'Đã xoá bình luận !');
        return Redirect()->back();
    }

    public function send_coment(Request $request)
    {
        $output = '';

        $data['product_id'] = $request->product_id;
        $data['send_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $data['coment']  = $request->coment;
        $data['customer_id']  = $request->user_id;
        DB::table('tbl_coment')->insert($data);
        $loaddtb = DB::table('tbl_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_coment.customer_id')->where('tbl_coment.product_id', $request->product_id)->get();
        $loadrpl = DB::table('tbl_reply_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_reply_coment.customer_id')->get();
        foreach ($loaddtb as $item) {
            $output .= '
            <div class="review_item">
            <div class="media">
            <div class="d-flex">
                <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
            </div>
            <div class="media-body">
                <h4>' . $item->customer_name . '</h4>
                <h5>' . $item->send_at . '</h5>
                <a class="reply_btn" data-customer_id=' . $item->customer_id . ' data-id_coment=' . $item->id_coment . ' href="#">Reply</a>
                <i class="fas fa-trash-alt"></i>
            </div>
            </div>
            <p>
            ' . $item->coment . '
            </p>
            </div>
           
';
            foreach ($loadrpl as $itemm) {

                if ($itemm->id_coment == $item->id_coment) {
                    $id = $itemm->reply_customer_id;
                    $get_name = DB::table('tbl_customer')->where('customer_id', $id)->get();
                    foreach ($get_name as $ite) {
                        $name = $ite->customer_name;
                    }
                    $output  = $output . '<br>' . ' <div class="review_item reply">
        <div class="media">
        <div class="d-flex">
        <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
        </div>
        <div class="media-body">
        <h4>' . $itemm->customer_name . '</h4>
        <h5>' . $itemm->send_time . '</h5>
        <a class="reply_btn" data-customer_id=' . $itemm->customer_id . ' data-id_coment=' . $itemm->id_coment . ' href="#">Reply</a>
        </div>
        </div>
        <b style="font-size: 14px;">
        ' . "@" . $name . " " . $itemm->content_coment . '
        </b>
        
        </div> ';
                }
            }
        }

        echo $output;
    }
    public function load_coment(Request $request)
    {
        $load = '';
        $product_id = $request->product_id;
        $loaddtb = DB::table('tbl_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_coment.customer_id')->where('tbl_coment.product_id', $product_id)->get();
        $loadrpl = DB::table('tbl_reply_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_reply_coment.customer_id')->get();
        foreach ($loaddtb as $item) {
            $load .= '
            <div class="review_item">
            <div class="media">
            <div class="d-flex">
                <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
            </div>
            <div class="media-body">
                <h4>' . $item->customer_name . '</h4>
                <h5>' . $item->send_at . '</h5>
                <a class="reply_btn" data-customer_id=' . $item->customer_id . ' data-id_coment=' . $item->id_coment . '  href="#">Reply</a>
         
';
            if ($item->customer_id == Session::get('customer_id')) {
                $load = $load . '    <a href="#" class="delete_coment"> <i class="fas fa-trash-alt"></i></a>';
            }
            $load = $load . '
</div>
</div>
<p>
' . $item->coment . '
</p>
</div>
';
            foreach ($loadrpl as $itemm) {

                if ($itemm->id_coment == $item->id_coment) {

                    $id = $itemm->reply_customer_id;
                    $get_name = DB::table('tbl_customer')->where('customer_id', $id)->get();
                    foreach ($get_name as $ite) {
                        $name = $ite->customer_name;
                    }
                    $load  = $load . '<br>' . ' <div class="review_item reply">
        <div class="media">
        <div class="d-flex">
        <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
        </div>
        <div class="media-body">
        <h4>' . $itemm->customer_name . '</h4>
        <h5>' . $itemm->send_time . '</h5>
        <a class="reply_btn" data-customer_id=' . $itemm->customer_id . ' data-id_coment=' . $itemm->id_coment . '  href="#">Reply</a>
        ';
                    if ($itemm->customer_id == Session::get('customer_id')) {
                        $load = $load . '    <a href="#" class="delete_coment"> <i class="fas fa-trash-alt"></i></a>';
                    }
                    $load = $load . '
                    </div>
                    </div>
                    <b style="font-size: 14px;">
                  ' . "@" . $name . "&nbsp " . $itemm->content_coment . '
                    </b>
                    
                    </div>
';
                }
            }
        }

        echo $load;
    }

    public function reply_comment(Request $request)
    {
        $data = array();
        $out = '';
        $data['id_coment']  = $request->id_coment;
        $data['customer_id']  = Session::get('customer_id');
        $data['content_coment']  = $request->coment;
        $data['reply_customer_id']  = $request->id_cus;
        $data['send_time'] = Carbon::now('Asia/Ho_Chi_Minh');

        DB::table('tbl_reply_coment')->insert($data);
        $loaddtb = DB::table('tbl_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_coment.customer_id')->where('tbl_coment.product_id', $request->product_id)->get();
        $loadrpl = DB::table('tbl_reply_coment')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_reply_coment.customer_id')->get();
        foreach ($loaddtb as $item) {
            $out .= '
        <div class="review_item">
        <div class="media">
        <div class="d-flex">
            <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
        </div>
        <div class="media-body">
            <h4>' . $item->customer_name . '</h4>
            <h5>' . $item->send_at . '</h5>
            <a class="reply_btn" data-customer_id=' . $item->customer_id . ' data-id_coment=' . $item->id_coment . ' href="#">Reply</a>
          
       
       
';
            if ($item->customer_id == Session::get('customer_id')) {
                $out = $out . '    <a href="#" class="delete_coment"> <i class="fas fa-trash-alt"></i></a>';
            }
            $out = $out . '
</div>
</div>
<p>
' . $item->coment . '
</p>
</div>
';
            foreach ($loadrpl as $itemm) {

                if ($itemm->id_coment == $item->id_coment) {
                    $id = $itemm->reply_customer_id;
                    $get_name = DB::table('tbl_customer')->where('customer_id', $id)->get();
                    foreach ($get_name as $ite) {
                        $name = $ite->customer_name;
                    }
                    $out  = $out . '<br>' . ' <div class="review_item reply">
    <div class="media">
    <div class="d-flex">
    <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
    </div>
    <div class="media-body">
    <h4>' . $itemm->customer_name . '</h4>
    <h5>' . $itemm->send_time . '</h5>
    <a class="reply_btn" data-customer_id=' . $itemm->customer_id . ' data-id_coment=' . $itemm->id_coment . ' href="#">Reply</a>
    ';
    if ($itemm->customer_id == Session::get('customer_id')) {
        $out = $out . '    <a href="#" class="delete_coment"> <i class="fas fa-trash-alt"></i></a>';
    }
    $out = $out . '
    </div>
    </div>
    <b style="font-size: 14px;">
    ' . "@" . $name . " " . $itemm->content_coment . '
    </b>
    
    </div> 
';
                }
            }
        }

        echo $out;
    }
    public function save_rating(Request $request)
    {
        $out = '';
        $data['customer_id'] = Session::get('customer_id');
        $data['number_star'] = $request->rating;
        $data['review'] = $request->review;
        $data['product_id'] = $request->prd_id;
        DB::table('tbl_ratting')->insert($data);
        $get_rating =  DB::table('tbl_ratting')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_ratting.customer_id')->where('product_id', $request->prd_id)->orderBy('ratting_id', 'desc')->get();
        foreach ($get_rating as $item) {


            $out .= '
        <div class="review_item">
        <div class="media">
            <div class="d-flex">
                <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
            </div>
            <div class="media-body">
            <h4>' . $item->customer_name . '</h4>
            ' . $item->number_star . '
                <i class="fa fa-star"></i>
               
            </div>
        </div>
        <p>
           ' . $item->review . '
        </p>
    </div>
        ';
        }
        echo $out;
        // print_r( $data['review']);
    }
    public function load_rating(Request $request)
    {
        $out = '';
        $get_rating =  DB::table('tbl_ratting')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_ratting.customer_id')->where('product_id', $request->product_id)->orderBy('ratting_id', 'desc')->get();
        foreach ($get_rating as $item) {


            $out .= '
            <div class="review_item">
            <div class="media">
                <div class="d-flex">
                    <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
                </div>
                <div class="media-body">
                <h4>' . $item->customer_name . '</h4>
                ' . $item->number_star . '
                    <i class="fa fa-star"></i>
                   
                </div>
            </div>
            <p>
               ' . $item->review . '
            </p>
        </div>
            ';
        }
        echo $out;
        // print_r($request->product_id);
    }
}
