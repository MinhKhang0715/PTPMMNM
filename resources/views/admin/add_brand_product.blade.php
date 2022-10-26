@extends('admin_layout')
@section('admin_content')      
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Thương Hiệu Sản Phẩm
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
                            <!--Tên Danh Mục -->
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{ csrf_field() }}
                                <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thư mục" >
                                </div>
                                <!-- Mô tả danh mục-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows="5" data-validation="length" data-validation-length="min3" data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả thương hiệu"></textarea>
                                </div>
                                <!-- Hiển Thị trạng thái -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiển thị</option>
                                     </select>
                                </div>

                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm Thương Hiệu</button>

                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection            