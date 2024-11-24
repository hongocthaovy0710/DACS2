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
    
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function view_order($order_id){
       $this->AuthLogin();
       $order_by_id = DB::table('tbl_order')
       ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
       ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
       ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
       ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();

       $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
       return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
       

      
      
    
    }

    public function update_order(Request $request,$order_id){
        $order_status = $request->select_status; 
       DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>$order_status]);
       return Redirect::to('/manage-order');
     
   }
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

    public function payment(Request $request){
        //
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

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
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_email',$result->customer_email);
           
             Session::put('customer_phone',$result->customer_phone);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
        }



        public function order_place(Request $request){
    // Xử lý logic đặt hàng ở đây
    $data = array();
    $data['payment_method'] = $request->payment_option;
    $data['payment_status'] = 'Đang chờ xử lý';
    $payment_id = DB::table('tbl_payment')->insertGetId($data);

    // Insert order
    $order_data = array();
    $order_data['customer_id'] = Session::get('customer_id');
    $order_data['shipping_id'] = Session::get('shipping_id');
    $order_data['payment_id'] = $payment_id;
    $order_data['order_total'] = Cart::subtotal();
    $order_data['order_status'] = 'Đang chờ xử lý';
    $order_id = DB::table('tbl_order')->insertGetId($order_data);

    // Insert order details
    $content = Cart::content();
    foreach($content as $v_content){
        $order_d_data['order_id'] = $order_id;
        $order_d_data['product_id'] = $v_content->id;
        $order_d_data['product_name'] = $v_content->name;
        $order_d_data['product_price'] = $v_content->price;
        $order_d_data['product_sales_quantity'] = $v_content->qty;
        DB::table('tbl_order_details')->insert($order_d_data);
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    Cart::destroy();

    return redirect()->route('home')->with('message', 'Đặt hàng thành công');
}

public function manage_order(){
    // $this->AuthLogin();
    $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->select('tbl_order.*', 'tbl_customers.customer_name')
        ->orderby('tbl_order.order_id', 'desc')
        ->get();

    
    $manager_order = view('admin.manage_order')->with('all_order', $all_order);
    return view('admin_layout')->with('admin.manage_order', $manager_order);
}

}