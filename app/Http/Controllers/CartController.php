<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    //
    public function save_cart(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        $data['weight'] = "123";
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
        $load='';
        $rowId = $request->rowId;
        Cart::remove($rowId);
        $count = Cart::content()->count();
        $toltal = Cart::subtotal();
       

            $load .= '
          
            <input type="hidden" id ="retotal" value='.$toltal.'>
            <input type="hidden" id ="recount" value='.$count.'>

';
       
    
      echo $load;
     
    }
}
