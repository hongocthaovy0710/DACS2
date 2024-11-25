@extends('layout')
@section('content')

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


<div class="container py-5"><!-- Đặt toàn bộ nội dung trong container -->
    <div class="features_items">
        <h2 class="title text-center mb-4">Kết quả tìm kiếm</h2>

        {{-- Hiển thị thông báo nếu không tìm thấy sản phẩm --}}
        @if(Session::has('timsanpham'))
            <p class="text-center text-danger">{{ Session::get('timsanpham') }}</p>
        @endif

        {{-- Vùng hiển thị sản phẩm --}}
        <div class="row g-4 justify-content-center">
            @if(!$search_product->isEmpty())
                @foreach ($search_product as $key => $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100 rounded">
                        <div class="position-relative">
                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                                <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}" 
                                     class="card-img-top rounded-top" alt="">
                            </a>
                            <div class="badge bg-secondary text-white position-absolute" 
                                 style="top: 10px; left: 10px; font-size: 0.9rem;">
                                Hoa sinh nhật
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title text-dark fw-bold">{{ $product->product_name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->product_content, 50) }}</p>
                            <p class="text-dark fs-5 fw-bold mb-0">{{ number_format($product->product_price) . ' VND' }}</p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <a class="btn border border-secondary rounded-pill px-3 text-primary"
                                                        onclick="addToCart(event)"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ hàng</a>
                           
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                {{-- Nếu không có sản phẩm nào, hiển thị thông báo --}}
                <p class="text-center">Không tìm thấy sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
            @endif
        </div>
    </div>
</div>

@endsection
