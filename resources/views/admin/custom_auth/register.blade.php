<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
	<title>Đăng ký</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
	<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
	<!-- //font-awesome icons -->
	<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>

<body>
	<div class="log-w3">
		<div class="w3layouts-main">


			<!--Đăng ký-->
			<h2>Đăng ký</h2>
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<span class="text-alert">', $message . '</span>';
				Session::put('message', null);
			}
			?>
			<form action="{{URL::to('/register')}}" method="POST">
				{{ csrf_field() }}

				<!-- Hàm old dùng để khi load lại vẫn giữ dữ liệu đã ghi nếu bị invalid -->
				<input type="text" class="ggg" name="admin_name" placeholder="NAME" required="" value="{{old('admin_name')}}">
				<span style="color: red">@error('admin_name'){{$message}}@enderror</span>
				<input type="text" class="ggg" name="admin_email" placeholder="EMAIL" required="" value="{{old('admin_email')}}">
				<span style="color: red">@error('admin_email'){{$message}}@enderror</span>
				<input type="text" class="ggg" name="admin_phone" placeholder="PHONE" required="" value="{{old('admin_phone')}}">
				<span style="color: red">@error('admin_phone'){{$message}}@enderror</span>
				<input type="password" class="ggg" name="admin_password" placeholder="PASSWORD" required="" value="{{old('admin_password')}}">
				<span style="color: red">@error('admin_password'){{$message}}@enderror</span>
				<input type="submit" value="Đăng Ký" name="Register">
			</form>

		</div>
	</div>
	<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
	<script src="{{asset('public/backend/js/scripts.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>

</html>