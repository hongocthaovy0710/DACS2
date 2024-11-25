<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flower Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content=""/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet"> 
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/frontend/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div id="spinner"
            class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
  
        <!-- menu bar -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a
                                href="#" class="text-white">180 PCT Đà Nẵng</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                                class="text-white">nv@Example.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Hotline: 012 8643 439</small></a>                    
                    </div>
                </div>
            </div>

            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{ URL::to('/') }}" class="navbar-brand">
                        <h1 class="text-primary display-6">FLower</h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{ URL::to('/') }}" class="nav-item nav-link active">Trang chủ</a>
                            <a href="{{ URL::to('/shop') }}" class="nav-item nav-link ">Sản phẩm</a>                                                                             
                            <a href="{{ URL::to('/contact') }}" class="nav-item nav-link">Liên hệ</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <form action="{{URL::to('/tim-kiem')}}" method="POST">
                                @csrf
                           
                           
                             </form> 
                           
                                    <a href="{{ URL::to('/show-cart') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span
                                    class="cart position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" >
                                </span>
                            </a>
    
                                <?php
                                    use Illuminate\Support\Facades\Session;
                                  
                                        $customer_id = Session::get('customer_id');
                                        if ($customer_id != NULL) {
                                        ?>                                         
                                        <a href="{{ URL::to('/logout-checkout') }}" class="my-auto">
                                        <i class="fas fa-user fa-2x"></i> Đăng xuất
                                            </a>                                                                   
                                        <?php    
                                        } else {
                                        ?>                               
                                            <a href="{{ URL::to('/logout-checkout') }}" class="my-auto">
                                        <i class="fas fa-user fa-2x"></i> Đăng nhập
                                            </a>                                   
                                        <?php
                                        }
                                    ?>
                            
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- Menu bar -->


   
<main>
    <div>

        @yield('content')

    </div>

    </main>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <a href="#">
                            <h1 class="text-primary mb-0">Flower</h1>
                            <p class="text-secondary mb-0">cung cấp hoa tươi</p>
                        </a>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Khách Hàng</h4>
                        <p class="mb-4">Chúng tôi xin chân thành cảm ơn quý khách đã tin tưởng và ủng hộ dịch vụ của chúng tôi.</p>                      
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Dịch vụ khách hàng</h4>
                        <a class="btn-link" href="">Giao hàng miễn phí</a>
                        <a class="btn-link" href="">Chương trình khuyến mãi</a>
                        <a class="btn-link" href="">Tri ân khách hàng</a>
                        <a class="btn-link" href="">Điều Kiện</a>                      
                        <a class="btn-link" href="">Câu hỏi & giải đáp</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Tài Khoản</h4>
                        <a class="btn-link" href="">Bảo mật</a>
                        <a class="btn-link" href="">Chi tiết</a>
                        <a class="btn-link" href="">Shopping Cart</a>                      
                        <a class="btn-link" href="">Lịch Sử</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Liên Hệ Chúng Tôi</h4>
                        <p>Địa chỉ: 180 Phan Châu Trinh </p>
                        <p>Email: nv@gmail.com</p>
                        <p>Hotline: 012 8643 439</p>
                        
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- lướt lên  -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('public/frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/frontend/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('public/frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/logic.js') }}"></script>
</body>

</html>
