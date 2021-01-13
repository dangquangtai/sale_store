<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;

class CartController extends Controller
{
    //
    public function save_cart(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')
            ->join('tbl_product_img', 'tbl_product_img.product_id', '=', 'tbl_product.product_id')->where('tbl_product_img.img_status', 1)->where('tbl_product.product_id',$product_id)->get();
        // $product_info = $get_product_info->first();
        $data['qty'] = $quantity;
        $data['weight'] = "123";
        foreach ($product_info as $item) {
            $data['id'] = $item->product_id;
            $data['name'] = $item->product_name;
            $data['price'] = $item->product_price;
            $data['options']['image'] = $item->product_image;
        }
        Cart::add($data);
        $count = Cart::content()->count();
        echo $count;

        // return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
        return view('pages.cart.cart');
    }

    public function cart_destroy()
    {
        Cart::destroy();
        return Redirect::to('/show-cart');
    }


    public function delete_to_cart($rowId)
    {
        Cart::remove($rowId);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->quantity;
        Cart::update($rowId, $qty); // Will update the quantity
        // return Redirect::to('/show-cart');


        $data['subtotal'] = Cart::total();
        return json_encode($data);
    }
    public function delete_cart_product(Request $request)
    {
        $load = '';
        $rowId = $request->rowId;
        Cart::remove($rowId);
        $count = Cart::content()->count();
        $toltal = Cart::subtotal();


        $load .= '
          
            <input type="hidden" id ="retotal" value=' . $toltal . '>
            <input type="hidden" id ="recount" value=' . $count . '>

';


        echo $load;
    }
}
