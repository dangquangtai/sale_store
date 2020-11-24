<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mail;


class HomeController extends Controller
{
    public function index()
    {

        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $all = DB::table('tbl_product')->where('product_status', 1)->orderBy('product_id', 'desc')->limit(6)->get();
        return view('pages.home')->with('category', $category_product)->with('brand', $brand_product)->with('product', $all);
    }

    public function product()
    {
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $all = DB::table('tbl_product')->where('product_status', 1)->orderBy('product_id', 'desc')->paginate(6);
        $this_category = 0;
        return view('pages.product.all_product')->with('category', $category_product)
            ->with('brand', $brand_product)->with('product', $all)->with('this_category', $this_category);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword_submit;
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $search_product = DB::table('tbl_product')->where('product_status', 1)->where('product_name', 'like', '%' . $keyword . '%')->get();
        return view('pages.product.search')->with('category', $category_product)
            ->with('brand', $brand_product)->with('search_product', $search_product);
    }
    // public function send_mail()
    // {
    //     $to_name = "to tan";
    //     $to_email = "lvtan.19it1@vku.udn.vn"; //send to this email

    //     $data = array("name" => "noi dung ten", "body" => "noi dung body"); //body of mail.blade.php
    //     Mail::send('admin.send_mail', $data, function ($message) use ($to_name, $to_email) {
    //         $message->to($to_email)->subject('Email tự động'); //send this mail with subject
    //         $message->from($to_email, $to_name); //send from this mail
    //     });
    //     return Redirect::to('/trang-chu');
    // }
    public function update_page(Request $request)
    {
        $out = '';
        $number_page = $request->numberpage;

        $display = DB::table('tbl_product')->where('product_status', 1)->orderBy('product_id', 'desc')->paginate($number_page);
        foreach ($display as $item) {
            $out .= '
       
               
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-new-arrival mb-50 text-center">
                        <div class="popular-img">
                            <img src="' . url('public/uploads/product/' . $item->product_image) . '"
                                alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a
                                    href="' . url('/chi-tiet-san-pham/' . $item->product_id) . '"> ' . $item->product_name . ' </a>
                            </h3>
                            <span>' . number_format($item->product_price) . ' VNĐ</span>
                        </div>
                    </div>
                </div>
              
         
  
        ';
        }
        echo $out;
    }
    public function search_price(Request $request)
    {
        $out = '';
        $price_from = (int)$request->from;
        $price_to = (int)$request->to;
        $number_page = $request->number_page;
        $prdt = DB::table('tbl_product') ->whereBetween('product_price', [$price_from, $price_to])->get();


        foreach ($prdt as $item) {
            $out .= '
               
                       
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-new-arrival mb-50 text-center">
                                <div class="popular-img">
                                    <img src="' . url('public/uploads/product/' . $item->product_image) . '"
                                        alt="">
                                </div>
                                <div class="popular-caption">
                                    <h3><a
                                            href="' . url('/chi-tiet-san-pham/' . $item->product_id) . '"> ' . $item->product_name . ' </a>
                                    </h3>
                                    <span>' . number_format($item->product_price) . ' VNĐ</span>
                                </div>
                            </div>
                        </div>
                      
                 
          
                ';
        }
        echo $out;
    }
   
}
