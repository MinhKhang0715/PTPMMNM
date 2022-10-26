<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class BrandProduct extends Controller
{
     //Hàm check có login chưa nếu chưa đá về trang admin login
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('dashboard');
        } else {
           return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthLogin(); 
    	return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin(); 
    	$all_brand_product = DB::table('tbl_brand')->paginate(6); //lấy dữ liệu từ DB
    	$manager_brand_product = view('admin.all_brand_product')
        ->with('all_brand_product',$all_brand_product); 	
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên
    	return view('admin_layout')
        ->with('admin.all_brand_product',$manager_brand_product);
        // trả về giao diện admin layout có view + dữ liệu


    }

      public function save_brand_product(Request $request){
        $this->AuthLogin(); 
    	$data = array();
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_desc'] = $request->brand_product_desc;
    	$data['brand_status'] = $request->brand_product_status;

    	DB::table('tbl_brand')->insert($data);
    	Session::put('message','Thêm thương hiệu sản phẩm thành công');
    	return Redirect::to('add-brand-product');
    }
    
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin(); 
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Ẩn danh mục thương hiệu thành công');
        return Redirect::to('all-brand-product');
        //truy xuất DB tại categore_id = giá trị $brand_product_id cập nhật status
        //xuất thông báo
        //trả về giao diện danh sách sản phẩm

    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin(); 
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0  ]);
        Session::put('message','Hiện danh mục thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    //hàm trả dữ liệu + view page cho admin edit
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin(); 

        

        $all_brand_product = DB::table('tbl_brand')
        ->where('brand_id',$brand_product_id)->get(); 
        //lấy dữ liệu từ DB 1 sp tại id được truyền
        $manager_brand_product = view('admin.edit_brand_product')
        ->with('edit_brand_product',$all_brand_product);     
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên để hiển thị
        return view('admin_layout')
        ->with('admin.edit_brand_product',$manager_brand_product);
        // trả về giao diện admin layout có view + dữ liệu
    }

    //Hàm cập nhật thông tin đã edit vào DB
    public function update_brand_product(Request $request , $brand_product_id){
        $this->AuthLogin(); 
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật danh mục thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    //Hàm xóa dữ liệu của danh mục thương hiệu sản phẩm
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin(); 
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-brand-product');
    }

//Kết thúc function của admin


//Trang Chủ

    //Hiển Thị Sản Phẩm Trong Thương Hiệu
        public function show_brand_home($brand_id){

            $slider =  DB::table('tbl_slider')
            ->where('slider_status','0')->orderby('slider_id','desc')->limit(3)->get();

            $cate_product = DB::table('tbl_category_product')
            ->where('category_status','0')
            ->orderby('category_id','desc')->get();
            //lấy dữ liệu của tbl categoryproduct cho cột Chọn Danh mục 

            $brand_product = DB::table('tbl_brand')
            ->where('brand_status','0')
            ->orderby('brand_id','desc')->get();
            //lấy dữ liệu của tbl brand cho cột Chọn Thương Hiệu

            $brand_name = DB::table('tbl_brand')
            ->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
            //lấy tên thương hiệu tại id , chỉ lấy 1 tên vd: Apple 10 sản phẩm thì nó lấy luôn 10 tên nhét vào 1 chuỗi 


            $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
            ->where('tbl_product.brand_id',$brand_id)
            ->paginate(6);
            //lấy dữ liệu sản phẩm với điều kiện sản phẩm phải có brand_id trùng với brand_id truyền vào
            //join ('tbl name','điều kiện) where ('tại tbl nào',$giá trị gì) id đã truyền vào


            return view('pages.brand.show_brand')
            ->with('category',$cate_product)
            ->with('brand',$brand_product)
            ->with('brand_by_id',$brand_by_id)
            ->with('brand_name',$brand_name)
            ->with('slider',$slider); 
            //đưa dữ liệu vào show_brand
        }
}
