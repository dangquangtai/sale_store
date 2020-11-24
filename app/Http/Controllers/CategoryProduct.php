<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProduct extends Controller
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
    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product()
    {
        $this->AuthLogin();
        $all = DB::table('tbl_category_product')->get();
        $manager = view('admin.all_category_product')->with('all_category_product', $all);
        return view('admin_layout')->with('admin.all_category_product', $manager);
    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Unactive');
        return Redirect::to('/all-category-product');
    }

    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message', 'Active');
        return Redirect::to('/all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $all = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager = view('admin.edit_category_product')->with('edit_category_product', $all);
        return view('admin_layout')->with('admin.edit_category_product', $manager);
    }
    public function update_category_product($category_product_id, Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xoá danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    //show in homepage
    public function show_category_home($category_id)
    {
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $this_category = DB::table('tbl_category_product')->where('category_id', $category_id)->first()->category_id;
        $all = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->where('tbl_category_product.category_id', $category_id)->paginate(9);
        return view('pages.product.all_product')->with('category', $category_product)->with('brand', $brand_product)->with('product', $all)->with('this_category', $this_category);
    }
}
