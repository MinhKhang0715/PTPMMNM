@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Sản Phẩm
            </header>
            <div class="panel-body">
                <!-- Thông báo thêm slider thành công -->
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">', $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <!--Tên slider -->
                <div class="position-center">
                    @foreach($edit_slider as $key => $slide)
                    <form role="form" action="{{URL::to('/update-slider/'.$slide->slider_id)}}" method="post" enctype="multipart/form-data">
                        <!-- muốn gửi ảnh phải có enctype -->
                        {{ csrf_field() }}
                        <form role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên slider</label>
                                <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" value="{{$slide->slider_name}}">
                            </div>
                            <!-- Hình Ảnh-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh slider</label>
                                <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1">
                                <img src="{{URL::to('public/uploads/slider/'.$slide->slider_image)}}" height="300" width="700">
                            </div>
                            <!-- Mô tả slider-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả slider</label>
                                <textarea style="resize: none" rows="5" class="form-control" name="slider_desc" id="exampleInputPassword1">{{$slide->slider_desc}}</textarea>
                            </div>

                            <!-- Hiển Thị trạng thái -->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="slider_status" class="form-control input-sm m-bot15">
                                    <option value="1">Ẩn</option>
                                    <option selected value="0">Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" name="edit_slider" class="btn btn-info">Cập Nhật slider</button>

                        </form>
                        @endforeach
                </div>

            </div>
        </section>
    </div>
    @endsection