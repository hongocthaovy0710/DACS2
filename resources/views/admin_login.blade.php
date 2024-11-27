<!DOCTYPE html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/login.css') }}" rel='stylesheet' type='text/css' />
    <!-- Thêm file CSS riêng cho phần đăng nhập -->
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
</head>

<body class="login-body">

    <div class="slideshow">
        <img src="{{ asset('public/backend/images/pic1.jpg') }}" alt="Ảnh 1">
        <img src="{{ asset('public/backend/images/pic2.jpg') }}" alt="Ảnh 2">
        <img src="{{ asset('public/backend/images/pic3.jpg') }}" alt="Ảnh 3">
        <img src="{{ asset('public/backend/images/pic4.jpg') }}" alt="Ảnh 4">
        <img src="{{ asset('public/backend/images/pic5.jpg') }}" alt="Ảnh 5">
    </div>

    <!-- Khung đăng nhập -->
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng nhập</h2>
            <form id="loginForm" action="{{ URL::to('/admin-dashboard') }}" method="post" novalidate>
                {{ csrf_field() }}

                <!-- Email Input -->
                <div class="mb-3">
                    <input type="email" class="ggg form-control" name="admin_email" placeholder="Nhập email" required>
                    <div class="error-message text-danger"></div> <!-- Thông báo lỗi cho email -->
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <input type="password" class="ggg form-control" name="admin_password" placeholder="Nhập password"
                        required>
                    <div class="error-message text-danger"></div> <!-- Thông báo lỗi cho mật khẩu -->
                </div>

                <!-- Remember me Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Nhớ đăng nhập</label>
                </div>

                <!-- Forgot Password Link -->
                <h6><a href="#">Quên mật khẩu?</a></h6>

                <!-- Submit Button -->
                <input type="submit" value="Đăng Nhập" class="btn btn-primary">
            </form>


            <p>Chưa có tài khoản? <a href="registration.html">Tạo tài khoản</a></p>
        </div>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const email = document.querySelector('input[name="admin_email"]');
            const password = document.querySelector('input[name="admin_password"]');
            const emailError = email.nextElementSibling; // Vị trí div chứa lỗi cho email
            const passwordError = password.nextElementSibling; // Vị trí div chứa lỗi cho mật khẩu

            let isValid = true;

            // Xóa thông báo lỗi cũ
            emailError.textContent = '';
            passwordError.textContent = '';

            // Kiểm tra email
            if (email.value.trim() === '') {
                emailError.textContent = 'Bạn phải điền tên đăng nhập!';
                isValid = false;
            }

            // Kiểm tra mật khẩu
            if (password.value.trim() === '') {
                passwordError.textContent = 'Bạn phải điền mật khẩu!';
                isValid = false;
            }

            // Nếu không hợp lệ, chặn gửi form
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>


    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{ asset('public/backend/js/flot-chart/excanvas.min.js') }}">
    </script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
</body>

</html>
