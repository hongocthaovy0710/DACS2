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


   <!-- Cart Page Start -->
   <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                    <?php

                      use Gloudemans\Shoppingcart\Facades\Cart;
                        use Illuminate\Support\Facades\Session;

                   $content = Cart::content();
                    
                    ?>
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($content as $v_content)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('public/uploads/product/' . $v_content->options->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $v_content->name }} </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ number_format($v_content->price) . ' ' . 'VND' }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                       
                                 <form action="{{ URL::to('/update-cart-quantity') }}" method="POST">
                                        @csrf
                                            <!-- <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>

                                            </button> -->
                                        </div>
                                        <input type="text"   class="form-control form-control-sm text-center border-0" name="cart_quantity" value="{{ $v_content->qty }}" >
                                        <input type="hidden" value="{{ $v_content->rowId }}" name="rowId_cart"
                                        class="form-control">
                                        <div class="input-group-btn">
                                            <!-- <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button> -->
                                        </div>
                                        <input type="submit" value="Cập nhật" name="update_qty"
                                                class="btn btn-default btn-sm">
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">
                                    <?php
                                        $subtotal = $v_content->price * $v_content->qty;
                                       
                                      echo number_format($subtotal) . ' ' . 'VND';
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                       
                                        <a class="cart_quantity_delete"
                                        href="{{ URL::to('/delete-to-cart/' . $v_content->rowId) }}">
                                        <i class="fa fa-times text-danger"></i></a>
                                    </button>
                                </td>
                            
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">áp dụng khuyến mãi</button>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Hóa đơn</h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Tổng:</h5>
                                    <p class="mb-0">{{ Cart::subtotal(0, ',', '.') . ' ' . 'VND' }}</p>
                                   
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
                                <p class="mb-0 pe-4">{{ Cart::subtotal(0, ',', '.') . ' ' . 'VND' }}</p>
                            </div>

                            <?php 
                            $customer_id = Session::get('customer_id');
                            $shipping_id = Session::get('shipping_id');
                            if ($customer_id != NULL&& $shipping_id == NULL) {
                            ?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Thanh toán</a>
                        <?php    
                            } elseif($customer_id != NULL && $shipping_id != NULL){
                            ?>

                        <a class="btn btn-default check_out" href="{{ URL::to('/payment') }}">
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Thanh toán</button>
                        </a>

                        
                        <?php
                            }else{
                        ?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Thanh toán</button>
                        </a>
                        <?php
                    
                            }
                        ?>


                      

                        

                            <!-- <a href="chackout.html">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">  Checkout</button>
                        </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->



@endsection