@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Sản Phẩm
            </header>
            <div class="panel-body">
                <!-- Thông báo thêm danh mục thành công -->
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">', $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <!--Tên Sản Phẩm -->
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        <!-- muốn gửi ảnh phải có enctype -->
                        {{ csrf_field() }}
                        <form role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" value="{{old('product_name')}}">
                                <span style="color: red">@error('product_name'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                <input type="number" name="product_price" class="form-control" id="exampleInputEmail1" value="{{old('product_price')}}">
                                <span style="color: red">@error('product_price'){{$message}}@enderror</span>
                            </div>
                            <!-- Hình Ảnh-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" value="{{old('product_image')}}">
                            </div>
                            <!-- Hình Ảnh-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số Lượng</label>
                                <input type="number" name="product_qty" class="form-control" id="exampleInputEmail1" value="{{old('product_qty')}}">
                                <span style="color: red">@error('product_qty'){{$message}}@enderror</span>
                            </div>
                            <!-- Mô tả sản phẩm-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="product_desc" placeholder="Mô tả Sản Phẩm" value="{{old('product_desc')}}"></textarea>
                                <span style="color: red">@error('product_desc'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="product_content" placeholder="Nội Dung Sản Phẩm" value="{{old('product_content')}}"></textarea>
                                <span style="color: red">@error('product_content'){{$message}}@enderror</span>
                            </div>
                            <!-- truyền category từ DB vào-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15" value="{{old('product_cate')}}">
                                    @foreach($cate_product as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- truyền brand từ DB vào-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu</label>
                                <select name="product_brand" class="form-control input-sm m-bot15" value="{{old('product_brand')}}">
                                    @foreach($brand_product as $key => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Hiển Thị trạng thái -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15" value="{{old('product_status')}}">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>

                        </form>
                </div>

            </div>
        </section>
    </div>
    @endsection