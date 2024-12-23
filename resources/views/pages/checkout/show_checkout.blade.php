@extends('layout')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
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

<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Thông tin đơn hàng</h1>
   <form id="billingForm"  method="POST">
            @csrf
            <div class="row g-5">
                <!-- Thông tin gửi hàng -->
                <div class="col-md-10 col-lg-6 col-xl-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item">
                                <label class="form-label fw-bold my-3">Tên<sup>*</sup></label>
                                <input type="text" name="shipping_name" class="form-control shipping_name" 
                                       value="{{ Session::get('customer_name') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-item">
                        <label class="form-label fw-bold my-3">Địa chỉ <sup>*</sup></label>
                        <input type="text" name="shipping_address" class="form-control shipping_address" placeholder="Số nhà" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label fw-bold my-3">Số điện thoại<sup>*</sup></label>
                        <input type="tel" name="shipping_phone" class="form-control shipping_phone" 
                               value="{{ Session::get('customer_phone') }}" pattern="[0-11]*" required title="Please enter digits only">
                    </div>

                    <div class="form-item">
                        <label class="form-label fw-bold my-3">Email <sup>*</sup></label>
                        <input type="email" name="shipping_email" class="w-100 form-control border-1 py-3 mb-4 shipping_email" 
                               value="{{ Session::get('customer_email') }}" required>
                    </div>

                    <div class="form-item">
                        <textarea require name="shipping_notes" class="form-control shipping_notes" spellcheck="false" cols="30" rows="6" placeholder="Ghi chú"> </textarea>
                    </div>

                    @if(Session::get('fee'))
										<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else 
										<input type="hidden" name="order_fee" class="order_fee" value="10000">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif

                    <div class="form-item mb-3">
                        <label class="form-label fw-bold my-3">Chọn hình thức giao hàng</label>
                        <select name="shipping_method" class="form-select form-select-sm choose shipping_method">
                            <option value="0">Giao theo địa chỉ</option>
                            <option value="1">Nhận tại shop</option>
                        </select>
                    </div>

 
                    
            <!-- phí vaanj chuyển -->
                    <form>
                        @csrf
                        <div class="form-group mb-3">
                            <label for="city" class="form-label fw-bold ">Chọn thành phố</label>
                            <select name="city" id="city" class="form-select form-select-sm choose city ">
                                <option value="">-- Chọn tỉnh/thành phố --</option>
                                @foreach ($city as $key => $ci)
                                    <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="province" class="form-label fw-bold">Chọn quận/huyện</label>
                            <select name="province" id="province" class="form-select form-select-sm province choose">
                                <option value="">-- Chọn quận/huyện --</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="wards" class="form-label fw-bold">Chọn xã/phường</label>
                            <select name="wards" id="wards" class="form-select form-select-sm wards">
                                <option value="">-- Chọn xã/phường --</option>
                            </select>
                        </div>

                        <div class="text-center">
                        
                        <input type="submit" value="Tính phí vận chuyển" name="" class="btn border-secondary rounded-pill px-4 py-3 text-primary calculate_delivery">  
                    </div>
                    </form>


                </div>

                <!-- Thông tin giỏ hàng -->
                <div class="col-md-12 col-lg-6 col-xl-7">
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
                            <th scope="col"></th>
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
                           <td colspan="4"> <input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
                            class="btn rounded-pill px-4 py-3 text-primary"></td>
                            <td colspan="3"> <a href="{{url('/del-all-product')}}"
                               
                            class="btn rounded-pill px-4 py-3 text-primary">Xóa tất cả</a> </td>
                            </tr>


                           
                           
                         <tr>
                            <td colspan="5">

                            <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-7">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Hóa đơn</h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Tổng:</h5>
                                    <p class="mb-0">{{ number_format($total) . ' ' . 'VND' }}</p>
                                   
                                </div>

                                @if(Session::get('coupon'))
							
								
                            @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['coupon_condition'] == 1)
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Mã giảm:</h5>
                                <p class="mb-0">{{$cou['coupon_number']}} %</p>
                            </div>
                            <p>
									@php 
								$total_coupon = ($total*$cou['coupon_number'])/100;													
									@endphp
								</p>
							<p>
								@php 
									$total_after_coupon = $total-$total_coupon;
									@endphp
							</p>

                            @elseif($cou['coupon_condition'] == 2)
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Mã giảm:</h5>
                                <p class="mb-0">{{number_format($cou['coupon_number'], 0, ',', '.')}} k</p>
                                </div>
                                <p>
								@php 
									$total_coupon = $total - $cou['coupon_number'];														
								@endphp
								</p>
								@php 
								$total_after_coupon = $total_coupon;
								@endphp
                            @endif
                        @endforeach

                    @endif 

                                @if(Session::get('fee'))							
                                <div class="d-flex justify-content-between">
                       
                                    <h5 class="mb-0 me-4">Ship</h5>
                                    <div class="">
                                        <p class="mb-0"> {{number_format(Session::get('fee'),0,',','.')}} VND</p>
                                    </div>
                                    <?php
                                    
                                    $total_after_fee = $total + Session::get('fee') ; ?>
                                </div>
                                @endif 

                              

                                <p class="mb-0 text-end"></p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Thành tiền</h5>
                                @php 
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo number_format($total_after,0,',','.').' VND';
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo number_format($total_after,0,',','.').'VND';
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo number_format($total_after,0,',','.').' VND';
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo number_format($total_after,0,',','.').' VND';
											}

										@endphp
                                        
                            </div>

                       
                      

                        <!-- <a class="btn btn-default check_out" href="">
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Xác nhận đơn hàng</button>
                        </a> -->

   
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
                                
                                <form action="{{url('/check-coupon')}}" method="POST">
                                @csrf
                                <div class="mt-5">
                                <td colspan="2">
                                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" name="coupon" placeholder="Nhập mã giảm giá">
                                </td>
                                <td colspan="2">
                                <input type ="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary check_coupon" name="check_coupon" value="áp dụng khuyến mãi">
                                </td>
                                <td>
                                @if(Session::get('coupon'))
	                          	<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
								@endif
                                </td>
                            </div>
                            </form>

                               
                            </tr>
                       
                    </table>
                    </div>

                   
                  
                </div>
            </div>
            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
          <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary send_order">
                        
                    </div>
        </form>
        
        
          <!-- Nút đặt hàng -->
        
                  
    </div>
</div>
@endsection
