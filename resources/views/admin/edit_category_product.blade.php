@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Danh Mục Sản Phẩm
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
                <!-- Gọi dữ liệu đổ vào $edit value-->
                @foreach($edit_category_product as $key => $edit_value)
                <div class="position-center">
                    <!-- khi chọn button cập nhật , form gửi Id tới hàm update -->
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                        {{ csrf_field() }}
                        <form role="form">
                            <!-- Gọi $edit value vào table -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" value='{{ $edit_value->category_name}}' name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thư mục" data-validation="length" data-validation-length="min3" data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự">
                            </div>
                            <!-- Mô tả danh mục-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1" data-validation="length" data-validation-length="min3" data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự ">{{ $edit_value->category_desc}}</textarea>
                            </div>


                            <button type="submit" name="update_category_product" class="btn btn-info">Cập Nhật Danh Mục</button>

                        </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endsection