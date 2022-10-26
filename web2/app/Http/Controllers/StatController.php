<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class StatController extends Controller
{
    public function show_statistic(){
        $admin = DB::table('tbl_admin')->get();
        $order = DB::table('tbl_order')->where('order_status','1')->get();
        $order_new = DB::table('tbl_order')->where('order_status','0')->get();
        $user = DB::table('tbl_customers')->get();

        
        return view('admin.statistic')->with('admin',$admin)->with('order_new',$order_new)->with('order',$order)->with('user',$user);
    }
 public function show_statistic_date(Request $requests){
 		$data = array();
    	$data['date'] = $requests->date;
    	$data['date1'] = $requests->date1;
		
		
        $admin = DB::table('tbl_admin')->get();
        $order = DB::table('tbl_order')->where('order_status','1')->whereBetween('created_at', [$data['date'], $data['date1']])->get();
        $order_new = DB::table('tbl_order')->where('order_status','0')->whereBetween('created_at', [$data['date'], $data['date1']])->get();
        $user = DB::table('tbl_customers')->get();

        
        return view('admin.statistic')->with('admin',$admin)->with('order_new',$order_new)->with('order',$order)->with('user',$user);
    }
    
    

    



}
