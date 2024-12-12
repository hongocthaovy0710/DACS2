@extends('admin_layout')
@section('admin_content')
    <div class="container-fluid">
        <style type="text/css">
            p.title_thongke {
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }

            .chart-container {
                width: 100%;
                max-width: 400px;
                /* Giới hạn chiều rộng của biểu đồ */
                margin: auto;
            }

            .color-box {
                display: inline-block;
                width: 20px;
                height: 20px;
                margin-right: 10px;
            }

            .info-box {
                display: none;
                width: 100px;
                height: 100px;
                background-color: #f0f0f0;
                border: 1px solid #ccc;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                line-height: 100px;
                font-weight: bold;
            }
        </style>
        <div class="row">
            <div class="col-md-6">
                <p class="title_thongke">Thống kê sản phẩm bán chạy</p>
                <ul class="list-group">
                    @foreach ($bestSellingProducts as $index => $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="color-box"
                                style="background-color: {{ ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(100, 159, 64, 0.2)', 'rgba(200, 100, 64, 0.2)', 'rgba(100, 100, 255, 0.2)', 'rgba(200, 200, 100, 0.2)'][$index] }}">
                            </div>
                            {{ $product->product_name }}
                            <span
                                class="badge bg-primary rounded-pill">{{ $product->order_details_sum_product_sales_quantity }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="bestSellingProductsChart"></canvas>
                </div>
                <div id="infoBox" class="info-box"></div>
            </div>
        </div>
    </div>
@endsection

@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('bestSellingProductsChart').getContext('2d');
            var bestSellingProducts = @json($bestSellingProducts);
            var productNames = bestSellingProducts.map(product => product.product_name);
            var productSold = bestSellingProducts.map(product => product.order_details_sum_product_sales_quantity);

            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: productNames,
                    datasets: [{
                        label: 'Số lượng đã bán',
                        data: productSold,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(100, 159, 64, 0.2)',
                            'rgba(200, 100, 64, 0.2)',
                            'rgba(100, 100, 255, 0.2)',
                            'rgba(200, 200, 100, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(100, 159, 64, 1)',
                            'rgba(200, 100, 64, 1)',
                            'rgba(100, 100, 255, 1)',
                            'rgba(200, 200, 100, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed + ' sản phẩm';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    onClick: function(evt, elements) {
                        if (elements.length > 0) {
                            var index = elements[0].index;
                            var product = bestSellingProducts[index];
                            var infoBox = document.getElementById('infoBox');
                            infoBox.style.display = 'block';
                            infoBox.innerHTML = product.product_name + '<br>' + product
                                .order_details_sum_product_sales_quantity + ' sản phẩm';
                        }
                    }
                }
            });
        });
    </script>
@endsection
