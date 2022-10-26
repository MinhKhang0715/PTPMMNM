@extends('admin_layout')
@section('admin_content')
	
	<?php 
	$a =0;
	$o =0;
	$on =0;
	$u = 0;
	
 foreach($admin as $key => $ad){ 
	$a++;
}
  foreach($order as $key => $or) {
	$o++;
 }
  foreach($order_new as $key => $orn) {
	$on++;
 }
  foreach($user as $key => $us) {
	$u++;
 }
 ?>
 <form role="form" action="{{URL::to('/statistic-date')}}" method="post">
			@csrf

			<div class="col-md-4">
				<p>Từ ngày: <input type="text" name="date" id="datepicker" class="form-control"></p>

				

			</div>

			<div class="col-md-4">
				<p>Đến ngày: <input type="text" name="date1" id="datepicker2" class="form-control"></p>
			
			</div>
			<button type="submit" name="submit_date" class="btn btn-info">Lọc</button>
		</form>
<section id="main-content">
	<section class="wrapper">

		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>New Order</h4>
					<h3>{{$on}}</h3>
					<p>Other hand, we denounce</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Users</h4>
						<h3>{{$a}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Customers</h4>
						<h3>{{$u}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Orders</h4>
						<h3>{{$o}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Visitor Statistics</h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>
	<!--//agileinfo-grap-->

				</div>
			</div>
		</div>
		
		
		
@endsection