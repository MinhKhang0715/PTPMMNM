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
                                    if($message){
                                        echo '<span class="text-alert">',$message.'</span>';
                                        Session::put('message',null);
                                    }
                            ?>
                            @foreach($edit_user as $key => $edit_value)
                            <!--Tên Sản Phẩm -->
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-users/'.$edit_value->admin_id)}}" method="post" enctype="multipart/form-data"> <!-- muốn gửi ảnh phải có enctype -->
                                    {{ csrf_field() }}
                                <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên</label>
                                    <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Tên" value='{{ $edit_value->admin_name}}'>
                                    <span style="color: red">@error('admin_name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="Email" name="admin_email" class="form-control" id="exampleInputEmail1" value='{{ $edit_value->admin_email}}'>
                                    <span style="color: red">@error('admin_email'){{$message}}@enderror</span>
                                </div>
                                
                                <!-- Mô tả sản phẩm-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password mới</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="admin_password"  placeholder="Mô tả Sản Phẩm" ></textarea>
                                    <span style="color: red">@error('admin_password'){{$message}}@enderror</span>
                                </div>

                                 <!-- Mô tả sản phẩm-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="admin_phone"  placeholder="Mô tả Sản Phẩm" >{{ $edit_value->admin_phone}}</textarea>
                                    <span style="color: red">@error('admin_phone'){{$message}}@enderror</span>
                                </div>
                            @endforeach


                            <button type="submit" name="update_users" class="btn btn-info">Cập nhật</button>

                            </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection            