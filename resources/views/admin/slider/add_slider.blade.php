@extends('admin_layout')
@section('admin_content')      
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Slider
                        </header>
                        <div class="panel-body">
                            <!-- Thông báo thêm slider thành công -->
                            <?php 
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message.'</span>';
                                        Session::put('message',null);
                                    }
                            ?>
                            <!--Tên Sản Phẩm -->
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data"> <!-- muốn gửi ảnh phải có enctype -->
                                    {{ csrf_field() }}
                                <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                    <span style="color: red">@error('slider_name'){{$message}}@enderror</span>
                                </div>
                                <!-- Hình Ảnh-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh Slider</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <!-- Mô tả sản phẩm-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả Slider</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="slider_desc"  placeholder="Mô tả Slider"></textarea>
                                    <span style="color: red">@error('slider_desc'){{$message}}@enderror</span>
                                </div>
                                <!-- Hiển Thị trạng thái -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="slider_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển thị</option>
                                     </select>
                                </div>

                            <button type="submit" name="add_slider" class="btn btn-info">Thêm Slider</button>

                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection            