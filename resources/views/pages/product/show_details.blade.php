@extends('layout')
@section('content')
@foreach($product_details as $key => $value)

<div class="product-details">
	<!--product-details-->
	<!-- Gallery Sản Phẩm-->
	<div class="col-sm-7">
		<ul id="imageGallery">
			<img width="100%" src="{{asset('public/uploads/product/'.$value->product_image)}}" />


		</ul>

	</div>
	<div class="col-sm-5">
		<div class="product-information">
			<!--/product-information-->
			<!-- Đưa thông tin từ Controller DB vào $value , upload $value lên khung -->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$value->product_name}}</h2>
			<p>Mã SP: {{$value->product_id}}</p>
			<img src="images/product-details/rating.png" alt="" />

			<!-- Thêm Vào Giỏ Hàng -->
			<form>
				@csrf
				<input type="hidden" name="" class="cart_product_id_{{$value->product_id}}" value="{{$value->product_id}}">
				<input type="hidden" name="" class="cart_product_name_{{$value->product_id}}" value="{{$value->product_name}}">
				<input type="hidden" name="" class="cart_product_image_{{$value->product_id}}" value="
                                                {{$value->product_image}}">
				<input type="hidden" name="" class="cart_product_quantity_{{$value->product_qty}}" value="
                                                {{$value->product_qty}}">
				<input type="hidden" name="" class="cart_product_price_{{$value->product_id}}" value="{{$value->product_price}}">
				<input type="hidden" name="" class="cart_product_qty_{{$value->product_id}}" value="1">



				<h2>{{number_format($value->product_price).' VNĐ'}}</h2>
				<p>{{$value->product_name}}</p>


				<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm vào giỏ hàng</button>
			</form>
			<p><b>Tình Trạng:</b> Còn Hàng</p>
			<p><b>Tình Trạng Máy:</b> New 100%</p>
			<p><b>Thương Hiệu:</b> {{$value->brand_name}}</p>
			<p><b>Danh Mục:</b> {{$value->category_name}}</p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
		</div>
		<!--/product-information-->
	</div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
	<!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs ">
			<li class="active"><a href="#details" data-toggle="tab">Mô Tả Sản Phẩm</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Thông Số Kĩ Thuật</a></li>
			<li><a href="#reviews" data-toggle="tab">Đánh Giá</a></li>
		</ul>
	</div>

	<!-- Content của sản phẩm -->
	<div class="tab-content">
		<div class="tab-pane fade" id="details">

			<p>{!!$value->product_desc!!}</p>


		</div>

		<!-- Không dùng hai ngoặc vì trong content có kí tự đặc biệt ,dùng ngoặc + !! có thể lấy giá trị đặc biệt như !@#$%^&* -->
		<div class="tab-pane fade" id="companyprofile">

			<p>{!!$value->product_content!!}</p>


		</div>



		<div class="tab-pane fade active in" id="reviews">
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				<p><b>Write Your Review</b></p>

				<form action="#">
					<span>
						<input type="text" placeholder="Your Name" />
						<input type="email" placeholder="Email Address" />
					</span>
					<textarea name=""></textarea>
					<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
					<button type="button" class="btn btn-default pull-right">
						Submit
					</button>
				</form>
			</div>
		</div>

	</div>
</div>
<!--/category-tab-->
@endforeach


<div class="recommended_items">
	<!--recommended_items-->
	<h2 class="title text-center">Sản Phẩm Liên Quan Theo Danh Mục</h2>
	@php
	$i = 0;
	@endphp
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@foreach ($related_category_product as $key => $related_category)
			@php
			$i++;
			@endphp
			<div class="item {{$i<4 ? 'active' : ''}}">


				<a href="{{URL::to('/chi-tiet-san-pham/'.$related_category->product_id)}}">
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('public/uploads/product/'.$related_category->product_image)}}" alt="" />
									<h2>{{number_format($related_category->product_price).' VNĐ'}}</h2>
									<p>{{$related_category->product_name}}</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
			</div>
			@endforeach


		</div>
		<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>
	</div>
</div>
<!--/recommended_items-->


<div class="recommended_items">
	<!--recommended_items-->
	<h2 class="title text-center">Sản Phẩm Liên Quan Theo Thương Hiệu</h2>
	@php
	$j = 0;
	@endphp
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@foreach ($related_brand_product as $key => $related_brand)
			@php
			$j++;
			@endphp
			<div class="item {{$j<4 ? 'active' : ''}}">


				<a href="{{URL::to('/chi-tiet-san-pham/'.$related_brand->product_id)}}">
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('public/uploads/product/'.$related_brand->product_image)}}" alt="" />
									<h2>{{number_format($related_brand->product_price).' VNĐ'}}</h2>
									<p>{{$related_brand->product_name}}</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
			</div>
			@endforeach


		</div>
		<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>
	</div>
</div>
<!--/recommended_items-->
@endsection