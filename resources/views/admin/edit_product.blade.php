@extends('admin_layout')
@section('admin_content')      
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhật Sản Phẩm
                        </header>
                        <div class="panel-body">
                            <!-- Thông báo thêm danh mục thành công -->
                            <?php 
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message.'</span>';
                                        Session::put('message',null);
                                    }
                            ?>
                            <!--Tên Sản Phẩm -->
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data"> <!-- muốn gửi ảnh phải có enctype -->
                                    {{ csrf_field() }}
                                <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                    <span style="color: red">@error('product_name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}} ">
                                    <span style="color: red">@error('product_price'){{$message}}@enderror</span>
                                </div>
                                <!-- Hình Ảnh-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1"  >
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="150" width="150">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số Lượng</label>
                                    <input type="text" name="product_qty" class="form-control" id="exampleInputEmail1" value="{{$pro->product_qty}} ">
                                    <span style="color: red">@error('product_qty'){{$message}}@enderror</span>
                                </div>
                                <!-- Mô tả sản phẩm-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1" >{{$pro->product_desc}}</textarea>
                                    <span style="color: red">@error('product_desc'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1" >{{$pro->product_content}}</textarea>
                                    <span style="color: red">@error('product_content'){{$message}}@enderror</span>
                                </div>
                                <!-- truyền category từ DB vào-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)

                                            @if($cate->category_id==$pro->category_id)
                                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                                <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                </div>
                                <!-- truyền brand từ DB vào-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương Hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                             @if($brand->brand_id==$pro->brand_id)
                                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>                                           
                                            @else
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                </div>
                                <!-- Hiển Thị trạng thái -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option selected value="0" >Hiển thị</option>
                                     </select>
                                </div>

                            <button type="submit" name="edit_product" class="btn btn-info">Cập Nhật Sản Phẩm</button>

                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>
            </div>
@endsection            