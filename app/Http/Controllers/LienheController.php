<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Gallery;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class LienheController extends Controller
{
    public function index(){
        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();
        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')
    	->where('category_status','0')->orderby('category_id','desc')->get();
    	return view('pages.lienhe.index')->with('slider',$slider)->with('category',$cate_product)->with('brand',$brand_product);
    }

}