<!DOCTYPE html>

<?php use Illuminate\Support\Facades\Session; ?>

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
            <h2 id="formHeader" class="text-center">Đăng nhập</h2>
            <form id="loginForm" action="{{ URL::to('/admin-dashboard') }}" method="post" novalidate
                style="display:block;">
                {{ csrf_field() }}

                <!-- Email Input -->
                <div class="mb-3">
                    <input type="email" class="ggg form-control" name="admin_email" placeholder="Nhập email" required>
                    <div class="error-message text-danger"></div>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <input type="password" class="ggg form-control" name="admin_password" placeholder="Nhập password"
                        required>
                    <div class="error-message text-danger"></div>
                </div>

                <!-- Remember me Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Nhớ đăng nhập</label>
                </div>

                <!-- Forgot Password Link -->
                <h6><a href="#">Quên mật khẩu?</a></h6>

                <!-- Submit Button -->
                <input type="submit" value="Đăng Nhập" class="btn btn-primary w-100">
            </form>

            <!-- Register Form -->
            <form id="registerForm" style="display:none;">
                @csrf
                {{-- s> --}}
                <div class="mb-3">
                    <input type="text" class="form-control" name="admin_name" placeholder="Tên Admin" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="admin_email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="admin_phone" placeholder="Số điện thoại" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="admin_password" placeholder="Mật khẩu" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="admin_password_confirmation"
                        placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng ký</button>
            </form>

            <p class="text-center mt-3">
                <span id="formFooterText">Chưa có tài khoản?</span>
                <a href="javascript:void(0)" id="toggleForm">Tạo tài khoản</a>
            </p>


        </div>
    </div>
    <script>
        // document.getElementById('toggleForm').onclick = function() {
        //     const loginForm = document.getElementById('loginForm');
        //     const registerForm = document.getElementById('registerForm');
        //     const formHeader = document.getElementById('formHeader');

        //     if (loginForm.style.display === 'block') {
        //         loginForm.style.display = 'none';
        //         registerForm.style.display = 'block';
        //         formHeader.textContent = 'Đăng ký';
        //         this.textContent = 'Đăng nhập';
        //     } else {
        //         loginForm.style.display = 'block';
        //         registerForm.style.display = 'none';
        //         formHeader.textContent = 'Đăng nhập';
        //         this.textContent = 'Tạo tài khoản';
        //     }
        // };
        document.getElementById('toggleForm').onclick = function() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const formHeader = document.getElementById('formHeader');
            const formFooterText = document.getElementById('formFooterText');

            if (loginForm.style.display === 'block') {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                formHeader.textContent = 'Đăng ký';
                formFooterText.textContent = 'Đã có tài khoản?';
                this.textContent = 'Đăng nhập';
            } else {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                formHeader.textContent = 'Đăng nhập';
                formFooterText.textContent = 'Chưa có tài khoản?';
                this.textContent = 'Tạo tài khoản';
            }
        };


        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.querySelector('input[name="admin_email"]');
            const password = document.querySelector('input[name="admin_password"]');
            const emailError = email.nextElementSibling;
            const passwordError = password.nextElementSibling;

            emailError.textContent = '';
            passwordError.textContent = '';

            let isValid = true;

            if (email.value.trim() === '') {
                emailError.textContent = 'Bạn phải điền tên đăng nhập!';
                isValid = false;
            }

            if (password.value.trim() === '') {
                passwordError.textContent = 'Bạn phải điền mật khẩu!';
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            fetch('{{ URL::to('/admin-dashboard') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        admin_email: email.value,
                        admin_password: password.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        passwordError.textContent = data.message;
                    }
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                });
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            fetch('{{ route('register.ajax') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Đăng ký thành công!');
                        document.getElementById('toggleForm').click(); // Chuyển lại form đăng nhập
                    }
                });
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
