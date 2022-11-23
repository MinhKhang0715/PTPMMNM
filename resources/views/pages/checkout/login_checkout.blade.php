@extends('layout')
@section('content')

<section id="form">
	<!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form">
					<!--login form-->
					<h2>Đăng Nhập </h2>
					<p class="text text-danger" id="thongbaodangnhap"></p>
					<form action="{{URL::to('/login-customer')}}" method="POST">
						{{ csrf_field() }}

						<input type="email" class="email" name="email_account" placeholder="Tài Khoản" />
						<input type="password" class="password" name="password_account" placeholder="Password" />
						<span>
							<input type="checkbox" class="checkbox">
							Ghi nhớ đăng nhập
						</span>

						<button type="button" class="btn btn-default login_customer">Đăng Nhập</button>
					</form>

				</div>
				<!--/login form-->
			</div>

			<div class="col-sm-5">
				<div class="signup-form">
					<!--sign up form-->
					<h2>Đăng Kí</h2>
					<form action="{{URL::to('/add-customer')}}" method="POST">
						{{ csrf_field() }}
						<span style="color: red">@error('customer_name'){{$message}}@enderror</span>
						<input type="text" name="customer_name" placeholder="Họ và Tên" value="{{old('customer_name')}}">
						<span style="color: red">@error('customer_email'){{$message}}@enderror</span>
						<input type="email" name="customer_email" placeholder="Địa chỉ Email" value="{{old('customer_email')}}">
						<span style="color: red">@error('customer_password'){{$message}}@enderror</span>
						<input type="password" name="customer_password" placeholder="Mật Khẩu" value="{{old('customer_password')}}">
						<span style="color: red">@error('customer_phone'){{$message}}@enderror</span>
						<input type="text" name="customer_phone" placeholder="Phone" value="{{old('customer_phone')}}">

						<button type="submit" class="btn btn-default">Đăng Ký</button>
					</form>
					{{old('admin_name')}}

				</div>
				<!--/sign up form-->
			</div>
		</div>
	</div>
</section>
<!--/form-->
@endsection