<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Login;
use App\Models\Product;

class AdminController extends Controller
{

    
   
    public function index() {
        return view('admin_login');
    }

    
    public function show_dashboard() {
        $this->AuthLogin();
        $bestSellingProducts = Product::withSum('orderDetails', 'product_sales_quantity')
            ->orderBy('order_details_sum_product_sales_quantity', 'desc')
            ->take(10)
            ->get();
            
        return view('admin.dashboard', compact('bestSellingProducts'));
    }
   
    public function dashboard(Request $request) {
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
    
        $login = Login::where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
    
            if ($login) {
                Session::put('admin_name', $login->admin_name);
                Session::put('admin_id', $login->admin_id);
                return response()->json(['success' => true, 'redirect' => url('/dashboard')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Mật khẩu hoặc tài khoản bị sai. Làm ơn nhập lại']);
            }
            
    }
    

   

    public function logout(){
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
}