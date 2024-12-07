@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên người mua</th>
                            <th>Số điện thoại</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order_by_id)
                            <tr>
                                <td>{{ $order_by_id->customer_name }}</td>
                                <td>{{ $order_by_id->customer_phone }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2">Không có thông tin khách hàng</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên người nhận hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order_by_id)
                            <tr>
                                <td>{{ $order_by_id->shipping_name }}</td>
                                <td>{{ $order_by_id->shipping_address }}</td>
                                <td>{{ $order_by_id->shipping_phone }}</td>
                                <td>{{ $order_by_id->shipping_email }}</td>
                                <td>{{ $order_by_id->shipping_notes }}</td>
                                <td>
                                    @if ($order_by_id->payment_method == 1)
                                        Chuyển khoản
                                    @else
                                        Thanh toán khi nhận hàng
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6">Không có thông tin vận chuyển</td>
                            </tr>
                        @endif
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
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order_details)
                            @php
                                $i = 0;
                                $total = 0;
                            @endphp
                            @foreach ($order_details as $details)
                                @php
                                    $i++;
                                    $subtotal = $details->product_price * $details->product_sales_quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td><i>{{ $i }}</i></td>
                                    <td>{{ $details->product_name }}</td>
                                    <td>{{ $details->product_sales_quantity }}</td>
                                    <td>{{ number_format($details->product_price, 0, ',', '.') }}đ</td>
                                    <td>{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    Thanh toán: {{ number_format($total, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5">Không có thông tin đơn hàng</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
