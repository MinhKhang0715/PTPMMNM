<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
class AuthController extends Controller
{   
     public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('dashboard');
        } else {
           return Redirect::to('admin')->send();
        }
    }
    public function register_auth(){
    	return view('admin.users.add_users');
    }

    public function login_auth(){
        return view('admin.custom_auth.login_auth');
    }

    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth')->with('message','Đăng xuất authentication thành công');
    }

    public function login(Request $request){
        $data =  $this->validate($request,[
                'admin_email' => 'required|email',
                'password' => 'required'
            ]);
            

            if(Auth::attempt($data)){
                return redirect('/dashboard');
        }else{
            return redirect('/login-auth')->with('message','Lỗi đăng nhập authentication');
        }
            
            

    }

    public function register(Request $request){
    		$this->validation($request);
    		$data = $request->all();

    		$admin = new Admin();
    		$admin->admin_name = $data['admin_name'];
    		$admin->admin_phone = $data['admin_phone'];
    		$admin->admin_email = $data['admin_email'];
    		$admin->admin_password = md5($data['admin_password']);
    		$admin->save();
    		return redirect('/register-auth')->with('message','Đăng ký thành công');
    }

    public function validation($request){
    	 return $this->validate($request,[
                'admin_name' => 'required|max:20',
                'admin_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
                'admin_email' => 'required|email|unique:tbl_admin,admin_email',
                'admin_password' => 'required|min:6'
            ]);

    }
        public function validationEdit($request){
         return $this->validate($request,[
                'admin_name' => 'required|max:20',
                'admin_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
                'admin_email' => 'required|email',
                'admin_password' => 'required|min:6'
            ]);

    }

    public function edit_auth($admin_id){
        $this->AuthLogin(); 
        $edit_user = DB::table('tbl_admin')->where('admin_id',$admin_id)->get(); //lấy dữ liệu từ DB 1 sp tại id được truyền

        //lấy dữ liệu từ DB 1 sp tại id được truyền
        $manager_edit_user = view('admin.users.edit_user')
        ->with('edit_user',$edit_user);     
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên để hiển thị
        return view('admin_layout')
        ->with('admin.users.edit_user',$manager_edit_user);
        //truyền dữ liệu vào $manager view + giá trị đã lấy ở trên để hiển thị
        
    }

    public function update_users(Request $request , $admin_id){
        $this->AuthLogin(); 
        $this->validationEdit($request);
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_email'] = $request->admin_email;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_password'] = md5($request->admin_password);
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
        Session::put('message','Cập nhật user thành công');
        return Redirect::to('all-user');
    }

}
