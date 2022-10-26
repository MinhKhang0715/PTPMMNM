<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
use Cart;

session_start();

class CartController extends Controller
{

	//Hàm Thêm vào giỏ hàng
	//Sử dụng shopping cart laravel 8 
    public function save_cart(Request $request){

    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;

    	$product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
    	
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;	//Cho đại cái này vào để cho đủ cột , hàm không báo lỗi
        $data['options']['image'] = $product_info->product_image;

        // phải khai đúng cột thứ tự của frameword cart nếu không sẽ báo lỗi
        // ID,Qty,Name,Price,weight,Options

    	Cart::add($data); //Thêm sản phẩm vào giỏ hàng ảo của shopping cart laravel 8 
    	// Cart::destroy(); //Xóa hết sản phẩm trong giỏ hàng ảo của shopping cart laravel 8 

    	return Redirect::to('/show_cart');
    	// Thêm xong thì quay lại trang giỏ hàng
    	
        // Cart::destroy();
    }

    //Hàm show giỏ hàng ra layout	
    public function show_cart(){

    	$cate_product = DB::table('tbl_category_product')
    	->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

    	return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }

    //Hàm Xóa sản phẩm trong giỏ hàng ảo của shopping cart laravel 8 
    public function delete_to_cart($rowId){
    	Cart::update($rowId,0); //Hàm dựa vào $rowId : là Id của row trong giỏ hàng được chọn ,đưa số lượng qty về 0
    	return Redirect::to('/show_cart');
    }

    public function update_cart_quantity(Request $request){
    	$rowId = $request->rowId_cart;
    	$qty = $request->cart_quantity;
    	Cart::update($rowId,$qty);	//Hàm dựa vào $rowId : là Id của row trong giỏ hàng được chọn ,đưa số lượng qty về giá trị đã lấy trong phương thức post
    	return Redirect::to('/show_cart');
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if ($cart==true){
            $is_avaiable = 0;

            foreach ($cart as $key => $val) {
               if ($val['product_id']==$data['cart_product_id']) {
                   $is_avaiable++;
               }
            }

            if ($is_avaiable == 0) {
                 $cart[] = array(
                'session_id'=> $session_id, 
                'product_name'=> $data['cart_product_name'],
                'product_id'=>  $data['cart_product_id'],
                'product_image'=>   $data['cart_product_image'],
                'product_quantity'=>   $data['cart_product_quantity'],
                'product_qty'=> $data['cart_product_qty'],
                'product_price'=>   $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
            'session_id'=> $session_id, 
            'product_name'=> $data['cart_product_name'],
            'product_id'=>  $data['cart_product_id'],
            'product_image'=>   $data['cart_product_image'],
            'product_quantity'=>   $data['cart_product_quantity'],
            'product_qty'=> $data['cart_product_qty'],
            'product_price'=>   $data['cart_product_price'],
            );
        }

        Session::put('cart',$cart);
        Session::save();
    } 

    public function show_cart_ajax (Request $request){
        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();
        
        $cate_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }

    public function delete_product_ajax($session_id){
        $cart = Session::get('cart');

        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        // xem thử code xuất ra giá trị như thế nào 

        if($cart==true){
            foreach ($cart as $key => $val) {
                if ($val['session_id']==$session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart); // cập nhật lại thông tin giỏ hàng mới , viết lại mảng không bị khuyết session đã xóa

            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        } else{
             return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }

    public function update_cart_ajax(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        
        if($cart==true){
            $message ='';
            foreach ($data['cart_qty'] as $key => $qty) {
                $i =0;

                foreach ($cart as $session => $val ) {
                    $i++;
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty ;
                        $message .='<div class="alert alert-success"> <p style="color:green">Cập nhật số lượng :'.$cart[$session]['product_name'].' thành công</p></div>';
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message .='<div class="alert alert-danger"><p style="color:red">Cập nhật số lượng :'.$cart[$session]['product_name'].' thất bại</p></div>';
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật giỏ hàng thất bại');
        }
    }

    public function delete_all_product_ajax(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            return redirect()->back()->with('message','Xóa giỏ hàng thành công');
        }
    }
}
