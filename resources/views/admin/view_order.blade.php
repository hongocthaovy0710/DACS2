@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <!-- Customer Information Section -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin đăng nhập
            </div>
            <div class="table-responsive">
                @if (Session::has('message'))
                    <span class="text-alert">{{ Session::get('message') }}</span>
                    @php Session::forget('message'); @endphp
                @endif
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>{{ $customer->customer_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    <!-- Shipping Information Section -->
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển hàng
            </div>
            <div class="table-responsive">
                @if (Session::has('message'))
                    <span class="text-alert">{{ Session::get('message') }}</span>
                    @php Session::forget('message'); @endphp
                @endif
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên người vận chuyển</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_email }}</td>
                            <td>{{ $shipping->shipping_notes }}</td>
                            <td>
                                @if ($shipping->shipping_method == 0)
                                    Chuyển khoản
                                @else
                                    Tiền mặt
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br><br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $details)
                            <tr>
                                <td>{{ $details->product->product_name }}</td>
                                <td>{{ $details->product_sales_quantity }}</td>
                                <td>{{ number_format($details->product_price, 0, ',', '.') }}đ</td>
                                <td>{{ number_format($details->product_price * $details->product_sales_quantity, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="text-align: right;">
                                Tổng cộng: {{ number_format($total_coupon, 0, ',', '.') }}đ
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ url('/print-order/' . $order_details[0]->order_code) }}" class="btn btn-primary">In đơn
                    hàng</a>
            </div>
        </div>
    </div>
@endsection
