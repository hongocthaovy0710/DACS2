<!DOCTYPE html>

<head>
    <title>ADMIN</title>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <!-- Link đến file CSS tùy chỉnh -->

    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>


    {{-- <script src="{{ asset('public/backend/ckeditor/ckeditor5/ckeditor5.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.form-validator.min.js') }}"></script>


    <script>
        $.validate({

        })
    </script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    {{-- <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li> --}}
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ 'public/backend/images/2.png' }}">
                            <span class="username">
                                <?php
                                
                                use Illuminate\Support\Facades\Session;
                                
                                $name = Session::get('admin_name');
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="{{ URL::to('/') }}"><i class=" fa fa-suitcase"></i>Trang Web</a></li>
                            {{-- <li><a href="#"><i class="fa fa-cog"></i> cài đặt</a></li> --}}
                            <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="index.html">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manager-order') }}">Quản lý đơn hàng
                                    </a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-category-product') }}">Thêm kiểu bó hoa</a></li>
                                <li><a href="{{ URL::to('/all-category-product') }}">Liệt kê sản phẩm
                                    </a></li>
                            </ul>
                        </li>



                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục hoa</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-brand-product') }}">Thêm loại hoa
                                    </a></li>
                                <li><a href="{{ URL::to('/all-brand-product') }}">Liệt kê hoa các loại</a></li>
                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/delivery') }}">Quản lý vận chuyển</a></li>



                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-product') }}">Thêm sản phẩm
                                    </a></li>
                                <li><a href="{{ URL::to('/all-product') }}">Liệt kê sản
                                        phẩm</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="login.html">
                                <i class="fa fa-user"></i>
                                <span>Đăng nhập</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->

            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">


                @yield('admin_content')


            </section>
            <!-- footer -->
            {{-- <div class="footer">
                <div class="wthree-copyright">
                    <p>ban quyen cua ai <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div> --}}
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
    <!-- morris JavaScript -->



    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>




    <!-- //calendar -->
    @yield('js-custom');


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/select-feeship') }}",
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    },
                    error: function(xhr) {
                        console.error('Failed to fetch delivery data:', xhr.responseText);
                        $('#load_delivery').html(
                            '<p class="text-danger">Failed to load delivery data</p>');
                    }
                });
            }

            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();

                // Add loading state
                $(this).addClass('updating');

                $.ajax({
                    url: "{{ url('/update-delivery') }}",
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.success) {
                            fetch_delivery();
                        } else {
                            alert('Update failed: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error('Update failed:', xhr.responseText);
                        alert('Failed to update delivery fee');
                    },
                    complete: function() {
                        $('.fee_feeship_edit').removeClass('updating');
                    }
                });
            });
        });


        $(document).ready(function() {

            $('.add_delivery').click(function() {

                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();

                // Kiểm tra dữ liệu trước khi gửi
                if (city == '' || province == '' || wards == '' || fee_ship == '') {
                    alert('Vui lòng điền đầy đủ thông tin.');
                    return;
                }

                $.ajax({
                    url: "{{ route('insert-delivery') }}",
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        wards: wards,
                        fee_ship: fee_ship,
                        _token: _token
                    },
                    success: function(data) {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else {
                            alert('Có lỗi xảy ra.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi AJAX:', error);
                        alert('Có lỗi xảy ra: ' + error);
                    }
                });

            });

            $('.choose').on('change', function() {
                var action = $(this).attr('id'); // city, province, hoặc wards
                var ma_id = $(this).val(); // Giá trị được chọn
                var _token = $('input[name="_token"]').val(); // CSRF token

                if (ma_id) {
                    $.ajax({
                        url: "{{ route('select-delivery') }}",
                        method: "POST",
                        data: {
                            action: action,
                            ma_id: ma_id,
                            _token: _token
                        },
                        success: function(data) {
                            if (action == 'city') {
                                $('#province').html(data); // Cập nhật quận/huyện
                                $('#wards').html(
                                    '<option value="">--Chọn xã phường--</option>'
                                ); // Reset xã/phường
                            } else if (action == 'province') {
                                $('#wards').html(data); // Cập nhật xã/phường
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Lỗi AJAX:', error);
                            alert('Có lỗi xảy ra: ' + error);
                        }
                    });
                } else {
                    alert('Vui lòng chọn một giá trị hợp lệ.');
                }
            });


        });
    </script>
</body>

</html>
