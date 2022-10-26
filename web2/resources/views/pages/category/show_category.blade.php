@extends('layout')
@section('content')
            <div class="features_items"><!--features_items-->
                    @foreach ($category_name as $key => $name)
                        <h2 class="title text-center">{{$name->category_name}}</h2>
                    @endforeach

                        @foreach ($category_by_id as $key => $product)
                                                <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form> 
                                                    @csrf
                                                <input type="hidden" name="" class="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}">
                                                <input type="hidden" name="" class="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}">
                                                <input type="hidden" name="" class="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}">
                                                <input type="hidden" name="" class="cart_product_quantity_{{$product->product_id}}" value="{{$product->product_qty}}">
                                                <input type="hidden" name="" class="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}">
                                                <input type="hidden" name="" class="cart_product_qty_{{$product->product_id}}" value="1">

                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                            <h2>{{number_format($product->product_price).' VNĐ'}}</h2>
                                            <p>{{$product->product_name}}</p>
                                           
                                        </a>
                                            <?php
                                        if(($product->product_qty)>0){
                                            ?>
                                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart" >Thêm vào giỏ hàng</button>
                                        <?php 
                                        }else{
                                        ?>   
                                        <button type="button" class="btn btn-default add-to-cart" name="out_of_stock" >Hết Hàng</button>
                                            <?php
                                        }
                                        ?>
                                        </form>
                                        </div>

                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                   
                        @endforeach
                        
                    </div><!--features_items-->

{!! $category_by_id->links() !!}

@endsection    