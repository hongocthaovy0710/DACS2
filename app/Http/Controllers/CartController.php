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

        Cart::add($data);
        Cart::setGlobalTax(10);

       return Redirect::to('/show-cart');
      // return view('pages.cart.show_cart');
    }

    
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function delete_to_cart($rowId){
        Cart::remove($rowId);
        return Redirect::to('/show-cart');
    }

    
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}
