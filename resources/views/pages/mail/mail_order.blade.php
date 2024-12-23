<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <!-- Latest compiled and minified CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #4caf50;
            color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .header h4, .header h6 {
            margin: 5px 0;
        }
        .content {
            color: #333333;
            font-size: 16px;
        }
        .content h4 {
            color: #4caf50;
            text-transform: uppercase;
        }
        .content strong {
            color: #4caf50;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table th {
            background: #4caf50;
            color: #ffffff;
            text-align: center;
        }
        table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h4>FLOWERS SHOP</h4>
            <h6>Dịch vụ bán hàng - Vận chuyển - Chuyên nghiệp</h6>
        </div>
        <div class="content">
            <p>Chào bạn <strong>{{ $shipping_array['customer_name'] }}</strong>,</p>
            <p>Bạn vừa đặt hàng thành công với thông tin chi tiết sau:</p>
            <h4>Thông tin đơn hàng</h4>
            <p>Mã đơn hàng: <strong>{{ $code['order_code'] }}</strong></p>
            <p>Mã khuyến mãi áp dụng: <strong>{{ $code['coupon_code'] }}</strong></p>
            <p>Dịch vụ: <strong>Đặt hàng trực tuyến</strong></p>
            <h4>Thông tin người nhận</h4>
            <p>Email: {{ $shipping_array['shipping_email'] ?? 'không có' }}</p>
            <p>Họ và tên người nhận: {{ $shipping_array['shipping_name'] ?? 'không có' }}</p>
            <p>Địa chỉ nhận hàng: {{ $shipping_array['shipping_address'] ?? 'không có' }}</p>
            <p>Số điện thoại: {{ $shipping_array['shipping_phone'] ?? 'không có' }}</p>
            <p>Ghi chú đơn hàng: {{ $shipping_array['shipping_notes'] ?? 'không có' }}</p>
            <p>Hình thức thanh toán: <strong>{{ $shipping_array['shipping_method'] == 1 ? 'Chuyển khoản' : 'Thanh toán khi nhận hàng' }}</strong></p>
            <h4>Sản phẩm đã đặt</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Số lượng đặt</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart_array as $cart)
                        @php
                            $sub_total = $cart['product_qty'] * $cart['product_price'];
                            $total += $sub_total;
                        @endphp
                        <tr>
                            <td>{{ $cart['product_name'] }}</td>
                            <td>{{ number_format($cart['product_price'], 0, ',', '.') }} VNĐ</td>
                            <td>{{ $cart['product_qty'] }}</td>
                            <td>{{ number_format($sub_total, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" align="right"><strong>Tổng tiền thanh toán:</strong></td>
                        <td><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
