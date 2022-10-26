<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use File;
use Auth;
use App\Models\Product;
use App\Models\Gallery;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class ProductController extends Controller
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

    public function add_product(){
        $this->AuthLogin(); 
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

    	 return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);// trả về giao diện admin layout có view + dữ liệu
    }

    public function all_product(){
        $this->AuthLogin(); 
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')
        ->paginate(6);
         //lấy dữ liệu từ DB 
         //join là hàm giao table với nhau điều kiện cùng id với nhau
    	$manager_product = view('admin.all_product')->with('all_product',$all_product); 	//truyền dữ liệu vào $manager view + giá trị đã lấy ở trên
    	return view('admin_layout')->with('admin.all_product',$manager_product);// trả về giao diện admin layout có view + dữ liệu


    }

      public function save_product(Request $request){
        $this->AuthLogin(); 

        $request->validate([
                'product_name'=>'required',
                'product_price'=>'required | min:5',
                'product_desc'=>'required',
                'product_qty'=>'required|integer|min:0',
                'product_content'=>'required',
                'product_cate'=>'required',
                'product_brand'=>'required'
        ]);


    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_qty'] = $request->product_qty;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/'; //lưu hình vào máy thư mục product
        $path_gallery = 'public/uploads/gallery/';  //lưu hình vào máy thư mục gallery để đầu chi tiế sản phẩm sẽ có 1 hình của product
        $product = DB::table('tbl_product')->get();
        
        foreach ($product as $key => $pro) {
            if($data['product_name']==$pro->product_name && $data['category_id']==$pro->category_id &&$data['brand_id']==$pro->brand_id){
            
            $datap['product_name'] = $pro->product_name;
            $datap['product_price'] =  $pro->product_price;
            $datap['product_desc'] = $pro->product_desc;
            $datap['product_content'] = $pro->product_content;
            $datap['category_id'] = $pro->category_id;
            $datap['brand_id'] = $pro->brand_id;
            $datap['product_qty'] = $pro->product_qty;
            $datap['product_status'] = $pro->product_status;

            $datap['product_qty'] = $data['product_qty'] +$pro->product_qty;
            DB::table('tbl_product')->where('product_id',$pro->product_id)->update($datap);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
            }
        }
        
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
            //Lấy đuôi mở rộng của hình vd: .png,.pdf
            $get_image->move($path,$new_image); 
            File::copy($path.$new_image,$path_gallery.$new_image);       
            //File copy sẽ có hai trường form path và to path
            // di chuyển để có 1 hình đầu tiên cho gallery
            //Lấy hình từ thư mục public/upload/product trên máy
            $data['product_image'] = $new_image; //nếu người dùng chọn thì đưa $new_image vào $data
            
        
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        }else{
            $data['product_image'] = "";
            $pro_id = DB::table('tbl_product')->insertGetId($data);
        }

        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    
}
    
    public function unactive_product($product_id){
        $this->AuthLogin(); 
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
        //truy xuất DB tại categore_id = giá trị $brand_product_id cập nhật status
        //xuất thông báo
        //trả về giao diện danh sách sản phẩm

    }

    public function active_product($product_id){
        $this->AuthLogin(); 
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0  ]);
        Session::put('message','Hiện sản phẩm thành công');
        return Redirect::to('all-product');
    }

//hàm trả dữ liệu + view page cho admin edit
    public function edit_product($product_id){
        $this->AuthLogin(); 
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get(); //lấy dữ liệu từ DB 1 sp tại id được truyền
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên để hiển thị
        return view('admin_layout')->with('admin.edit_product',$manager_product);// trả về giao diện admin layout có view + dữ liệu
    }

    //Hàm cập nhật thông tin đã edit vào DB
     public function update_product(Request $request , $product_id){
        $this->AuthLogin(); 
        $product = Product::find($product_id);

        $request->validate([
                'product_name'=>'required',
                'product_price'=>'required | min:5',
                'product_desc'=>'required',
                'product_qty'=>'required|integer|min:0',
                'product_content'=>'required',
                'product_cate'=>'required',
                'product_brand'=>'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_qty'] = $request->product_qty;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image){
            if($product->product_image){
            unlink('public/uploads/product/'.$product->product_image);
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
            //Lấy đuôi mở rộng của hình vd: .png,.pdf
            $get_image->move('public/uploads/product',$new_image); 
            //Lấy hình từ thư mục public/upload/product trên máy
            $data['product_image'] = $new_image; //nếu người dùng chọn thì đưa $new_image vào $data
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }else{
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
            //Lấy đuôi mở rộng của hình vd: .png,.pdf
            $get_image->move('public/uploads/product',$new_image); 
            //Lấy hình từ thư mục public/upload/product trên máy
            $data['product_image'] = $new_image; //nếu người dùng chọn thì đưa $new_image vào $data
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
            }
        }
        
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật phẩm thành công');
        return Redirect::to('all-product');
    }

    //Hàm xóa dữ liệu của sản phẩm
    //Xóa sản phẩm thì xóa luôn hình trong thư mục + xóa hết cả gallery
    public function delete_product($product_id){
        $this->AuthLogin(); 

        $product = Product::find($product_id);
        $gallery = DB::table('tbl_gallery')
        ->where('product_id',$product_id)->orderby('gallery_id','desc')->get();

        foreach ($gallery as $key => $gal) {
            $gallery_id = Gallery::find($gal->gallery_id);
            unlink('public/uploads/gallery/'.$gal->gallery_image);
            $gallery_id->delete();
        }

        if($product->product_image){
        unlink('public/uploads/product/'.$product->product_image);
    }
        $product->delete();


        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-product');
    }

    public function back_all_product(){
        return Redirect::to('all-product');
    }
//Kết thúc các hàm admin pages

//Trang Chủ

    public function details_product($product_id){

        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')->orderby('product_id','desc')->get();

        $cate_product = DB::table('tbl_category_product')
        ->where('category_status','0')
        ->orderby('category_id','desc')->get();
        //lấy dữ liệu của tbl categoryproduct cho cột Chọn Danh mục 

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')
        ->orderby('brand_id','desc')->get();
        //lấy dữ liệu của tbl brand cho cột Chọn Thương Hiệu

        

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)
        ->get();

        foreach ($details_product as $key => $value){ 
            $category_id = $value->category_id;
            $product_id = $value->product_id;
        }

        foreach ($details_product as $key => $value){ 
            $brand_id = $value->brand_id;
            $product_id = $value->product_id;
        }

        $gallery = DB::table('tbl_gallery')->where('product_id',$product_id)
        ->orderby('gallery_id','desc')->limit(9)->get();

        $related_category_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])
        ->get();

        //Sản phẩm liên quan được lọc theo danh mục của sản phẩm
        //WhereNotIn là hàm không lấy ID đã có vì sản phẩm liên quan sẽ không tồn tại sản phẩm đã chọn

        $related_brand_product = DB::table('tbl_product')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_brand.brand_id',$brand_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])
        ->get();

        //Sản phẩm liên quan được lọc theo Thương Hiệu của sản phẩm
        //WhereNotIn là hàm không lấy ID đã có vì sản phẩm liên quan sẽ không tồn tại sản phẩm đã chọn

        return view('pages.product.show_details')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('product_details',$details_product)
        ->with('related_category_product',$related_category_product)
        ->with('related_brand_product',$related_brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider)
        ->with('gallery',$gallery);
    }
}
