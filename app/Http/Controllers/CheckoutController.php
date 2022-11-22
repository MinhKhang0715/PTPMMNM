<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
use Cart;
use Validator;

class CheckoutController extends Controller
{

    public function AuthLogin(){
        $id = Session::get('customer_id');
        if($id==NULL){

           return Redirect::to('login-checkout');
        }
    }

	//Hàm trả ra giao diện login_checkout
    public function login_checkout(){

    	$cate_product = DB::table('tbl_category_product')
    	->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }

 	//Đăng Kí Khách Hàng
    public function add_customer(Request $request){ 
    	$data =  array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = DB::table('tbl_customers')->insertGetId($data); //insertGetId là hàm lấy ID dữ liệu của cái vừa insert vào DB luô
    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect('/checkout');

    }
    public function validation($request){
        return $this->validate($request,[
                'customer_name' => 'required|max:20',
                'customer_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
                'customer_email' => 'required|email|unique:tbl_customers,customer_email',
                'customer_password' => 'required|min:6',

                'shipping_name' => 'required|max:20',
                'shipping_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
                'shipping_email' => 'required|email',
                'shipping_notes' => 'required|min:6',
                'shipping_address' => 'required|min:6'
            ]);

    }

    public function validationShipping($request){
        return $this->validate($request,[
                'shipping_name' => 'required|max:20',
                'shipping_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
                'shipping_email' => 'required|email',
                'shipping_notes' => 'required|min:6',
                'shipping_address' => 'required|min:6'
            ]);
    }

	//Gọi Giao diện Thanh Toán
    public function checkout(){
        $id = Session::get('customer_id');
        if($id==NULL){

           return Redirect::to('login-checkout');
        }

        $shipping = Session::get('shipping_id');
        if($shipping){

           return Redirect::to('payment');
        }


        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();

    	$cate_product = DB::table('tbl_category_product')
    	->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }

    //Hàm Lưu Thông Tin Thanh Toán -- Shipping
    public function save_checkout_customer(Request $request){
        //  $this->validationShipping($request);
         
    	$data =  array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data); //insertGetId là hàm lấy ID dữ liệu của cái vừa insert vào DB luôn

    	Session::put('shipping_id',$shipping_id);
    	return Redirect('/payment');

    }

    //Hàm trả ra giao diện thanh toán
    public function payment(){

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

        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);

    }

    //Hàm đặt hàng , hoàn thành thanh toán
    public function order_place(Request $request){

        
        if(Session::get('shipping_id')==false)
            return Redirect::to('/checkout');
        //Chọn hình thức thanh toán
        //insert payment_method
        $data =  array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = "Đang chờ xử lý";                 //status đang chờ hàm bên admin xác nhận xử lý

        $payment_id = DB::table('tbl_payment')->insertGetId($data); //insertGetId là hàm lấy ID dữ liệu của cái vừa insert vào DB luôn

        //lấy dữ liệu thông tin của đơn đặt hàng
        //insert order

        $order_data =  array();
        $order_data['customer_id'] = Session::get('customer_id');   //id của khách hàng từ session put ở trên
        $order_data['shipping_id'] = Session::get('shipping_id');   //id của thông tin đơn hàng từ session put ở trên
        $order_data['payment_id'] = $payment_id;                    //lấy id từ phương thức thanh toán vừa tạo phía trên
        $order_data['order_status'] = 0;             //status đang chờ hàm bên admin xác nhận xử lý
        $order_data['created_at'] = date('y/m/d',time()); 
        $order_id = DB::table('tbl_order')->insertGetId($order_data); //insertGetId là hàm lấy ID dữ liệu của cái vừa insert vào DB luôn
         $product = DB::table('tbl_product')->get();
         $datap = array();
        //insert order details
        //với mỗi thông tin 1 món hàng trong đơn hàng , tạo một chuỗi liên kết để lưu thông tin vào DB
        //Lây thông tin của shopping card đưa vào biến content
        $cart = Session::get('cart');
        foreach ($cart as $key => $val) {
            $order_d_data['order_id'] =  $order_id;
            $order_d_data['product_id'] = $val['product_id'];
            $order_d_data['product_name'] = $val['product_name'];
            $order_d_data['product_image'] = $val['product_image'];
            $order_d_data['product_price'] = $val['product_price'];
            $order_d_data['product_sales_quantity'] = $val['product_qty'];
            foreach ($product as $key => $pro) {
            if($order_d_data['product_id']==$pro->product_id){
            
            $datap['product_name'] = $pro->product_name;
            $datap['product_price'] = $pro->product_price;
            $datap['product_desc'] = $pro->product_desc;
            $datap['product_content'] = $pro->product_content;
            $datap['category_id'] = $pro->category_id;
            $datap['brand_id'] = $pro->brand_id;
            $datap['product_qty'] = $pro->product_qty;
            $datap['product_status'] = $pro->product_status;
            
            $datap['product_qty'] = $datap['product_qty'] - $order_d_data['product_sales_quantity'];
            DB::table('tbl_product')->where('product_id',$pro->product_id)->update($datap);
            }

        }
            DB::table('tbl_order_details')->insert($order_d_data); 
        }
        
        if($data['payment_method']==1){
            echo 'Thanh toán thẻ ATM';
        }elseif($data['payment_method']==2){

            //thanh toán xong dùng hàm xóa dữ liệu của shopping card
            Session::forget('cart');
            Session::forget('shipping_id');

            return Redirect::to('/handcash');

        }else{
             echo 'Thanh toán thẻ ATM';
        }


        return Redirect('/payment');

    }

	//Đăng xuất Khách hàng
    public function logout_checkout(){
    	Session::forget('customer_id');
        Session::forget('customer_name');
    	return redirect()->back();
    }

    //Hàm Đăng Nhập Khách Hàng
    
    public function login_customer_ajax(Request $request){

        $data = $request->all();

        $result = DB::table('tbl_customers')->where('customer_email',$data['email'])->where('customer_password',md5($data['password']))->first();  
        if($result){
            Session::put('customer_id',$result->customer_id); //Đưa ra customer id tại Giá trị mà $result lấy được  
            echo 'dung';
        }else{
            echo 'sai';
        }
    }

    public function handcash(Request $request){
            $this->AuthLogin(); 

            $slider =  DB::table('tbl_slider')
            ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();

            $cate_product = DB::table('tbl_category_product')
            ->where('category_status','0')->orderby('category_id','desc')->get();

            $brand_product = DB::table('tbl_brand')
            ->where('brand_status','0')->orderby('brand_id','desc')->get();

            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);


    }


//Admin
    public function view_order($orderId){

        $this->AuthLogin(); 
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
 
 
         //lấy dữ liệu từ DB 
         //join là hàm giao table với nhau điều kiện cùng id với nhau
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id)->with('order_d',$order_d);     //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
        // echo '<pre>';
        // print_r($order_by_id);
        // echo '</pre>';
    }


    public function manage_order(){

        $this->AuthLogin(); 
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name') //chọn tất cả tên khách hàng từ tbl_order
        ->orderby('tbl_order.order_id','desc')
        ->paginate(6);
         //lấy dữ liệu từ DB 
         //join là hàm giao table với nhau điều kiện cùng id với nhau
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);     //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }

    public function unactive_order($order_id){
        $this->AuthLogin(); 
        DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>1]);
        Session::put('message','Đơn hàng bạn chọn chuyển thành đã được hoàn thành xong');
        return Redirect::to('manage-order');
        //truy xuất DB tại categore_id = giá trị $brand_product_id cập nhật status
        //xuất thông báo
        //trả về giao diện danh sách sản phẩm

    }

    public function active_order($order_id){
        $this->AuthLogin(); 
        DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>0]);
        Session::put('message','Đơn hàng bạn chọn chuyển thành chưa được hoàn thành xong');
        return Redirect::to('manage-order');
    }

    public function delete_order($order_id){
        $this->AuthLogin(); 
        DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>2]);
        Session::put('message','Hủy đơn hàng thành công');
        return Redirect::to('manage-order');
    }

    public function return_order($order_id){
        $this->AuthLogin(); 
        DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>0]);
        Session::put('message','Khôi phục đơn hàng thành công');
        return Redirect::to('manage-order');
    }

 


}

    