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
        
        // Lấy thông tin đơn hàng
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name', 'tbl_customers.customer_phone', 'tbl_shipping.shipping_name', 'tbl_shipping.shipping_address', 'tbl_shipping.shipping_phone', 'tbl_shipping.shipping_email', 'tbl_shipping.shipping_notes', 'tbl_payment.payment_method', 'tbl_order_details.*')
            ->where('tbl_order.order_id', $order_id)
            ->first();

        // Lấy chi tiết đơn hàng
        $order_details = DB::table('tbl_order_details')
            ->where('order_id', $order_id)
            ->get();

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order_by_id) {
            return redirect()->route('manager-order')->with('error', 'Đơn hàng không tồn tại');
        }

        // Trả về view với thông tin đơn hàng và chi tiết đơn hàng
        return view('admin.view_order')->with(['order_by_id' => $order_by_id, 'order_details' => $order_details]);
    }

    public function update_order(Request $request, $order_id){
        $order_status = $request->select_status; 
        DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => $order_status]);
        return Redirect::to('/manage-order');
    }

    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
    
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment(Request $request){
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get(); 
        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }

    public function logout_checkout(Request $request){
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        
        if($result){
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            Session::put('customer_email', $result->customer_email);
            Session::put('customer_phone', $result->customer_phone);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
        }



public function order_place(Request $request){
    // $content = Cart::content();
    // echo $content;
  
//--seo 
$data = array();
$data['payment_method'] = $request->payment_option;
$data['payment_status'] = 'Đang chờ xử lý';
$payment_id = DB::table('tbl_payment')->insertGetId($data);

//insert order
$order_data = array();
$order_data['customer_id'] = Session::get('customer_id');
$order_data['shipping_id'] = Session::get('shipping_id');
$order_data['payment_id'] = $payment_id;
$order_data['order_total'] = Cart::subtotal();
$order_data['order_status'] = '1';
$order_id = DB::table('tbl_order')->insertGetId($order_data);
$body_massage = 'mã đơn hàng  '.$order_id.'tổng tiền: '.$order_data['order_total']; 
 //insert order_details
$content = Cart::content();
foreach($content as $v_content){
    $order_d_data['order_id'] = $order_id;
    $order_d_data['product_id'] = $v_content->id;
    $order_d_data['product_name'] = $v_content->name;
    $order_d_data['product_price'] = $v_content->price;
    $order_d_data['product_sales_quantity'] = $v_content->qty;
    DB::table('tbl_order_details')->insert($order_d_data);
}




if($data['payment_method']==1){

    echo 'Thanh toán bằng hình thức chuyển khoản';

}else{     
    Cart::destroy();

    // gui email o
    $to_name = Session::get('customer_name');
    $to_email = Session::get('shipping_email');//send to this email
       
     
        $data = array("name"=>$body_massage,"body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
        
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

            $message->to($to_email)->subject('đơn hàng được gửi từ shop laravel');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail

        });
        echo 'Thanh toán khi nhận hàng';


    }
       
}


public function manage_order(){
    $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->select('tbl_order.*', 'tbl_customers.customer_name')
        ->orderby('tbl_order.order_id', 'desc')
        ->get();

    $manager_order = view('admin.manage_order')->with('all_order', $all_order);
    return view('admin_layout')->with('admin.manage_order', $manager_order);
}


}