<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Order;
use App\Http\Requests;
use App\Models\Gallery;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class AccountController extends Controller
{

    public function AuthLogin(){
        $id = Session::get('customer_id');
        if($id==NULL){

           return Redirect::to('login-checkout');
        }
    }

    public function show_account(){

        $id = Session::get('customer_id');
        if($id==NULL){

           return Redirect::to('login-checkout');
        }

        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();


    	$cate_product = DB::table('tbl_category_product')
    	->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')->orderby('product_id','desc')->limit(6)->get();
 
        $all_order = DB::table('tbl_order')->where('customer_id',$id)->orderby('order_id','desc')
        ->get();
         //lấy dữ liệu từ DB 
         //join là hàm giao table với nhau điều kiện cùng id với nhau
         //lấy dữ liệu từ DB 


    	return view('pages.order.show_order')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('all_order', $all_order);
    }

    public function view_order_customer($orderId){

        
        $id = Session::get('customer_id');
        if($id==NULL){

           return Redirect::to('login-checkout');
        }


        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();


        $cate_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')->orderby('product_id','desc')->limit(6)->get();
        
        $order_by_id = DB::table('tbl_order')->where('tbl_order.order_id', $orderId)
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
        ->first(); 

        $order_d = DB::table('tbl_order')->where('tbl_order.order_id', $orderId)
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
        ->get(); 
    
        if($id!=$order_by_id->customer_id){

           return Redirect::to('trang-chu');
        }
         //lấy dữ liệu từ DB 
         //join là hàm giao table với nhau điều kiện cùng id với nhau
             //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên
        return view('pages.order.view_order_customer')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('order_by_id',$order_by_id)->with('order_d',$order_d);
        // echo '<pre>';
        // print_r($order_by_id);
        // echo '</pre>';
    }

        public function delete_order_customer($order_id){
        
        $order =  Order::find($order_id);

         $id = Session::get('customer_id');
        if($id==NULL){

           return Redirect::to('login-checkout');
        }

        if($id!=$order->customer_id){

           return Redirect::to('trang-chu');
        }

        if($order->order_status==1){
            return Redirect::to('account')->with('message','Đơn hàng đã giao không được hủy bạn ơi');
        }
        $order->update(['order_status'=>2]);
        
        return Redirect::to('account')->with('message','Hủy đơn hàng thành công');
    }

    
  

}

