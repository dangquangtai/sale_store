<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function AuthLogin()
    {
        $login = Session::get('admin_id');
        if ($login) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_product()
    {
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id')->get();
        return view('admin.add_product')->with('category_product',  $category_product)->with('brand_product',  $brand_product);
    }
    public function all_product()
    {
        $this->AuthLogin();
        $all = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderBy('product_id')->paginate(6);
        return view('admin.all_product')->with('all_product', $all);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        } else
            $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Unactive');
        return Redirect::to('/all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Active');
        return Redirect::to('/all-product');
    }
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $category_product = DB::table('tbl_category_product')->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id')->get();
        $all = DB::table('tbl_product')->where('product_id', $product_id)->get();
        return view('admin.edit_product')->with('product', $all)->with('category_product', $category_product)->with('brand_product', $brand_product);
    }
    public function update_product($product_id, Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xoásản phẩm thành công');
        return Redirect::to('/all-product');
    }

    //end admin page
    public function detail_product($product_id)
    {
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $detail_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('product_id', $product_id)->get();
        foreach ($detail_product as $key => $value) {
            $category_id = $value->category_id;
            // echo $category_id;
        }
        $related_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('product_id', [$product_id])->get();
        return view('pages.product.product_detail')->with('category', $category_product)
            ->with('brand', $brand_product)->with('detail_product', $detail_product)->with('related_product', $related_product);
    }

    public function send_coment(Request $request)
    {
        $output = '';

        $data['product_id'] = $request->product_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone']  = $request->phone;
        $data['send_at'] = Carbon::now();
        $data['coment']  = $request->coment;
        DB::table('tbl_coment')->insert($data);
        $loaddtb = DB::table('tbl_coment')->where('product_id', $request->product_id)->get();
        $loadrpl = DB::table('tbl_reply_coment')->get();
        foreach ($loaddtb as $item) {
            $output .= '
            <div class="review_item">
            <div class="media">
            <div class="d-flex">
                <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
            </div>
            <div class="media-body">
                <h4>' . $item->name . '</h4>
                <h5>' . $item->send_at . '</h5>
                <a class="reply_btn" data-id_coment=' . $item->id_coment . ' href="#">Reply</a>
              
            </div>
            </div>
            <p>
            ' . $item->coment . '
            </p>
            </div>
           
';
            foreach ($loadrpl as $itemm) {
               
    if($itemm->id_parent_coment == $item->id_coment)
    {
        $output  = $output . '<br>' . ' <div class="review_item reply">
        <div class="media">
        <div class="d-flex">
        <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
        </div>
        <div class="media-body">
        <h4>' . $itemm->name_coment . '</h4>
        <h5>' . $itemm->send_time . '</h5>
        <a class="reply_btn" data-id_coment=' . $itemm->id_parent_coment . ' href="#">Reply</a>
        </div>
        </div>
        <b style="font-size: 14px;">
        ' . $itemm->content_coment . '
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
        $loaddtb = DB::table('tbl_coment')->where('product_id', $request->product_id)->get();
        $loadrpl = DB::table('tbl_reply_coment')->get();
        foreach ($loaddtb as $item) {
            $load .= '
            <div class="review_item">
            <div class="media">
            <div class="d-flex">
                <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
            </div>
            <div class="media-body">
                <h4>' . $item->name . '</h4>
                <h5>' . $item->send_at . '</h5>
                <a class="reply_btn" data-id_coment=' . $item->id_coment . '  href="#">Reply</a>
              
            </div>
            </div>
            <p>
            ' . $item->coment . '
            </p>
            </div>
           
';
            foreach ($loadrpl as $itemm) {
               
    if($itemm->id_parent_coment == $item->id_coment)
    {
        $get_name = DB::table('tbl_coment')->where('id_coment',$itemm->id_parent_coment)->first();
        $parent_name = $get_name->name;
        $load  = $load . '<br>' . ' <div class="review_item reply">
        <div class="media">
        <div class="d-flex">
        <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
        </div>
        <div class="media-body">
        <h4>' . $itemm->name_coment . '</h4>
        <h5>' . $itemm->send_time . '</h5>
        <a class="reply_btn" data-id_coment=' . $itemm->id_parent_coment . '  href="#">Reply</a>
        </div>
        </div>
        <b style="font-size: 14px;">
      ' . $itemm->content_coment . '
        </b>
        
        </div> ';
       
    }
            }
        }
        
        echo $load;
    }

    public function reply_comment(Request $request)
    {
        $data = array();
        $out = '';
        $data['id_parent_coment']  = $request->id_coment;
        $data['name_coment'] = $request->name;
        $data['email_coment'] = $request->email;
        $data['phone_coment']  = $request->phone;
        $data['content_coment']  = $request->coment;
      
        $data['send_time'] = Carbon::now();
      
    DB::table('tbl_reply_coment')->insert($data);
    $loaddtb = DB::table('tbl_coment')->where('product_id', $request->product_id)->get();
    $loadrpl = DB::table('tbl_reply_coment')->get();
    foreach ($loaddtb as $item) {
        $out .= '
        <div class="review_item">
        <div class="media">
        <div class="d-flex">
            <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
        </div>
        <div class="media-body">
            <h4>' . $item->name . '</h4>
            <h5>' . $item->send_at . '</h5>
            <a class="reply_btn" data-id_coment=' . $item->id_coment . ' href="#">Reply</a>
          
        </div>
        </div>
        <p>
        ' . $item->coment . '
        </p>
        </div>
       
';
        foreach ($loadrpl as $itemm) {
           
if($itemm->id_parent_coment == $item->id_coment)
{
    $out  = $out . '<br>' . ' <div class="review_item reply">
    <div class="media">
    <div class="d-flex">
    <img src="' . url('public/frontend/assets/img/gallery/review-1.png') . '" alt="" />
    </div>
    <div class="media-body">
    <h4>' . $itemm->name_coment . '</h4>
    <h5>' . $itemm->send_time . '</h5>
    <a class="reply_btn" data-id_coment=' . $itemm->id_parent_coment . ' href="#">Reply</a>
    </div>
    </div>
    <b style="font-size: 14px;">
    ' . $itemm->content_coment . '
    </b>
    
    </div> ';
   
}
        }
    }
    
        echo $out  ;
    }
    public function search_product(Request $request)
    {
        $search = $request->Search;
        $search = DB::table('tbl_product')->where('product_name', 'like', '%' . $search . '%')->paginate(9);
        return view('pages.product.search_product')->with('list_product', $search);
    }
   
}
