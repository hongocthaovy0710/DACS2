@extends('layout')
@section('content')



  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

        @if(session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif



        <section id="auth-form" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Login Form -->
            <div class="col-md-5 shadow-lg p-4 bg-white rounded">
                <h2 class="text-center text-primary mb-4">Đăng nhập tài khoản</h2>
               
                <form action="{{ URL::to('/login-customer') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email_account" class="form-label">Tài khoản</label>
                        <input type="email" id="email_account" name="email_account" class="form-control" required placeholder="Nhập địa chỉ email" >
                    </div>
                    <div class="mb-3">
                        <label for="password_account" class="form-label">Mật khẩu</label>
                        <input type="password" id="password_account" name="password_account" class="form-control" required placeholder="Nhập mật khẩu" >
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" id="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
            </div>

            <!-- Separator -->
            <div class="col-md-1 d-flex align-items-center justify-content-center">
                <h2 class="text-secondary">Hoặc</h2>
            </div>

            <!-- Sign-Up Form -->
            <div class="col-md-5 shadow-lg p-4 bg-white rounded">
                <h2 class="text-center text-success mb-4">Tạo tài khoản mới</h2>
                <form action="{{ URL::to('/add-customer') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Họ và tên</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email</label>
                        <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_password" class="form-label">Mật khẩu</label>
                        <input type="password" id="customer_password" name="customer_password" class="form-control" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Số điện thoại</label>
                        <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Nhập số điện thoại" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</section>






@endsection