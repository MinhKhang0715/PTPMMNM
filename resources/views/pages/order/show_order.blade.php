@extends('layout')
@section('content')


    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
                  <li class="active">Giỏ Hàng</li>
                </ol>
            </div><!-- Breadcrumbs-->
            <?php 
                $customer_id = Session::get('customer_id');
                if($customer_id == NULL){ 
            ?>
            <div class="register-req">
                <p>Đăng ký hoặc Đăng Nhập để thanh toán và xem lịch sử mua hàng</p>
            </div><!--/register-req-->
            <?php
                 }else{ }
            ?>
            <div class="table-responsive cart_info">
                            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span style="color:red; font-size:30px; font-weight: bold;">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            
                            <td class="description">Ngày Đặt Hàng</td>
                            <td class="quantity">Tình Trạng</td>
                            
                           
                            <td class="status">Hủy</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($all_order as $key => $order) <!--Lấy giá trị của $content truyền vào $v_content -->
                        <tr>

                            <td class="cart_description">  <!-- ngày-->
                                <div >
                                    <h4><a href="{{URL::to('/view-order-customer/'.$order->order_id)}}">{{$order->created_at}}</a></h4>
                                </div>
                            </td>
                            <td class="cart_quantity">  <!-- Cập Nhật Số Lượng Sản Phẩm Giỏ Hàng bằng phương thức post-->
                                <div >
                                    <div >
                                    <?php
                                        if($order->order_status == 0){
                                    ?>
                                            <h5 style="color:green">Đang Chờ Xử Lý</h5>
                <!--icon ẩn sản phẩm , a href khi click dựa vào id trên DB thay đổi status = 0,$pro lấy giá trị id -->
                                    <?php

                                        }elseif($order->order_status == 1){

                                    ?>   
               
                                            <h5 style="color:blue">Đã Xong</h5>
                                    <?php
                                        }else{
                                    ?>
                                            <h5 style="color:red">Đơn hàng đã bị hủy bỏ</h5>
                                    <?php

                                    }

                                    ?>
                                    </div>
                                </div>
                            </td>
                            <!-- Xóa Sản phẩm giỏ hàng-->
                           
                            <td class="cart_delete">
                                 <?php
                                        if($order->order_status == 0){
                                    ?>
                                             <a class="cart_quantity_delete" href="{{URL::to('/delete-order-customer/'.$order->order_id)}}"><i class="fa fa-times"></i></a>
                <!--icon ẩn sản phẩm , a href khi click dựa vào id trên DB thay đổi status = 0,$pro lấy giá trị id -->
                                    <?php

                                        }elseif($order->order_status == 1){

                                    ?>   
               
                                            <h5 style="color:blue">Đã Xong</h5>
                                    <?php
                                        }else{
                                    ?>
                                            <h5 style="color:red">Đơn hàng đã bị hủy bỏ</h5>
                                    <?php

                                    }

                                    ?>
                               
                                
                            </td>
                        </tr>
                        @endforeach
                        

                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->





@endsection   