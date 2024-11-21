@extends('layout')
@section('content')

<div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                    
                            <div class="col-lg-6 ">
                                <div class="border rounded text-center ">
                                    <!-- <a href="#">
                                        <img src="{{ asset('/public/uploads/product/' . $value->product_image) }}" class="img-fluid rounded" alt="Image">
                                    </a> -->
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <!-- <h4 class="fw-bold mb-3">{{ $product->product_name }}</h4>
                                <p class="mb-3">Hoa sinh nhật</p>
                                <h5 class="fw-bold mb-3">{{ number_format($value->product_price,0,',','.') . 'VND' }}</h5> -->
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="mb-4">Sản phẩm bao gồm: <br> 
                                                - Cẩm chướng chùm hồng viên: 3 <br>
                                                - Cúc calimero hồng: 3 <br>
                                                - Hoa Sao tím: 1 <br>      
                                                - Pink OHara: 1         
                                </p>
                                <!-- <p class="mb-4">{{ $product->product_content }}</p> -->
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                            
                        
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                           
                            
                            <div class="col-lg-12">
                                <div class="offer">
                                    <h4>ƯU ĐÃI ĐẶC BIỆT</h4>
                                    <ul class="benefit">
                                    <li>Tặng banner hoặc thiệp (trị giá 20.000đ - 50.000đ) miễn phí</li>
                                    <li>Giảm tiếp 3% cho đơn hàng Bạn tạo ONLINE lần thứ 2, 5% cho đơn hàng Bạn tạo ONLINE lần thứ 6 và 10% cho đơn hàng Bạn tạo ONLINE lần thứ 12.</li>
                                    <li>Miễn phí giao khu vực nội thành (<a href="https://hoayeuthuong.com/CalcShippingCost.aspx?lang=vn" target="_blank"><strong>chi tiết</strong>)</a></li>
                                    <li>Giao gấp trong vòng 2 giờ</li>
                                    <li>Cam kết 100% hoàn lại tiền nếu Bạn không hài lòng</li>
                                    <li>Cam kết hoa tươi trên 3 ngày</li>
                                    </ul>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>


                
                <h1 class="fw-bold mb-0">Các sản phẩm khác</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="./anhHoaxunngoc/12490_romance.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Hoa sinh nhật</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Romance</h4>
                                <p>Romance 3 - Sắc tím lãng mạn, gửi gắm những tình cảm nồng nàn và sâu lắng đến người bạn yêu thương nhất cuộc đời</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">550.000</p>
                                    <a href="shop-detail2.html" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                      
                       
                       
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->
    


@endsection