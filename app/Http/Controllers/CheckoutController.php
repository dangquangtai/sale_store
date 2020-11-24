<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Cart;
use Mail;
use App\Mail\DemoEmail;
use App\Mail\TestMail;


class CheckoutController extends Controller
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

    public function login_checkout()
    {
        if (Session::get('customer_id')) {
            return Redirect::to('/trang-chu');
        }
        return view('pages.checkout.login');
    }

    public function register_checkout()
    {
        if (Session::get('customer_id')) {
            return Redirect::to('/trang-chu');
        }
        return view('pages.checkout.register');
    }

    public function login_customer(Request $request)
    {
        $cutomer_email = $request->email_account;
        $customer_password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $cutomer_email)
            ->where('customer_password', $customer_password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            Session::put('customer_email', $result->customer_email);
            return Redirect::to('/trang-chu');
        } else {
            Session::put('message', 'Sai thong tin!');
            return Redirect::to('/login-checkout');
        }
    }
    public function add_customer(Request $request)
    {
        $this->validation($request);
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        DB::table('tbl_customer')->insert($data);
        return Redirect('/login-checkout');
    }

    public function validation($request)
    {
        return $this->validate($request, [
            'customer_name' => 'required|max:100',
            'customer_email' => 'email|max:100',
            'customer_phone' => 'required|digits:10',
            'customer_password' => 'required|max:255',
            'customer_repeat_password' => 'required|same:customer_password',
        ]);
    }

    public function logout_checkout()
    {
        Session::put('customer_id', null);
        Session::put('customer_name', null);
        Session::put('customer_email', null);
        Cart::destroy();
        return Redirect('/trang-chu');
    }


    //--------------------------------------------------------------

    //--------------------------------------------------------------

    // public function checkout()
    // {
    //     $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
    //     $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
    //     return view('pages.checkout.show_checkout')->with('category', $category_product)
    //         ->with('brand', $brand_product);
    // }
    // public function save_checkout_customer(Request $request)
    // {
    //     $data = array();
    //     $data['shipping_name'] = $request->shipping_name;
    //     $data['shipping_address'] = $request->shipping_address;
    //     $data['shipping_phone'] = $request->shipping_phone;
    //     $data['shipping_email'] = $request->shipping_email;
    //     $data['shipping_note'] = $request->shipping_note;
    //     $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
    //     Session::put('shipping_id', $shipping_id);
    //     return Redirect('/payment');
    // }
    // public function payment()
    // {
    //     $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
    //     $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
    //     return view('pages.checkout.payment')->with('category', $category_product)
    //         ->with('brand', $brand_product);
    // }
    // public function order_place(Request $request)
    // {
    //     $content = Cart::content();

    //     //payment
    //     $data = array();
    //     $data['payment_method'] = $request->payment_option;
    //     $data['payment_status'] = "Dang cho xu ly";
    //     $payment_id = DB::table('tbl_payment')->insertGetId($data);

    //     //order
    //     $order_data = array();
    //     $order_data['customer_id'] = Session::get('customer_id');
    //     $order_data['shipping_id'] = Session::get('shipping_id');
    //     $order_data['payment_id'] = $payment_id;
    //     $order_data['order_total'] = Cart::total();
    //     $order_data['order_status'] = "Dang cho xu ly";
    //     $order_id = DB::table('tbl_order')->insertGetId($order_data);

    //     //order details
    //     foreach ($content as $item) {
    //         $order_d_data = array();
    //         $order_d_data['order_id'] = $order_id;
    //         $order_d_data['product_id'] = $item->id;
    //         $order_d_data['product_name'] = $item->name;
    //         $order_d_data['product_price'] = $item->price;
    //         $order_d_data['product_sales_quantity'] = $item->qty;
    //         DB::table('tbl_order_details')->insertGetId($order_d_data);
    //     }
    //     // echo "<pre>";
    //     // print_r($content);
    //     // echo "</pre>";
    //     if ($data['payment_method'] == 2) {
    //         Cart::destroy();
    //         return Redirect::to("/mail-order/" . $order_id);
    //     } else if ($data['payment_method'] == 1) {
    //         echo "ATM";
    //     }
    // }

    // public function manage_order()
    // {
    //     $this->AuthLogin();
    //     $all_order = DB::table('tbl_order')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
    //         ->select('tbl_order.*', 'tbl_customer.customer_name')->get();
    //     return view('admin.manage_order')->with('all_order', $all_order);
    // }

    // public function view_order($orderId)
    // {
    //     $this->AuthLogin();
    //     $order_id = DB::table('tbl_order')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
    //         ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
    //         ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
    //         ->where('tbl_order.order_id', $orderId)
    //         ->get();
    //     // echo "<pre>";
    //     // print_r($order_id);
    //     // echo "</pre>";
    //     return view('admin.view_order')->with('order_id', $order_id);
    // }

    // public function mail_order($orderId)
    // {
    //     $customer_id = DB::table('tbl_order')->select('customer_id')->where('order_id', $orderId)->first();
    //     $customer_id = $customer_id->customer_id;

    //     $email = DB::table('tbl_customer')->select('customer_email')->where('customer_id', $customer_id)->first();
    //     $email = $email->customer_email;

    //     $order_id = DB::table('tbl_order')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
    //         ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
    //         ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
    //         ->where('tbl_order.order_id', $orderId)
    //         ->get();

    //     Mail::to($email)->send(new DemoEmail($order_id));
    //     $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
    //     $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
    //     return view('pages.checkout.handcash')->with('category', $category_product)
    //         ->with('brand', $brand_product);
    //     // return view('admin.send_mail')->with('demo', $order_id);
    // }  
    public function get_shipping()
    {
        //   $count=Cart::count();

        //    if($count>0){

        // echo '<pre>';
        // print_r($time);
        // echo '</pre>';
        // $name = Session::get('customer_name');
        // $id = Session::get('customer_id');
        // $list_order = DB::table('tbl_order')->where('customer_id', $id)->get();
        $list_tinh = DB::table('tbl_tinhthanhpho')->orderBy('matp','ASC')->get();     

        return view('pages.cart.get_shipping')->with('list_tinh', $list_tinh);
        
    }


    // }
    public function info_shipping(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $data['receive_name'] = $request->full_name;
        $data['customer_id'] = $customer_id;
        $data['order_phone']  = $request->phone;
        $data['order_email']   = $request->email;
        $data['adress']  = $request->addr;
        $data['order_note']  = $request->message;
        $data['order_total']  = Cart::subtotal();
        $data['created_at'] = Carbon::now();
        $content = Cart::content();
        $count = Cart::content()->count();
        DB::table('tbl_order')->insert($data);
        $order = DB::table('tbl_order')->where('customer_id', $customer_id)->orderBy('order_id','DESC')->first();
        $order_id = $order->order_id;
        foreach ($content as $item) {
            $dataa['product_name'] = $item->name;
            $dataa['product_id'] = $item->id;
            $dataa['product_image'] = $item->options->image;
            $dataa['product_quantity'] = $item->qty;
            $dataa['product_price'] = $item->price;
            $dataa['order_id'] = $order_id;
            DB::table('tbl_order_details')->insert($dataa);
        }
        if ($count != 0) {
            Session::put('message', 'Đặt hàng thành công !');
        } else {
            Session::put('message', '');
        }

        Cart::destroy();

        $list_order = DB::table('tbl_order')->where('customer_id', $customer_id)->get();
      
        return view('pages.cart.shipping_detail')->with('list_order', $list_order);
    }
    public function display_history(Request $request)
    {
        $out = '';
        $order_id = $request->order_id;
        $detail_history =DB::table('tbl_order_details')->where('order_id',$order_id)->get();
        
    foreach($detail_history as $item)
    {
        $out .='
      
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col"></th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá sản phẩm</th>
               
            </tr>
        </thead>
        <tbody>
            <tr> 
               <th scope="row">'.$item->product_name.'</th>
                <td><img  style="max-width: 200px;" src=" '. url('public/uploads/product/'.$item->product_image).' " alt=""></td>
                <td>'.$item->product_quantity.'</td>
                <td> '.number_format($item->product_price).' VNĐ</td>
               
               
            </tr>
        </tbody>
        </table>
      
        <a class="btn btn_back" href="'.url('get-shipping').'">Trở về</a>
        
      
              ';
    }
    echo $out;
    }
}
