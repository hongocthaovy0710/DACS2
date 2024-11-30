<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function check_coupon(Request $request){
        $data = $request->all();
        print_r($data);
    }


            public function gio_hang(Request $request){
                $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product);
 
            }


    public function add_cart_ajax(Request $request) {
        $data = $request->all(); // Lấy tất cả dữ liệu từ request gửi đến
        $session_id = substr(md5(microtime()), rand(0, 26), 5); // Tạo session ID duy nhất
        $cart = Session::get('cart'); // Lấy giỏ hàng hiện tại từ session
    
        if ($cart == true) {
            $is_available = 0; // Biến kiểm tra sản phẩm đã tồn tại
    
            // Duyệt qua giỏ hàng để kiểm tra xem sản phẩm đã có chưa
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_available++; // Nếu sản phẩm đã có, tăng biến kiểm tra
                }
            }
    
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id'   => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id'   => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty'  => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart); // Cập nhật giỏ hàng trong session
            }
        } else {
            // Nếu giỏ hàng trống, khởi tạo giỏ hàng với sản phẩm đầu tiên
            $cart[] = array(
                'session_id'   => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id'   => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty'  => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
           
        }
        Session::put('cart', $cart); // Lưu giỏ hàng mới vào session
        Session::save(); // Lưu lại session
        return response()->json("Sản phẩm đã được thêm vào giỏ hàng thành công!");
    }


    public function delete_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }
    

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id']==$key ){

                        $cart[$session]['product_qty'] = $qty;
                             }

                }

            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }


    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            // Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }

    
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