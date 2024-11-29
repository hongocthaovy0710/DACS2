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
        @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif

   <!-- Cart Page Start -->
   <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                <table class="table">
                <form action="{{url('/update-cart')}}" method="POST">
                @csrf
                    
                    
                        <thead>
                          <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
           @if(Session::get('cart')==true)

                @php
                $total =0;
                @endphp

                         @foreach(Session::get('cart') as $key => $cart)
                       
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('public/uploads/product/'.$cart['product_image']) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="{{ $cart['product_name'] }}">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $cart['product_name'] }} </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ number_format($cart['product_price']) . ' ' . 'VND' }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                       
                                 
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" data-session-id="{{ $cart['session_id'] }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 cart-qty" 
                                                name="cart_qty[{{$cart['session_id']}}]" 
                                                value="{{ $cart['product_qty'] }}" data-session-id="{{ $cart['session_id'] }}">
                                        <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border" data-session-id="{{ $cart['session_id'] }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        </div>
                                       
                                        
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">
                                    <?php
                                        $subtotal = $cart['product_price'] * $cart['product_qty'];
                                        $total += $subtotal;
                                       
                                      echo number_format($subtotal) . ' ' . 'VND';
                                        ?>
                                    </p>
                                </td>
                                <td>
                                <a class="btn btn-md rounded-circle bg-light border mt-4 cart_quantity_delete" 
                                        href="{{url('/del-product/'.$cart['session_id'])}}">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                </td>
                            
                            </tr>
                       @endforeach

                            <tr>
                           <td colspan="5"> <input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
                            class="btn rounded-pill px-4 py-3 text-primary"></td>
                            <td> <a href="{{url('/del-all-product')}}"
                               
                            class="btn rounded-pill px-4 py-3 text-primary">Xóa tất cả</a> </td>
                            </tr>
                           
                         <tr>
                            <td colspan="5">

                            <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Hóa đơn</h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Tổng:</h5>
                                    <p class="mb-0">{{ number_format($total) . ' ' . 'VND' }}</p>
                                   
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Ship</h5>
                                    <div class="">
                                        <p class="mb-0"> Free</p>
                                    </div>
                                </div>
                                <p class="mb-0 text-end"></p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Thành tiền</h5>
                                <p class="mb-0 pe-4">{{ number_format($total) . ' ' . 'VND' }}</p>
                            </div>

                       
                      

                        <a class="btn btn-default check_out" href="">
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Thanh toán</button>
                        </a>

   
                        </div>
                    </div>
                </div>
                </td>
                            </tr>
                            @else
                            <tr>
                            <td colspan="5"> <center>
                            @php
                           
                            echo 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào giỏ hàng';
                        
                            @endphp
                            </center>
                            </td>
                            </tr>
@endif
                        </tbody>
                        </form>
                        <tr>
                                <td >
                                <form action="{{url('/check-coupon')}}" method="POST">
                                @csrf
                                <div class="mt-5">
                                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" name="coupon" placeholder="Nhập mã giảm giá">
                                <input type ="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary check_coupon" name="check_coupon" value="áp dụng khuyến mãi">
                            </div>
                            </form>

                                </td>
                            </tr>
                    </table>
                  


                    
                </div>
               

            
                
            </div>
        </div>
        <!-- Cart Page End -->



@endsection