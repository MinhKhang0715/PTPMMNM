@extends('layout')
@section('content')


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
				<li class="active">Thanh Toán Giỏ Hàng</li>
			</ol>
		</div><!-- Breadcrumbs-->



		<div class="shopper-informations">

			<div class="row">

				<div class="col-sm-15 clearfix">

					<div class="bill-to">

						<p>Thông Tin Giao Hàng</p>
						<div class="form-one">
							<form action="{{URL::to('/save-checkout-customer')}}" method="POST">

								{{ csrf_field() }}
								@error('shipping_email'){{$message}}@enderror</span>
								<input type="email" name="shipping_email" placeholder="Email*" value="{{old('shipping_email')}}">
								@error('shipping_name'){{$message}}@enderror</span>
								<input type="text" name="shipping_name" placeholder="Họ và Tên " value="{{old('shipping_name')}}">
								@error('shipping_address'){{$message}}@enderror</span>
								<input type="text" name="shipping_address" placeholder="Địa chỉ " value="{{old('shipping_address')}}">
								@error('shipping_phone'){{$message}}@enderror</span>
								<input type="textarea" name="shipping_phone" placeholder="Số Điện Thoại" value="{{old('shipping_phone')}}">
								@error('shipping_notes'){{$message}}@enderror</span>
								<textarea name="shipping_notes" placeholder="Ghi Chú Đơn Hàng Của Bạn" rows="15" value="{{old('shipping_notes')}}"></textarea>

								<input type="submit" name="send_order" value="Thanh Toán" class="btn btn-primary btn-sm ">
							</form>
						</div>

					</div>
				</div>

			</div>
		</div>

	</div>
</section>
<!--/#cart_items-->
@endsection