@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <?php
                    $message = Session('message');
                    if ($message) {
                        echo '<span class="text-alert">' . $message . '</span>';
                        Session('message', null);
                    }
                    ?>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh sản phẩm</th>
                            <th>Danh mục Hoa</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Hiển thị</th>
                            <th>Thời gian</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $pro)
                            <tr>
                                <td>{{ $pro->product_name }}</td>
                                <td>{{ $pro->product_price }}</td>
                                <td><img src="public/uploads/product/{{ $pro->product_image }}" height="100px" width="100px">
                                </td>
                                <td>{{ $pro->category_name }}</td>
                                <td>{{ $pro->brand_name }}</td>
                                <td><span class="text-ellipsis">
                                        <?php
                                        if ($pro->product_status == 0) {
                                            echo '<a href="' . asset('/unactive-product/' . $pro->product_id) . '"> <span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>';
                                        } else {
                                            echo '<a href="' . asset('/active-product/' . $pro->product_id) . '"><span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>';
                                        }
                                        ?>
                                    </span></td>

                                <td>
                                    <span class="text-ellipsis">
                                        {{ \Carbon\Carbon::parse($pro->created_at)->format('d/m/Y') }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ asset('/edit-product/' . $pro->product_id) }}" class="active styling-edit"
                                        ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                        href="{{ asset('/delete-product/' . $pro->product_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
