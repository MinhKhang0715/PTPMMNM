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
        $total = 0;
        ?>

        <?php
        $customer_id = Session::get('customer_id');
        if ($customer_id == NULL) {
        ?>
            <div class="register-req">
                <p>Đăng ký hoặc Đăng Nhập để thanh toán và xem lịch sử mua hàng</p>
            </div>
            <!--/register-req-->
        <?php
        } else {
        }
        ?>
        <div class="table-responsive cart_info">

            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="description">Sản Phẩm</td>
                        <td class="description">Tên Sản Phẩm</td>
                        <td class="quantity">Số Lượng</td>
                        <td class="total">Đơn Giá</td>
                        <td class="total">Tổng Tiền</td>

                        <td></td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $total = 0;
                    ?>
                    @foreach($order_d as $key => $order)
                    <!--Lấy giá trị của $content truyền vào $v_content -->
                    <?php
                    $subtotal = $order->product_price * $order->product_sales_quantity;
                    $total += $subtotal;
                    ?>
                    <tr>

                        <td class="cart_product">
                            <img src="{{asset('public/uploads/product/'.$order->product_image)}}" width="90" alt="{{$order->product_name}}" />
                        </td>
                        <td class="cart_description">
                            <!-- Cập Nhật Số Lượng Sản Phẩm Giỏ Hàng bằng phương thức post-->
                            <div>
                                <h4>{{$order->product_name}}</a></h4>
                            </div>
                        </td>
                        <td class="cart_quantity">
                            <h4>{{$order->product_sales_quantity}}</a></h4>
                        </td>

                        <td class="cart_total">
                            <p class="cart_total_price">

                                {{number_format($order->product_price).' VNĐ'}}

                            </p>
                        </td>

                        <td class="cart_total">
                            <p class="cart_total_price">

                                {{number_format($order->product_price*$order->product_sales_quantity).' VNĐ'}}
                            </p>
                        </td>

                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>


                        <li>Tổng <span>{{number_format($total).' VNĐ'}}</span></li>
                        <li>Thuế <span>{{number_format($total/10).' VNĐ'}}</span></li>
                        <li>Phí Vận Chuyển <span>Free</span></li>
                        <li>Thành Tiền <span>{{number_format($total+$total/10).' VNĐ'}}</span></li>
                    </ul>


                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->



@endsection