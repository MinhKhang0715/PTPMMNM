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


        @if(Session()->has('message'))
        {!!session()->get('message')!!}

        @endif

        <?php
        $customer_id = Session::get('customer_id');
        if ($customer_id == NULL) {
        ?>

            <div class="register-req">
                <p>Đăng ký hoặc Đăng Nhập để thanh toán và xem lịch sử mua hàng</p>
            </div>
        <?php
        } else {
        }
        ?>
        <div class="table-responsive cart_info">
            <form action="{{URL('/update-cart-ajax')}}" method="POST">
                @csrf
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Sản Phẩm</td>
                            <td class="description"></td>
                            <td class="description">Số Lượng Tồn</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số Lượng</td>
                            <td class="total">Tổng Tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Session::get('cart')==true)
                        <?php
                        $total = 0;
                        ?>
                        @foreach (Session::get('cart') as $key => $cart)

                        <?php
                        $subtotal = $cart['product_price'] * $cart['product_qty'];
                        $total += $subtotal;
                        ?>

                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                            </td>
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{$cart['product_name']}}</p>
                            </td>
                            <td class="cart_quantity">
                                <h4><a href=""></a></h4>
                                <p>{{$cart['product_quantity']}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <!-- Cập Nhật Số Lượng Sản Phẩm Giỏ Hàng bằng phương thức post-->
                                <div class="cart_quantity_button">

                                    {{ csrf_field() }}
                                    <input class="cart_quantity_" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">


                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{number_format($subtotal,0,',','.')}} VNĐ


                                </p>
                            </td>

                            <!-- Xóa Sản phẩm giỏ hàng-->
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url('/delete-product-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td><input type="submit" name="update_qty" value="Cập Nhật Giỏ Hàng" class="check_out btn btn-default btn-sm "></td>

                            <td><a class="btn btn-default check_out" href="{{url('/delete-all-product-ajax')}}">Hủy Giỏ Hàng</a></td>
                            <td>
                                <li>Tổng <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
                                <li>Thuế <span>{{number_format($total/10,0,',','.')}} VNĐ</span></li>
                                <li>Phí Vận Chuyển <span>Free</span></li>
                                <li>Thành Tiền <span>{{number_format($total+$total/10,0,',','.')}} VNĐ</span></li>
                            </td>

                        </tr>

                        @else
                        <tr>
                            <td colspan="5">
                                @php
                                echo 'Giỏ hàng của bạn đang rỗng , hãy mua sắm nào';
                                @endphp
                            </td>
                        </tr>
                        @endif




                    </tbody>
                </table>


            </form>


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



                        <?php
                        $customer_id = Session::get('customer_id');
                        if (($customer_id != NULL) && (Session::get('cart') == true)) {
                        ?>

                            <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                        <?php
                        } elseif (($customer_id == NULL) && (Session::get('cart') == true)) {
                        ?>

                            <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>

                        <?php
                        } elseif (($customer_id != NULL) && (Session::get('cart') == false)) {
                        ?>
                            <a class="btn btn-default check_out">Giỏ Hàng Rỗng Mà Bạn</a>
                        <?php
                        } elseif (($customer_id == NULL) && (Session::get('cart') == false)) {
                        ?>
                            <a class="btn btn-default check_out">Giỏ Hàng Rỗng Mà Bạn</a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->



@endsection