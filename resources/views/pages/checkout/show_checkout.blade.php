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

    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Thông tin đơn hàng</h1>
            <form action="">


                <div class="row g-5">
                    <form id="billingForm" action="{{ URL::to('/save-checkout-customer') }}" method="POST">
                        @csrf
                        <div class="col-md-10 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item">
                                        <label class="form-label my-3">Tên<sup>*</sup></label>
                                        <input type="text" name="shipping_name" class="form-control" placeholder=""
                                            id="address" required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-item">
                                <label class="form-label my-3">Địa chỉ <sup>*</sup></label>
                                <input type="text" name="shipping_address" class="form-control" placeholder="số nhà"
                                    id="address" required>
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                                <input type="tel" name="shipping_phone" class="form-control" id="mobile"
                                    pattern="[0-9]*" required title="Please enter digits only">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email <sup>*</sup></label>
                                <input type="email" name="shipping_email" id="contactEmail"
                                    class="w-100 form-control border-1 py-3 mb-4" placeholder="" required>
                            </div>


                            <div class="form-item">
                                <textarea name="shipping_notes" class="form-control" spellcheck="false" cols="30" rows="11"
                                    placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- //tittle heading -->

                                    <?php
                                    
                                    use Gloudemans\Shoppingcart\Facades\Cart;
                                    
                                    $content = Cart::content();
                                    
                                    ?>
                                    @foreach ($content as $v_content)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ URL::to('public/uploads/product/' . $v_content->options->image) }}"
                                                        class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                        alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><a href="">{{ $v_content->name }}</a></td>
                                            <td class="py-5">{{ number_format($v_content->price) . ' ' . 'VNĐ' }}</td>

                                            <td class="py-5">{{ $v_content->qty }}</td>
                                            <td class="py-5">
                                                <?php
                                                $subtotal = $v_content->price * $v_content->qty;
                                                echo number_format($subtotal) . ' ' . 'VNĐ';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>



                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">{{ Cart::subtotal(0) . ' ' . 'VNĐ' }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <p class="text-start text-dark">Vui lòng chọn hình thức thanh toán</p>
                                    <form method="POST" action="{{ URL::to('/order-place') }}">
                                        @csrf
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1"
                                            name="payment_option" value="1">
                                        <label class="form-check-label" for="Transfer-1">Chuyển khoản</label>
                                </div>

                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Check-1"
                                        name="payment_option" value="2">
                                    <label class="form-check-label" for="Check-1">Thanh toán khi nhận hàng</label>
                                </div>
            </form>
        </div>
    </div>
    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
        <button type="submit" value="Đặt hàng" name="send_order_place"
            class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"> Order</button>
    </div>
    </div>
    </div>

    </form>

    </div>
    </div>

    <script>
        function validateForm(event) {
            event.preventDefault(); // Ngăn chặn hành vi gửi form mặc định

            let firstName = document.getElementById('firstName').value;
            let lastName = document.getElementById('lastName').value;
            let address = document.getElementById('address').value;
            let townCity = document.getElementById('townCity').value;
            let country = document.getElementById('country').value;
            let postcode = document.getElementById('postcode').value;
            let mobile = document.getElementById('mobile').value;
            let email = document.getElementById('contactEmail').value;

            if (firstName === "" || lastName === "" || address === "" || townCity === "" || country === "" || postcode ===
                "" || mobile === "" || email === "") {
                alert("Please fill in all required fields.");
                return false;
            }

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Nếu tất cả các kiểm tra đều hợp lệ, gửi form
            document.getElementById('billingForm').submit();
        }
    </script>


@section('content')
