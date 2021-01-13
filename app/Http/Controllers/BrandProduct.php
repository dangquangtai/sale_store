<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandProduct extends Controller
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
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        $this->AuthLogin();
        // $all = DB::table('tbl_brand')->get();
        $all = Brand::paginate(6);
        // $all = Brand::orderBy('brand_id','desc')->take(2)->get();
        $manager = view('admin.all_brand_product')->with('all_brand_product', $all);
        return view('admin_layout')->with('admin.all_brand_product', $manager);
    }

    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;
        // // echo '<pre>';
        // // print_r($data);
        // // echo '</pre>';
        // DB::table('tbl_brand')->insert($data);

        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message', 'Unactive');
        return Redirect::to('/all-brand-product');
    }

    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Active');
        return Redirect::to('/all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        // $all = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();
        $all = Brand::find($brand_product_id);
        $manager = view('admin.edit_brand_product')->with('edit_brand_product', $all);
        return view('admin_layout')->with('admin.edit_brand_product', $manager);
    }
    public function update_brand_product($brand_product_id, Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        DB::table('tbl_product')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xoá thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    //show in homepage
    public function show_brand_home($brand_id)
    {
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $this_category =0;
        $this_brand = DB::table('tbl_brand')->where('brand_status',1)->where('brand_id', $brand_id)->first()->brand_id;
        $all = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->join('tbl_product_img','tbl_product_img.product_id','=','tbl_product.product_id')
        ->where('tbl_product_img.img_status',1)
        ->where('tbl_brand.brand_id', $brand_id)->paginate(6);
        return view('pages.product.all_product')->with('category', $category_product)->with('brand', $brand_product)->with('product', $all)->with('this_brand', $this_brand)->with('this_category', $this_category);
   
    }
    public function search_brand(Request $request){
        $this->AuthLogin();
        $search_admin_product = DB::table('tbl_brand')
        ->where('brand_status', 1)->where('brand_name', 'like', '%' . $request->brand_name . '%')->paginate(6);
        return view('admin.all_brand_product')
           ->with('all_brand_product', $search_admin_product);
    }
    public function show_category_home($category_id)
    {
      
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $content_slider =DB::table('tbl_slider_content')->get();
        $this_category = DB::table('tbl_category_product')->where('category_id', $category_id)->first()->category_id;
       $this_brand =0;
        $all = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->join('tbl_product_img','tbl_product_img.product_id','=','tbl_product.product_id')->where('tbl_product_img.img_status',1)->where('tbl_category_product.category_id', $category_id)->paginate(6);
        return view('pages.product.all_product')->with('category', $category_product)->with('brand', $brand_product)->with('content_slider',$content_slider)->with('product', $all)->with('this_category', $this_category)->with('this_brand',$this_brand);
    }
 
}
