<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
use Auth;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class SliderController extends Controller
{
	public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('dashboard');
        } else {
           return Redirect::to('admin')->send();
        }
    }

    public function manage_slider(){
        $this->AuthLogin(); 
    	$all_slider_banner =  DB::table('tbl_slider')->get();
    	$manager_slider_banner = view('admin.slider.all_slider')
        ->with('all_slider_banner',$all_slider_banner); 
    	return view('admin_layout') ->with('admin.slider.all_slider',$manager_slider_banner);
    }

    public function add_slider(){
        $this->AuthLogin(); 
    	 return view('admin.slider.add_slider');// trả về giao diện admin layout có view
    }

    public function save_slider(Request $request){
        $this->AuthLogin(); 

        $request->validate([
                'slider_name'=>'required',
                'slider_desc'=>'required',
        ]);


    	$data = array();
    	$data['slider_name'] = $request->slider_name;
    	$data['slider_desc'] = $request->slider_desc;
        $data['slider_status'] = $request->slider_status;
        $get_image = $request->file('slider_image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
            //Lấy đuôi mở rộng của hình vd: .png,.pdf
            $get_image->move('public/uploads/slider',$new_image); 
            //Lấy hình từ thư mục public/upload/slider trên máy
            $data['slider_image'] = $new_image; //nếu người dùng chọn thì đưa $new_image vào $data
            DB::table('tbl_slider')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-slider');
        }
        $data['slider_image'] = '';  //nếu ng dùng ko chọn hình thì cho $data hình rỗng
    	DB::table('tbl_slider')->insert($data);
    	Session::put('message','Thêm slider thành công');
    	return Redirect::to('add-slider');
    }

        public function delete_slider($slider_id){
        $this->AuthLogin(); 
        
        $slider = Slider::find($slider_id);
        unlink('public/uploads/slider/'.$slider->slider_image);
        $slider->delete();
        return Redirect::to('manage-slider');
    }

    public function edit_slider($slider_id){
        $this->AuthLogin(); 
     
        $edit_slider = DB::table('tbl_slider')->where('slider_id',$slider_id)->get(); //lấy dữ liệu từ DB 1 sp tại id được truyền
        $manager_slider = view('admin.slider.edit_slider')->with('edit_slider',$edit_slider);
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên để hiển thị
        return view('admin_layout')->with('admin.slider.edit_slider',$manager_slider);// trả về giao diện admin layout có view + dữ liệu
    }

    public function update_slider(Request $request , $slider_id){
        $this->AuthLogin(); 
       $data = array();
    	$data['slider_name'] = $request->slider_name;
    	$data['slider_desc'] = $request->slider_desc;
        $data['slider_status'] = $request->slider_status;
        $get_image = $request->file('slider_image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); 
            //Lấy đuôi mở rộng của hình vd: .png,.pdf
            $get_image->move('public/uploads/slider',$new_image); 
            //Lấy hình từ thư mục public/upload/slider trên máy
            $data['slider_image'] = $new_image; //nếu người dùng chọn thì đưa $new_image vào $data
            DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('manage-slider');
        }
        
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
        Session::put('message','Cập nhật phẩm thành công');
        return Redirect::to('manage-slider');
    }

     public function unactive_slider($slider_id){
        $this->AuthLogin(); 
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('manage-slider');
      

    }

    public function active_slider($slider_id){
        $this->AuthLogin(); 
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0  ]);
        Session::put('message','Hiện sản phẩm thành công');
        return Redirect::to('manage-slider');
    }


}
