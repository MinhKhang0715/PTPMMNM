<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class CategoryProduct extends Controller
{


//Admin
    
    //Check admin đã login chưa
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('dashboard');
        } else {
           return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this->AuthLogin();
    	return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
    	$all_category_product = DB::table('tbl_category_product')->paginate(6); //lấy dữ liệu từ DB
    	$manager_category_product = view('admin.all_category_product')
        ->with('all_category_product',$all_category_product); 	//truyền dữ liệu vào $manager view + giá trị đã lấy ở trên
    	return view('admin_layout')
        ->with('admin.all_category_product',$manager_category_product);
        // trả về giao diện admin layout có view + dữ liệu


    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;

    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
    
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')
        ->where('category_id',$category_product_id)
        ->update(['category_status'=>1]);
        Session::put('message','Ẩn danh mục thành công');
        return Redirect::to('all-category-product');
        //truy xuất DB tại categore_id = giá trị $category_product_id cập nhật status
        //xuất thông báo
        //trả về giao diện danh sách sản phẩm

    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')
        ->where('category_id',$category_product_id)
        ->update(['category_status'=>0  ]);
        Session::put('message','Hiện danh mục thành công');
        return Redirect::to('all-category-product');
    }

//hàm trả dữ liệu + view page cho admin edit
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')
        ->where('category_id',$category_product_id)->get(); 
        //lấy dữ liệu từ DB 1 sp tại id được truyền
        $manager_category_product = view('admin.edit_category_product')
        ->with('edit_category_product',$all_category_product);     
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên để hiển thị
        return view('admin_layout')
        ->with('admin.edit_category_product',$manager_category_product);
        // trả về giao diện admin layout có view + dữ liệu
    }

    //Hàm cập nhật thông tin đã edit vào DB
     public function update_category_product(Request $request , $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục thành công');
        return Redirect::to('all-category-product');
    }

    //Hàm xóa dữ liệu của danh mục sản phẩm
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-category-product');
    }
//Kết thúc function của admin


//Trang Chủ


        //Hiển Thị Sản Phẩm Trong Danh Mục
        public function show_category_home($category_id){

            $slider =  DB::table('tbl_slider')
            ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();

            $cate_product = DB::table('tbl_category_product')
            ->where('category_status','0')
            ->orderby('category_id','desc')->get();
            //lấy dữ liệu của tbl categoryproduct cho cột Chọn Danh mục 

            $brand_product = DB::table('tbl_brand')
            ->where('brand_status','0')
            ->orderby('brand_id','desc')->get();
            //lấy dữ liệu của tbl brand cho cột Chọn Thương Hiệu

            $category_name = DB::table('tbl_category_product')
            ->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
            //lấy tên danh mục tại id , chỉ lấy 1 tên vd: Iphone 10 sản phẩm thì nó lấy luôn 10 tên nhét vào 1 chuỗi 

            $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
            ->where('tbl_product.category_id',$category_id)
            ->paginate(6);
            //lấy dữ liệu sản phẩm với điều kiện sản phẩm phải có category_id trùng với category_id truyền vào
            //join ('tbl name','điều kiện) where ('tại tbl nào',$giá trị gì) id đã truyền vào


            return view('pages.category.show_category')
            ->with('category',$cate_product)
            ->with('brand',$brand_product)
            ->with('category_by_id',$category_by_id)
            ->with('category_name',$category_name)
            ->with('slider',$slider); ; 
            //đưa dữ liệu vào show_category 
        }



        
}
