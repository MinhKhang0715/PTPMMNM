<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();
class AdminController extends Controller
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

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        // $this->AuthLogin(); 
        return view('admin.dashboard');
    }

    public function show_statistic(){
        $this->AuthLogin(); 
        return view('admin.statistic');
    }
// check valid account admin 
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password); 

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first(); //lấy giới hạn 1 user để check
            if ($result){
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return Redirect::to('/dashboard');
            } else{
                Session::put('message','Mật khẩu hoặc tài khoản không tồn tại');
                return Redirect::to('/admin');
            }
    }
//logout
    public function logout(){
             $this->AuthLogin(); 
             Session::put('admin_name',null);
             Session::put('admin_id',null);
             return Redirect::to('/admin');
    }

    

}
