@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <div class="panel-body">
                    {{-- @foreach ($edit_brand_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}"
                                method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{ $edit_value->brand_name }}" name="brand_product_name"
                                        class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="slug_brand_product" class="form-control"
                                        id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1"
                                        {{ $edit_value->brand_desc }}></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_keywords"
                                        id="exampleInputPassword1" placeholder="Từ khóa danh mục"></textarea>
                                </div>

                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh
                                    mục</button>
                            </form>
                        </div>
                    @endforeach --}}

                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_brand_product->brand_id) }}"
                            method="post" class="form-validate">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" value="{{ $edit_brand_product->brand_name }}"
                                    name="brand_product_name" required class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" name ="slug_brand_product"
                                    value="{{ $edit_brand_product->slug_brand_product }}" class="form-control"
                                    id="exampleInputEmail1" required placeholder="Số lượng">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1"
                                    {{ $edit_brand_product->brand_desc }}></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ khóa danh mục</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="brand_product_keywords"
                                    id="exampleInputPassword1" placeholder="Từ khóa danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="brand_product_status">Hiển thị</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15"
                                    id="brand_product_status">
                                    <option value="0" {{ $edit_brand_product->brand_status == 0 ? 'selected' : '' }}>Ẩn
                                    </option>
                                    <option value="1" {{ $edit_brand_product->brand_status == 1 ? 'selected' : '' }}>
                                        Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh
                                mục</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
