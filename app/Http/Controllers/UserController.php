<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\redirect;

class UserController extends Controller
{
    public function all_user(){
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        //lấy ra user cùng với role trong bảng giao ước admin_role
        return view('admin.users.all_users')->with(compact('admin'));
    }

    public function add_user(){
        return view('admin.users.add_users');
    }
    
    public function delete_user_roles($admin_id){
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','Bạn không được quyền xóa chính mình');
        }
        $admin = Admin::find($admin_id);

        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','Xóa user thành công');

    }

    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        //tìm id của admin vào giao ước giưa admin_roles , cắt bỏ giao ước dẫn đến tbl giao ước bị xóa bỏ
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = admin dẫn đến tbl giao ước được ghi thêm 
        }
        if($request['product_role']){
           $user->roles()->attach(Roles::where('name','product')->first());
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = product dẫn đến tbl giao ước được ghi thêm 

        }
        if($request['brand_role']){
           $user->roles()->attach(Roles::where('name','brand')->first());    
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = brand dẫn đến tbl giao ước được ghi thêm 
        }
        
        if($request['category_role']){
           $user->roles()->attach(Roles::where('name','category')->first());     
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = category dẫn đến tbl giao ước được ghi thêm 
        }
        if($request['order_role']){
           $user->roles()->attach(Roles::where('name','order')->first());     
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = order dẫn đến tbl giao ước được ghi thêm 
        }
        if($request['slider_role']){
           $user->roles()->attach(Roles::where('name','slider')->first());     
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = slider dẫn đến tbl giao ước được ghi thêm 
        }
         if($request['stat_role']){
           $user->roles()->attach(Roles::where('name','stat')->first());     
           //tìm id của admin vào giao ước giưa admin_roles , hình thành giao ước bằng admin_id + id_roles chứa name = slider dẫn đến tbl giao ước được ghi thêm 
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }

     public function store_users(Request $request){
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = Hash::make($data['admin_password']);
        $admin->save();
    
        return redirect('all-user')->with('message','Thêm user thành công');
    }

    public function validation($request){
         return $this->validate($request,[
                'admin_name' => 'required|max:20',
                'admin_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
                'admin_email' => 'required|email|unique:tbl_admin,admin_email',
                'admin_password' => 'required|min:6'
            ]);

    }

}
