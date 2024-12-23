
@extends('layout')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Flowers Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Shop hoa chúng tớ</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <form action="{{ URL::to('/tim-kiem') }}" method="POST">
                                    @csrf
                                    <div class="position-relative">
                                        <input name="search" 
                                            class="form-control border border-secondary py-3 px-4 rounded" 
                                            type="text" 
                                            placeholder="Search" 
                                            style="border-color: silver; width: 120%;">
                                        <button type="submit" 
                                                class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute text-white h-100 rounded" 
                                                style="top: 0; right: -20%;">
                                            <i class="fa fa-search" style="color: inherit;"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="flowers">Chủ đề:</label>
                                <select id="flowers" name="flowerlist" class="border-0 form-select-sm bg-light me-3" onchange="navigateToPage()">
                                    <option value="tab-all">All</option>
                                    @foreach ($brands_with_products as $brand)
                                        <option value="tab-{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Danh mục</h4>
                                        <ul class="nav nav-pills flex-column" id="categoryTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="tab-all-tab" data-bs-toggle="pill" href="#tab-all" role="tab" aria-controls="tab-all" aria-selected="true">All</a>
                                            </li>
                                            @foreach ($categories_with_products as $category)
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="tab-{{ $category->category_id }}-tab" data-bs-toggle="pill" href="#tab-{{ $category->category_id }}" role="tab" aria-controls="tab-{{ $category->category_id }}" aria-selected="false"  style="color: grey";>{{ $category->category_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Bài viết blog</h4>
                                        <div class="mb-2">
                                            <a href="https://shop.dalathasfarm.com/blog/4-cach-cam-hoa-dep-don-gian-cho-nguoi-moi-bat-dau/" target="_blank">4 Cách cắm hoa đơn giản cho người mới bắt đầu</a>
                                        </div>
                                        <div class="mb-2">
                                            <a href="https://caraluna.vn/hoa-tang-nguoi-yeu "target="_blank">12 Loài hoa tặng người yêu, bó hoa đẹp nhất & ý nghĩa nhất</a>
                                        </div>
                                        <div class="mb-2">
                                            <a href="https://litiflorist.com/blog/9-loai-hoa-tang-nguoi-yeu-ban-gai-dep-va-lang-man-nhat"target="_blank">Loại hoa tặng người yêu, bạn gái đẹp và lãng mạn nhất</a>
                                        </div>
                                        <div class="mb-2">
                                            <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/cac-loai-hoa-dep-va-y-nghia-danh-tang-me-nhan-ngay-8-3-1240141"target="_blank">Các loại hoa đẹp và ý nghĩa dành tặng mẹ nhân ngày 8/3</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- h tới sản phẩm ở shopp nek -->
                        <div class="col-lg-9 tab-content">
                            <div class="tab-content" id="categoryTabContent">
                                <div class="tab-pane fade show active" id="tab-all" role="tabpanel" aria-labelledby="tab-all-tab">
                                    <div class="row g-4 justify-content-center">
                                        @foreach ($all_product as $product)
                                            <div class="col-md-6 col-lg-6 col-xl-4">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                                                            <img src="{{ asset('public/uploads/product/' . $product->product_image) }}" class="img-fluid w-100 rounded-top" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{ $product->product_name }}</h4>
                                                        <p>{{ $product->product_content }}</p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">{{ number_format((float)$product->product_price) . ' ' . 'VND' }}</p>
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
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @foreach ($categories_with_products as $category)
                                    <div class="tab-pane fade" id="tab-{{ $category->category_id }}" role="tabpanel" aria-labelledby="tab-{{ $category->category_id }}-tab">
                                        <div class="row g-4 justify-content-center">
                                            @foreach ($all_product->where('category_id', $category->category_id) as $product)
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                                                                <img src="{{ asset('public/uploads/product/' . $product->product_image) }}" class="img-fluid w-100 rounded-top" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>{{ $product->product_name }}</h4>
                                                            <p>{{ $product->product_content }}</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">{{ number_format((float)$product->product_price) . ' ' . 'VND' }}</p>
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
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($brands_with_products as $brand)
                                    <div class="tab-pane fade" id="tab-{{ $brand->brand_id }}" role="tabpanel" aria-labelledby="tab-{{ $brand->brand_id }}-tab">
                                        <div class="row g-4 justify-content-center">
                                            @foreach ($all_product->where('brand_id', $brand->brand_id) as $product)
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                                                                <img src="{{ asset('public/uploads/product/' . $product->product_image) }}" class="img-fluid w-100 rounded-top" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>{{ $product->product_name }}</h4>
                                                            <p>{{ $product->product_content }}</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">{{ number_format((float)$product->product_price) . ' ' . 'VND' }}</p>
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
        </div>
    </div>

    <script>
        function navigateToPage() {
            var select = document.getElementById("flowers");
            var tabId = select.options[select.selectedIndex].value;

            // Ẩn tất cả các tab
            document.querySelectorAll('.tab-pane').forEach(function(tab) {
                tab.classList.remove('active', 'show');
            });

            // Hiển thị tab được chọn
            var selectedTab = document.getElementById(tabId);
            if (selectedTab) {
                selectedTab.classList.add('active', 'show');
            }
        }

        function navigateToCategory(radio) {
            if (radio.checked) {
                var categoryId = radio.value;
                window.location.href = "{{ url('/danh-muc-san-pham') }}/" + categoryId;
            }
        }
    </script>
@endsection