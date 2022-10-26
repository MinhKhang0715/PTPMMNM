<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Gallery;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class HomeController extends Controller
{
    public function index(){
        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();


    	$cate_product = DB::table('tbl_category_product')
    	->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')->orderby('product_id','desc')->limit(6)->get();


         //lấy dữ liệu từ DB 


    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('slider',$slider);
    }

    public function search(Request $request){


        $keywords = $request->input('keywords_submit');

        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();

        $cate_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')
        ->where('product_name','like','%' .$keywords. '%')->paginate(6);
        $message ='';
        $i =0;
        foreach ($search_product as $key => $search) {
            $i++;
        }
        if($i==0){
            $message .='<div class="review-payment">
                <h2>Không tìm thấy kết quả nào</h2>
            </div>';
            Session::put('message',$message);
             return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('slider',$slider);
        }else{
        $search_product->appends(['search' => $keywords]);

        //lấy dữ liệu từ DB 
        //$search_product lấy giá trị truyền vào so sánh với product name trong DB
        //Trong mysql hàm search phải dùng lệnh like vì Tên sản phẩm là Gura thì chỉ cần nhập Gu vẫn có thể cho ra kết quả 
        //Còm dùng như bình thường sẽ phải giống giá trị truyền vào 100% mới có kết quả trả ra nên không tối ưu
        //Like hoạt động : kiểm tra xem trong name có tồn tại giá trị truyền vào không , chỉ cần có là lấy luôn
       
        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('slider',$slider)->with('slider',$slider);
        }
    }

    public function product(){


        $slider =  DB::table('tbl_slider')
        ->where('slider_status','0')->orderby('slider_id','desc')->limit(6)->get();


        $cate_product = DB::table('tbl_category_product')
        ->where('category_status','0')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')->orderby('product_id','desc')->take(6)->get();

        $count_all_product = DB::table('tbl_product')
        ->where('product_status','0')->count();

         //lấy dữ liệu từ DB 


        return view('pages.product')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('slider',$slider)->with('count_all_product',$count_all_product);
    
    }
    public function show_sanpham(Request $request){
        $output = '';
        $data = $request->all();
        $record_per_page = 6;
        $start_from = ($data['id'] - 1)*$record_per_page;  

        $all_product = DB::table('tbl_product')
        ->where('product_status','0')->orderby('product_id','desc')->skip($start_from)->take(6)->get();

        foreach ($all_product as $key => $product){
                        

                       $output.=' <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form> 
                                                    '.csrf_field().'
                                                <input type="hidden" name="" class="cart_product_id_'.$product->product_id.'" value="'.$product->product_id.'">
                                                <input type="hidden" name="" class="cart_product_name_'.$product->product_id.'" value="'.$product->product_name.'">
                                                <input type="hidden" name="" class="cart_product_image_'.$product->product_id.'" value="'.$product->product_image.'">
                                                  <input type="hidden" name="" class="cart_product_quantity_'.$product->product_id.'" value="'.$product->product_qty.'">
                                                <input type="hidden" name="" class="cart_product_price_'.$product->product_id.'" value="'.$product->product_price.'">
                                                <input type="hidden" name="" class="cart_product_qty_'.$product->product_id.'" value="1">

                                            <a href="'.url('chi-tiet-san-pham/'.$product->product_id).'">
                                            <img src="'.asset('public/uploads/product/'.$product->product_image).'" alt="" />
                                            <h2>'.number_format($product->product_price).' VNĐ'.'</h2>
                                            <p>'.$product->product_name.'</p>
                                           
                                        </a>';
                        if($product->product_qty>0){

                                $output.='<button type="button" onclick="Addtocart(this.id);" class="btn btn-default" id="'.$product->product_id.'" name="add-to-cart" >Thêm vào giỏ hàng</button>
                                        </form>
                                        </div>

                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
                        }else{
                             $output.='<button type="button"" class="btn btn-default" name="add-to-cart" >Hết Hàng</button>
                                        </form>
                                        </div>

                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
                        }
                       }
                       echo $output;


    }

}

