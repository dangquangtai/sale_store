<?php

namespace App\Http\Controllers;

use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mail;




class HomeController extends Controller
{
    public function index()
    {

        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->limit(6)->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $content_slider = DB::table('tbl_slider_content')->get();
        $all = DB::table('tbl_product')->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')
            ->where('product_status', 1)->where('img_status', 1)->orderBy('tbl_product.product_id', 'desc')->limit(6)->get();

        return view('pages.home')->with('category', $category_product)->with('brand', $brand_product)->with('content_slider', $content_slider)->with('product', $all);
    }

    public function product()
    {
        $pages =1;
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $content_slider = DB::table('tbl_slider_content')->get();
        $all = DB::table('tbl_product')->where('product_status', 1)
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->orderBy('tbl_product.product_id', 'desc')->paginate(6);
        $this_category = 0;
        $this_brand = 0;
       
    //     $a = $all->currentPage();
    //     $name =Session::get('customer_name');
    //     return response()->cookie(
    //         $name, $a, 500
    //     );
    //     $value = cookie($name);
    //    print_r($value);
        return view('pages.product.all_product')->with('category', $category_product)
            ->with('brand', $brand_product)->with('content_slider', $content_slider)->with('product', $all)->with('this_category', $this_category)->with('this_brand', $this_brand);
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

    public function update_page(Request $request)
    {
        $out = '';
        $number_page = $request->numberpage;

        $display = DB::table('tbl_product')
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->where('tbl_product.product_status', 1)->orderBy('tbl_product.product_id', 'desc')->paginate($number_page);
        foreach ($display as $item) {
            $out .= '
       
               
                <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="' . url('public/uploads/product/' . $item->product_image) . '">
                    <div class="single-new-arrival mb-50 text-center">
                        <div class="popular-img">
                            <img src="' . url('public/uploads/product/' . $item->product_image) . '"
                                alt="">
                        </div>
                        <div class="popular-caption">
                            <h3><a
                                    href="' . url('chi-tiet-san-pham/' . $item->product_id) . '"> ' . $item->product_name . ' </a>
                            </h3>
                            <span>' . number_format($item->product_price) . ' VNĐ</span>
                        </div>
                    </div>
                    </a>
                </div>
              
         
  
        ';
        }
        echo $out;
    }
    public function search_price(Request $request)
    {
      
        $price_from = (int)($request->price_from * 1000);
        $price_to = (int)($request->price_to * 10000);
       
        $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
        $content_slider = DB::table('tbl_slider_content')->get();
        $this_category = 0;
        $all = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->whereBetween('tbl_product.product_price', [$price_from, $price_to])->paginate(6)->appends($request->query());
        return view('pages.product.all_product')->with('category', $category_product)->with('brand', $brand_product)->with('content_slider', $content_slider)->with('product', $all)->with('this_category', $this_category);
    }
}
