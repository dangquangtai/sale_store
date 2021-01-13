<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoEmail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
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
        // foreach($result as $item){
        //     $lock =$item->lock_customer;
        // }
        $lock = $result->lock_customer;
        if ($result && $lock != 1) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            Session::put('customer_email', $result->customer_email);
            return Redirect::to('/trang-chu');
        } elseif ($lock == 1) {
            Session::put('message', 'Tài khoản của bạn đã bị khoá!');
            return Redirect::to('/login-checkout');
        } else {
            Session::put('message', 'Tài khoản hoặc mật khẩu không đúng!');
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
            'customer_password' => 'required|max:30',
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

    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name')->orderBy('tbl_order.order_id', 'desc')->paginate(10);
        return view('admin.view_order')->with('all_order', $all_order);
    }
    public function edit_order($orderId)
    {
        $edit = DB::table('tbl_order')->where('order_id', $orderId)->get();
        return view('admin.edit_order')->with('edit', $edit);
    }
    public function delete_order($orderId)
    {
        DB::table('tbl_order')->where('order_id', $orderId)->delete();
        return Redirect::to('/manage-order');
    }
    public function update_order($orderId, Request $request)
    {
        $data['status'] = $request->status;

        DB::table('tbl_order')->where('order_id', $orderId)->update($data);
        if ($request->status == 'đang vận chuyển') {
            $sales = 0;
            $quantity = 0;
            $total_order = 0;
            $get_order =  DB::table('tbl_order')
                ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')->where('tbl_order.order_id', $orderId)->get();

            $count_prd = DB::table('tbl_order_details')->where('order_id', $orderId)->count();
            $quantity += $count_prd;
            $total_order = 1;

            foreach ($get_order as $item) {

                // $sales = $item->order_total;
                $sales = $item->product_price * $item->product_quantity;
                $get_date = $item->created_at;
            }
            $get_root_day = DB::table('tbl_statistical')->where('order_date', $get_date)->count();

            if ($get_root_day > 0) {
                $update_root = DB::table('tbl_statistical')->where('order_date', $get_date)->get();
                foreach ($update_root as $itemm) {
                    $root_sales = $itemm->sales;
                    $root_quantity = $itemm->quantity;
                    $root_total_order = $itemm->total_order;
                    $dataa['sales'] =   $root_sales + $sales;
                    $dataa['quantity'] =   $root_quantity + $quantity;
                    $dataa['total_order'] =   $root_total_order + $total_order;
                    DB::table('tbl_statistical')->where('order_date', $get_date)->update($dataa);
                }
            } else {
                $get_order =  DB::table('tbl_order')
                ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')->where('tbl_order.order_id', $orderId)->get();

                $count_prd = DB::table('tbl_order_details')->where('order_id', $orderId)->count();
                $quantity += $count_prd;
                $total_order = 1;

                foreach ($get_order as $item) {
                    $sales = $item->product_price * $item->product_quantity;
                    // $sales = $item->order_total;
                    $order_date = $item->created_at;
                }
                $dataa['sales'] =   $sales;
                $dataa['order_date'] =   $get_date;
                $dataa['quantity'] =   $count_prd;
                $dataa['total_order'] =   1;
           
                DB::table('tbl_statistical')->insert($dataa);
            }

            // return Redirect::to('/edit-order/' . $orderId);
              return Redirect::to('/send-mail/'.$orderId);
        }
        Session::put('message', 'Cập nhật thành công !');
        return Redirect::to('/edit-order/' . $orderId);
    }



    public function detail_order($orderId)
    {
        $this->AuthLogin();
        $order_id = DB::table('tbl_order')->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->where('tbl_order.order_id', $orderId)
            ->get();
        // echo "<pre>";
        // print_r($order_id);
        // echo "</pre>";
        // ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
        return view('admin.detail_order')->with('order_id', $order_id);
    }

    // public function mail_order($orderId)
    // {
    //     $customer_id = DB::table('tbl_order')->select('customer_id')->where('order_id', $orderId)->first();
    //     $customer_id = $customer_id->customer_id;

    //     $email = DB::table('tbl_customer')->select('customer_email')->where('customer_id', $customer_id)->first();
    //     $email = $email->customer_email;

    //     $order_id = DB::table('tbl_order')
    //         ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
    //         ->where('tbl_order.order_id', $orderId)
    //         ->get();

    //     Mail::to($email)->send(new DemoEmail($order_id));
    // $category_product = DB::table('tbl_category_product')->where('category_status', 1)->orderBy('category_id')->get();
    // $brand_product = DB::table('tbl_brand')->where('brand_status', 1)->orderBy('brand_id')->get();
    // return view('pages.checkout.handcash')->with('category', $category_product)
    //     ->with('brand', $brand_product);
    // return view('admin.send_mail')->with('demo', $order_id);
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
        $list_tinh = DB::table('tbl_tinhthanhpho')->orderBy('matp', 'ASC')->get();

        return view('pages.cart.get_shipping')->with('list_tinh', $list_tinh);
    }
    public function display_other(Request $request)
    {
        $object = $request->object;
        $out = '';
        if ($object == "city") {
            $select_provice = DB::table('tbl_quanhuyen')->where('matp', $request->matp)->orderBy('maqh', 'ASC')->get();
            $out .= '   <option value="">Chọn quận huyện</option>';
            foreach ($select_provice as $key => $item) {
                $out .= '<option value=" ' . $item->maqh . ' ">' . $item->name_province . '</option>';
            }
        } else {
            $select_ward = DB::table('tbl_xaphuongthitran')->where('maqh', $request->matp)->orderBy('xaid', 'ASC')->get();
            $out .= '<option value="">Xã/phường/thị trấn</option>';
            foreach ($select_ward as $key => $item) {
                $out .= '
           
            <option value=" ' . $item->xaid . ' ">' . $item->name_ward . '</option>
            ';
            }
        }
        echo $out;
    }


    // }
    public function info_shipping()
    {
        $customer_id = Session::get('customer_id');
        // $data['receive_name'] = $request->full_name;
        // $data['status'] = "chờ xác nhận";
        // $data['customer_id'] = $customer_id;
        // $data['order_phone']  = $request->phone;
        // $data['order_email']   = $request->email;
        // $data['adress']  = $request->addr;
        // $data['order_note']  = $request->message;
        // $data['order_total']  = Cart::subtotal();
        // $data['created_at'] = Carbon::now();
        // $content = Cart::content();
        // $count = Cart::content()->count();
        // DB::table('tbl_order')->insert($data);
        // $order = DB::table('tbl_order')->where('customer_id', $customer_id)->orderBy('order_id','DESC')->first();
        // $order_id = $order->order_id;
        // foreach ($content as $item) {
        //     $dataa['product_name'] = $item->name;
        //     $dataa['product_id'] = $item->id;
        //     $dataa['product_image'] = $item->options->image;
        //     $dataa['product_quantity'] = $item->qty;
        //     $dataa['product_price'] = $item->price;
        //     $dataa['order_id'] = $order_id;
        //     DB::table('tbl_order_details')->insert($dataa);
        // }
        // if ($count != 0) {
        //     Session::put('message', 'Đặt hàng thành công !');
        // } else {
        //     Session::put('message', '');
        // }

        // Cart::destroy();

        $list_order = DB::table('tbl_order')->where('customer_id', $customer_id)->orderBy('order_id', 'desc')->paginate(5);

        return view('pages.cart.shipping_detail')->with('list_order', $list_order);
    }
    public function save_shipping(Request $request)
    {
        $get_ward = DB::table('tbl_xaphuongthitran')->where('xaid', $request->ward)->get();
        $get_province = DB::table('tbl_quanhuyen')->where('maqh', $request->province)->get();
        $get_city = DB::table('tbl_tinhthanhpho')->where('matp', $request->city)->get();

        foreach ($get_ward as $item) {
            $ward = $item->name_ward;
        }
        foreach ($get_province as $item) {
            $province = $item->name_province;
        }
        foreach ($get_city as $item) {
            $city = $item->name_city;
        }
        $detail_addr  = $request->addr . '-' . $ward . '-' . $province . '-' . $city;

        $customer_id = Session::get('customer_id');
        $data['receive_name'] = $request->full_name;
        $data['status'] = "chờ xác nhận";
        $data['customer_id'] = $customer_id;
        $data['order_phone']  = $request->phone;
        $data['order_email']   = $request->email;
        $data['adress']  =  $detail_addr;
        $data['order_note']  = $request->message;
        $data['order_total']  = Cart::subtotal();
        $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $content = Cart::content();
        $count = Cart::content()->count();
        DB::table('tbl_order')->insert($data);
        $order = DB::table('tbl_order')->where('customer_id', $customer_id)->orderBy('order_id', 'DESC')->first();
        $order_id = $order->order_id;
        foreach ($content as $item) {
            $dataa['product_name'] = $item->name;
            $dataa['product_id'] = $item->id;
            $dataa['product_image'] = $item->options->image;
            $dataa['product_quantity'] = $item->qty;
            $dataa['product_price'] = $item->price;
            $dataa['order_id'] = $order_id;
            DB::table('tbl_order_details')->insert($dataa);
            $get_number = DB::table('tbl_product')->where('product_id', $item->id)->get();
            foreach ($get_number as $itemm) {
                $number = $itemm->number_product;
            }
            $final_number = $number -  $dataa['product_quantity'];
            DB::table('tbl_product')->where('product_id', $item->id)->update(['number_product' => $final_number]);
        }
        if ($count != 0) {
            Session::put('message', 'Đặt hàng thành công !');
        } else {
            Session::put('message', '');
        }

        Cart::destroy();
        Session::put('message', 'Đặt hàng thành công !');
        return back();
    }
    public function display_history(Request $request)
    {
        $out = '';
        $order_id = $request->order_id;
        $detail_history = DB::table('tbl_order_details')->where('order_id', $order_id)->get();

        foreach ($detail_history as $item) {
            $out .= '
      
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
               <th scope="row" style="vertical-align: inherit;font-family: arial, sans-serif;">' . $item->product_name . '</th>
                <td><img  style="max-width: 200px;" src=" ' . url('public/uploads/product/' . $item->product_image) . ' " alt=""></td>
                <td>' . $item->product_quantity . '</td>
                <td> ' . number_format($item->product_price) . ' VNĐ</td>
               
               
            </tr>
        </tbody>
        </table>
      
    
        
      
              ';
        }
        $out =$out.'
        <a class="btn btn_back" href="' . url('info-shipping') . '">Trở về</a>
        ';
        echo $out;
    }
    public function confirm_order($orderId)
    {
        DB::table('tbl_order')->where('order_id', $orderId)->update(['status' => 'đã nhận hàng']);
        Session::put('message', 'Đã cập nhật thông tin ! ');
        return back();
    }
    public function cancel_order($orderId)
    {
        DB::table('tbl_order')->where('order_id', $orderId)->update(['status' => 'huỷ đơn']);
        $return_number = DB::table('tbl_order_details')->where('order_id', $orderId)->get();
        foreach ($return_number as $item) {
            $get_number = $item->product_quantity;
            $get_id = $item->product_id;
            $first_number = DB::table('tbl_product')->where('product_id', $get_id)->get();
            foreach ($first_number as $itemm) {
                $fnumber = $itemm->number_product;
            }
            $final_number = $fnumber + $get_number;
            DB::table('tbl_product')->where('product_id', $get_id)->update(['number_product' => $final_number]);
        }

        Session::put('message', 'Đã cập nhật thông tin ! ');
        return back();
    }
    public function person_info(){
    $take_avt= DB::table('tbl_customer')->where('customer_id',Session::get('customer_id'))->get();
    return view('pages.checkout.personal_info')->with('avt',$take_avt);
    }
    public function update_profile(Request $request){
      $data['customer_name']=$request->name;
      $data['customer_email']=$request->email;
      $data['customer_phone']=$request->phone;
      $get_image = $request->file('avatar');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/avatar', $new_image);
            $data['customer_avt'] = $new_image;
        }
      DB::table('tbl_customer')->where('customer_id',Session::get('customer_id'))->update($data);
      return Redirect()->back()->with('message','Cập nhật thông tin thành công !');
    }
public function update_password(Request $request){
    if($request->pass == $request->cfpass){
        $data['customer_password']=md5($request->pass);
        DB::table('tbl_customer')->where('customer_id',Session::get('customer_id'))->update($data);
    }else{
        return Redirect()->back()->with('message','Thông tin mật khẩu không hợp lệ !');
    }
    return Redirect()->back()->with('message','Đổi thành công !');
   
   
}
    
}
