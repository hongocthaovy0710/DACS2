@extends('layout')
@section('content')
   
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
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
                            <input type="search" class="form-control p-3" placeholder="loại hoa bạn thích" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                     
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Chủ đề:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform" onchange="navigateToPage()">
                            <!-- <option value="">Chọn chủ đề</option> -->
                            @foreach ($brand as $key => $brand)
                          
                                <option value="" >{{  $brand->brand_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    
                        <script>
                            function navigateToPage() {
                                const select = document.getElementById('fruits');
                                const selectedValue = select.value;
                                if (selectedValue) {
                                    window.location.href = selectedValue;
                                }
                            }
                        </script>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                           
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Chủ đề</h4>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="shop.html" onclick="navigateToPage(this)">
                                        <label for="Categories-1">Hoa sinh nhật</label>
                                    </div>
                                  



                                    <script>
                                        function navigateToPage(radio) {
                                            if (radio.checked) {
                                                var url = radio.value;
                                                window.location.href = url;
                                            }
                                        }
                                    </script>


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

                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                        @foreach ($all_product as $key=>$product)
                        <!-- <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}"> -->
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                       
                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}"><img src="{{asset ('public/uploads/product/'.$product->product_image) }}" class="img-fluid w-100 rounded-top" alt=""></a>
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Hoa sinh nhật</div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{ $product->product_name }}</h4>
                                        <p>{{ $product->product_content }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">{{number_format ((float)$product->product_price).' '.'VND' }}</p>
                                            <form action="{{ URL::to('/save-cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="productid_hidden" value="{{ $product->product_id }}">
                                                <input type="hidden" name="qty" value="1">
                                                <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ hàng
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      <!-- </a> -->
                      @endforeach
                            

                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="#" class="rounded">&laquo;</a>
                                    <a href="shop.html" class="active rounded">1</a>
                                   
                                    <a href="#" class="rounded">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Flowers Shop End-->

@endsection