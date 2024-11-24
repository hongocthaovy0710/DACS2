@extends('layout')
@section('content')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

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
                                <img src="{{ asset('public/uploads/product/' . $v_content->options->image) }}"
                                    class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
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
                                <input type="text" class="form-control form-control-sm text-center border-0"
                                    name="cart_quantity" value="{{ $v_content->qty }}">
                                <input type="hidden" value="{{ $v_content->rowId }}" name="rowId_cart"
                                    class="form-control">
                                <div class="input-group-btn">
                                    <!-- <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                        <i class="fa fa-plus"></i>
                                                    </button> -->
                                </div>
                                <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
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
                            <button class="btn btn-md rounded-circle bg-light border mt-4">

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
    <form action="{{ url('/order-place') }}" method="POST">
        @csrf
        <div class="form-check text-start my-3">
            <input type="radio" class="form-check-input bg-primary border-0" id="Check-1" name="payment_option"
                value="2">
            <label class="form-check-label" for="Check-1">Thanh toán khi nhận hàng</label>
        </div>
        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
            <button type="submit" value="Đặt hàng" name="send_order_place"
                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Order</button>
        </div>
    </form>
    </div>
    </div>



    </div>
    </div>




@section('content')
