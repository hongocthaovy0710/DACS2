<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Login;
use App\Models\Social;

class AdminController extends Controller
{

    
    public function login_facebook() {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function callback_facebook() {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
    
        if ($account) {
            // Đăng nhập vào trang quản trị
            $account_name = Login::where('admin_id', $account->user)->first();
            if ($account_name) {
                Session::put('admin_login', $account_name->admin_name);
                Session::put('admin_id', $account_name->admin_id);
                return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
            } else {
                return redirect('/admin')->with('message', 'Không tìm thấy tài khoản quản trị');
            }
        } else {
            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
    
            $orang = Login::where('admin_email', $provider->getEmail())->first();
    
            if (!$orang) {
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '', // Cung cấp giá trị cho cột 'admin_phone'
                    'admin_status' => 1
                ]);
            }
    
            $hieu->login()->associate($orang);
            $hieu->save();
    
            $account_name = Login::where('admin_id', $orang->admin_id)->first();
            if ($account_name) {
                Session::put('admin_login', $account_name->admin_name);
                Session::put('admin_id', $account_name->admin_id);
                return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
            } else {
                return redirect('/admin')->with('message', 'Không tìm thấy tài khoản quản trị');
            }
        }
    }
    public function index() {
        return view('admin_login');
    }

    public function show_dashboard() {
    //    $this->AuthLogin();
        return view('admin.dashboard');
    }
   
    public function dashboard(Request $request) {
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)->first();
    
            if($login){
                $login_count = $login->count();
                if($login_count>0){
                    Session::put('admin_name',$login->admin_name);
                    Session::put('admin_id',$login->admin_id);
                    return Redirect::to('/dashboard');
                }
            }else{
                    Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                    return Redirect::to('/admin');
            }
           
    
        }

    /*
$admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return view('admin.dashboard');
        } else {
            Session::put('message', 'mat khau hoac email khong dung, nhap lai nhe');
            return Redirect::to('/admin');
        }

    */

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