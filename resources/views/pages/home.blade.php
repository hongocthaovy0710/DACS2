@extends('layout')
@section('content')
    <!--  Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">Shop Flower</h4>
                    <h1 class="mb-5 display-3 text-primary"></h1>
                    <div class="position-relative mx-auto">
                       
                    <form action="{{URL::to('/tim-kiem')}}" method="POST">
                                @csrf
                    <input name="search" class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text"
                            placeholder="Search">
                        <button type="submit"
                            class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                            style="top: 0; right: 25%;">Tìm Kiếm</button>
                    </form>

                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('public/frontend/img/thiet-ke-shop-hoa.jpg') }}"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Shop</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('public/frontend/img/gt.png') }}" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Shop</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  End -->


    <!--  Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5> Ưu đãi miễn phí ship</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Thanh toán nhận hàng</h5>                          
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>chính sách ưu đãi</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5> Hỗ trợ 24/7</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->


    <!-- Fruits Shop Start danh mục sp-->
    <div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1> Sản phẩm mới</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="  nav nav-pills d-inline-flex text-center mb-5">
                        @foreach($categories->take(4) as $key => $cate)
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill {{ $key == 0 ? 'active' : '' }}" data-bs-toggle="pill"
                                    href="#tab-{{ $cate->category_id }}">
                                    <span class="text-dark" style="width: 130px;">{{$cate->category_name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            

            <!-- sản phẩm -->
            <div class="tab-content">
    @foreach($categories as $key => $cate)
        <div id="tab-{{ $cate->category_id }}" class="tab-pane fade show p-0 {{ $key == 0 ? 'active' : '' }}">
            <div class="row g-4">
                @foreach ($new_products_by_category[$cate->category_id] as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="rounded position-relative fruite-item">
                            <div class="fruite-img">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                                    <img src="{{ asset('public/uploads/product/' . $product->product_image) }}" class="img-fluid w-100 rounded-top" alt="" >
                                </a>
                            </div>

                            
                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                {{ $cate->category_name }}
                            </div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h4>{{ $product->product_name }}</h4>
                                <p>{{ $product->product_content }}</p>
                                <p class="text-dark fs-5 fw-bold mb-0">{{ number_format((float)$product->product_price) }} VND</p>
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{ $product->product_id }}" class="cart_product_id_{{ $product->product_id }}">
                                    <input type="hidden" value="{{ $product->product_name }}" class="cart_product_name_{{ $product->product_id }}">
                                    <input type="hidden" value="{{ $product->product_image }}" class="cart_product_image_{{ $product->product_id }}">
                                    <input type="hidden" value="{{ $product->product_price }}" class="cart_product_price_{{ $product->product_id }}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">
                                    <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-id_product="{{ $product->product_id }}" name="add-to-cart">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
                     
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">   
        <!-- <h1 class="mb-0"> chậu hoa </h1>         -->
            <div class="row g-4 justify-content-center">
            @foreach($flower_pots as $flower_pot)
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $flower_pot->product_id) }}">
                            <img src="{{ asset('public/uploads/product/' . $flower_pot->product_image) }}" class="img-fluid rounded-top w-100" alt="">
                        </a>
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">{{ $flower_pot->product_name }}</h5>
                                    <h3 class="mb-0">{{ number_format((float)$flower_pot->product_price) }} VND</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
                
            </div>
        </div>
    </div>
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Kệ hoa</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            @foreach($flower_stands as $flower_stand)
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                    <a href="{{ URL::to('/chi-tiet-san-pham/' . $flower_stand->product_id) }}">
                        <img src="{{ asset('public/uploads/product/' . $flower_stand->product_image) }}" class="img-fluid w-100 rounded-top" alt="">
                    </a>
                    </div>
                   
                    <div class="p-4 rounded-bottom">
                        <h4>{{ $flower_stand->product_name }}</h4>
                        <p>{{  $flower_stand->product_content }}</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">{{ number_format((float)$flower_stand->product_price) }} VND</p>
                            <form>
                        @csrf
                        <input type="hidden" value="{{ $product->product_id }}" class="cart_product_id_{{ $product->product_id }}">
                        <input type="hidden" value="{{ $product->product_name }}" class="cart_product_name_{{ $product->product_id }}">
                        <input type="hidden" value="{{ $product->product_image }}" class="cart_product_image_{{ $product->product_id }}">
                        <input type="hidden" value="{{ $product->product_price }}" class="cart_product_price_{{ $product->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">
                        <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-id_product="{{ $product->product_id }}" name="add-to-cart">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ hàng
                        </button>
                    </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
    <!-- Vesitable Shop End -->


    


    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Bestseller </h1>
                <p>Nếu bạn đang cần đặt hoa tặng sinh nhật người thân, bạn bè hay đối tác,hoa cưới nhưng vẫn chưa tìm được
                    một shop hoa ưng ý, thì FlowerCorner.vn là sự lựa chọn đáng tin cậy dành cho bạn.</p>
            </div>

            <div class="row g-4">
            @foreach($bestsellers as $bestseller)
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $bestseller->product_id) }}">
                                    <img src="{{ asset('public/uploads/product/' . $bestseller->product_image) }}" class="img-fluid rounded-circle w-100" alt="{{ $bestseller->product_name }}">
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $bestseller->product_id) }}" class="h5">{{ $bestseller->product_name }}</a>
                                <h4 class="mb-3">{{ number_format((float)$bestseller->product_price) }} VND</h4>
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{ $bestseller->product_id }}" class="cart_product_id_{{ $bestseller->product_id }}">
                                    <input type="hidden" value="{{ $bestseller->product_name }}" class="cart_product_name_{{ $bestseller->product_id }}">
                                    <input type="hidden" value="{{ $bestseller->product_image }}" class="cart_product_image_{{ $bestseller->product_id }}">
                                    <input type="hidden" value="{{ $bestseller->product_price }}" class="cart_product_price_{{ $bestseller->product_id }}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{ $bestseller->product_id }}">
                                    <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-id_product="{{ $bestseller->product_id }}" name="add-to-cart">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->


    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Khách hàng</h4>
                            <h1>1963</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Chất lượng dịch vụ</h4>
                            <h1>99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Chính chỉ</h4>
                            <h1>33</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Hàng có sẵn</h4>
                            <h1>789</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->
@endsection
