<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function save_cart(Request $request ){

         $productId = $request->productid_hidden;
         $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first( );

        // Cart::add('293ad', 'Product 1', 1, 9.99);
        // Cart::destroy();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = 1;
        $data['options']['image'] = $product_info->product_image;

        // Cart::add($data);
    //     // Cart::setGlobalTax(10);

       // return Redirect::to('/show-cart');
       return view('pages.cart.show_cart');
    }
}
