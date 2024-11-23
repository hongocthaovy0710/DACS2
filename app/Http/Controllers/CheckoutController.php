<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class CheckoutController extends Controller
{
    
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        return view('Pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
        
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }

    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
   
    }

    public function logout_checkout(Request $request){
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }

public function order_place(Request $request){
    $data = array();
    $data['payment_option'] = $request->payment_option;
    $data['payment_status'] = 'Đang chờ xử lý';
   
    $payment_id = DB::table('tbl_payment')->insertGetId($data);

    $odata = array();
    $odata['customer_id'] = Session::get('customer_id');
    $odata['shipping_id'] = Session::get('shipping_id');
    $odata['payment_id'] = $payment_id;
    $odata['order_total'] = Cart::total();
    $odata['order_status'] = 'Đang chờ xử lý';
    $order_id = DB::table('tbl_order')->insertGetId($odata);

   
    $oddata = array();

    $contents = Cart::content();
    foreach($contents as $v_content){
        $oddata['order_id'] = $order_id;
        $oddata['product_id'] = $v_content->id;
        $oddata['product_name'] = $v_content->name;
        $oddata['product_price'] = $v_content->price;
        $oddata['product_sales_quantity'] = $v_content->qty;
        DB::table('tbl_order_details')->insert($oddata);
    }
    if($data['payment_option']==1){
        echo 'Thanh toán bằng thẻ ATM';
    }else{
        echo 'Thanh toán khi nhận hàng';
    }
   
    return Redirect::to('/payment');
}


}