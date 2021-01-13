<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoEmail;

class MailController extends Controller
{
  public function send_mail($orderId)
    {
        $customer_id = DB::table('tbl_order')->select('customer_id')->where('order_id', $orderId)->first();
        $customer_id = $customer_id->customer_id;

        $email = DB::table('tbl_customer')->select('customer_email')->where('customer_id', $customer_id)->first();
        $email = $email->customer_email;

        $order_id = DB::table('tbl_order')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->where('tbl_order.order_id', $orderId)
            ->get();

        Mail::to($email)->send(new DemoEmail($order_id));
        Session::put('message', 'Cập nhật thành công !');
        // return view('admin.send_mail')->with('demo', $order_id);  
        return Redirect()->back(); 
}
}