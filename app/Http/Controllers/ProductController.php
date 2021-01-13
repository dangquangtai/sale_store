<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
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
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->orderBy('tbl_product.product_id', 'desc')->paginate(6);
        return view('admin.all_product')->with('all_product', $all);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['number_product'] = $request->number_product;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        DB::table('tbl_product')->insert($data);
        $get_img = DB::table('tbl_product')->orderBy('product_id', 'DESC')->first();
        $id_prd = $get_img->product_id;

        $get_image = $request->file('product_image');
        if ($get_image) {
            foreach ($get_image as $imgs) {

                $prd_imgname = $imgs->getClientOriginalName();
                //   $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $prd_imgname));
                $new_image = $name_image . rand(0, 99) . '.' . $imgs->getClientOriginalExtension();
                $imgs->move('public/uploads/product', $new_image);
                $dataa['product_image'] = $new_image;
                $dataa['product_id'] = $id_prd;
                $dataa['img_status'] = '0';
                DB::table('tbl_product_img')->insert($dataa);
                //   print_r($new_image);

            }
            $t = DB::table('tbl_product_img')->orderBy('id_product_image', 'DESC')->get();

            $u = $t->first();
            $i = $u->id_product_image;
            echo $i;

            DB::table('tbl_product_img')->where('id_product_image', $i)->update(['img_status' => 1]);

            Session::put('message', 'Thêm sản phẩm thành công');
        } else {
            DB::table('tbl_product')->orderBy('product_id', 'DESC')->delete();
            Session::put('message', 'Ảnh phải có ít nhất 1 item');
        }





        return Redirect::to('/all-product');
    }


    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Unactived !');
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
        $all = DB::table('tbl_product')
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')
            ->where('tbl_product.product_id', $product_id)->where('tbl_product_img.img_status', 1)->get();
        return view('admin.edit_product')->with('product', $all)->with('category_product', $category_product)->with('brand_product', $brand_product);
    }
    public function update_product($product_id, Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['number_product'] = $request->number_product;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        // $get_image = $request->file('product_image');
        // if ($get_image) {
        //     $get_name_image = $get_image->getClientOriginalName();
        //     $name_image = current(explode('.', $get_name_image));
        //     $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        //     $get_image->move('public/uploads/product', $new_image);
        //     $data['product_image'] = $new_image;
        // }
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
        $product_img = DB::table('tbl_product_img')->where('product_id', $product_id)->get();
        foreach ($detail_product as $key => $value) {
            $category_id = $value->category_id;
            // echo $category_id;
        }
        // foreach($product_img as $item){
        //         print_r( $item->product_image);
        // }
        $customer_id = Session::get('customer_id');
        $ordered = 0;
        $get_product_id = DB::table('tbl_order')->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
        ->where('tbl_order.customer_id',$customer_id)->where('tbl_order.status','đã nhận hàng')->get();
        foreach ($get_product_id as $item) {
            if ($item->product_id == $product_id) {
                $ordered = $ordered + 1;
            }
        }
    
        $related_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('product_id', [$product_id])->get();
        return view('pages.product.product_detail')->with('category', $category_product)
            ->with('brand', $brand_product)->with('detail_product', $detail_product)->with('related_product', $related_product)
            ->with('get_product_img', $product_img)->with('ordered',$ordered);
    }
    public function view_product_image()
    {

        $view_prpduct_img = DB::table('tbl_product')->orderBy('tbl_product.product_id', 'DESC')->paginate(10);

        return view('admin.view_product_img')->with('view_img', $view_prpduct_img);
    }
    public function list_image($product_id)
    {
        $list_image =  DB::table('tbl_product_img')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_product_img.product_id')->where('tbl_product_img.product_id', $product_id)->get();
        foreach ($list_image as $item) {
            $name = $item->product_name;
        }
        return view('admin.list_image')->with('list_img', $list_image)->with('name', $name);
    }
    public function edit_image($id_product)
    {
        $edit_img = DB::table('tbl_product_img')->where('id_product_image', $id_product)->get();
        return view('admin.edit_image')->with('edit_img', $edit_img);
    }
    public function update_image($id_product, Request $request)
    {
        $data['img_status'] = $request->new_status;

        if ($data['img_status'] == 1) {
            $get_id = DB::table('tbl_product_img')->where('id_product_image', $id_product)->get();
            foreach ($get_id as $item) {
                $gett_id = $item->product_id;
            }


            DB::table('tbl_product_img')->where('product_id', $gett_id)->update(['img_status' => 0]);
        }

        $get_image = $request->file('update_image');



        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        DB::table('tbl_product_img')->where('id_product_image', $id_product)->update($data);

        Session::put('message', 'Cập nhật ảnh sản phẩm thành công');
        return Redirect::to('/list-image/' . $gett_id);
    }
    public function delete_image($id_product)
    {
        $a = DB::table('tbl_product_img')->where('id_product_image', $id_product)->get();
        foreach ($a as $item) {
            $product_id = $item->product_id;
        }
        DB::table('tbl_product_img')->where('id_product_image', $id_product)->delete();
        Session::put('message', 'Xoá ảnh sản phẩm thành công');
        return Redirect::to('/list-image/' . $product_id);
    }
    public function add_product_image()
    {
        $choose_product = DB::table('tbl_product')->orderBy('product_id', 'DESC')->get();
        return view('admin.add_product_image')->with('choose_product', $choose_product);
    }

    public function  save_add_product_image(Request $request)
    {
        $data['product_id'] = $request->create_name;
        $get_image = $request->file('create_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        $data['img_status'] = $request->create_status;
        if ($data['img_status'] == 1) {
            DB::table('tbl_product_img')->where('product_id', $data['product_id'])->update(['img_status' => 0]);
        }
        DB::table('tbl_product_img')->insert($data);
        Session::put('message', 'Thêm ảnh sản phẩm thành công');

        return Redirect::to('/add-product-image');
    }





    public function search_product(Request $request)
    {
        $search = $request->Search;
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $content_slider = DB::table('tbl_slider_content')->get();
        $all = DB::table('tbl_product')->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('product_name', 'like', '%' . $search . '%')->where('tbl_product_img.img_status', 1)->paginate(6)->appends($request->query());
        $this_category = 0;
        return view('pages.product.all_product')->with('category', $category_product)
            ->with('brand', $brand_product)->with('content_slider', $content_slider)->with('product', $all)->with('this_category', $this_category);

        // $search = DB::table('tbl_product')->join('tbl_product_img','tbl_product_img.product_id','=','tbl_product.product_id')->where('product_name', 'like', '%' . $search . '%')->where('tbl_product_img.img_status',1)->paginate(9);
        // return view('pages.product.search_product')->with('list_product', $search);
    }


    public function display_cate(Request $request)
    {
        $get_cate_id = $request->cate_id;

        $out = '';
        if ($get_cate_id == 0) {
            $content_slider = DB::table('tbl_slider_content')->get();
            $all = DB::table('tbl_product')->where('product_status', 1)
                ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->orderBy('tbl_product.product_id', 'desc')->get();

            foreach ($all as $item) {
                $out .= '
      <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
      <a href="' . url('/chi-tiet-san-pham/' . $item->product_id) . '">
          <div class="single-new-arrival mb-50 text-center">
              <div class="popular-img">
                  <img src="' . url('public/uploads/product/' . $item->product_image) . '" alt="">
              </div>
              <div class="popular-caption">
                  <h3><a href="' . url('/chi-tiet-san-pham/' . $item->product_id) . '">' . $item->product_name . ' </a></h3>
                  <span>' . number_format($item->product_price) . ' VNĐ</span>
              </div>
          </div>
      </a>

  </div>
  
      ';
            }
            $out = $out . '
    <div class="row justify-content-center">


  <span>' . $all->render('vendor.pagination.name') . '</span>


</div>
    ';
        } else {
            $all = DB::table('tbl_product')
                ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->where('tbl_product.category_id', $get_cate_id)->get();
            foreach ($all as $item) {
                $out .= '
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <a href="' . url('/chi-tiet-san-pham/' . $item->product_id) . '">
                <div class="single-new-arrival mb-50 text-center">
                    <div class="popular-img">
                        <img src="' . url('public/uploads/product/' . $item->product_image) . '" alt="">
                    </div>
                    <div class="popular-caption">
                        <h3><a href="' . url('/chi-tiet-san-pham/' . $item->product_id) . '"> ' . $item->product_name . ' </a></h3>
                        <span>' . number_format($item->product_price) . ' VNĐ</span>
                    </div>
                </div>
            </a>
      
        </div>
            ';
            }
        }
        echo $out;
    }
    public function search_admin_product(Request $request)
    {
        $this->AuthLogin();
        $search_admin_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')
            ->where('tbl_product_img.img_status', 1)
            ->where('product_status', 1)->where('product_name', 'like', '%' . $request->admin_product . '%')->paginate(6);
        return view('admin.all_product')
            ->with('all_product', $search_admin_product);
    }
}
