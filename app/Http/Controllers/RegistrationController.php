<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Login; // Model bảng tbl_admin hoặc model khác tuỳ bạn

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string',
            'admin_email' => 'required|email|unique:tbl_admin,admin_email',
            'admin_phone' => 'required|digits_between:10,15',
            'admin_password' => 'required|min:6',
            'admin_password_confirmation' => 'required|same:admin_password'
        ]);

        Login::create([
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_phone' => $request->admin_phone,
            'admin_password' => md5($request->admin_password)
        ]);

        return response()->json(['success' => true]);
    }
}