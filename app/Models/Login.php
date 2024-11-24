<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use HasFactory;

    protected $table = 'tbl_admin'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'admin_name', 'admin_email', 'admin_password', 'admin_phone'
    ];
}