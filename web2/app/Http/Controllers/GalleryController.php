<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Models\Gallery;
use App\CatePost;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;//thư viện trả về
session_start();

class GalleryController extends Controller
{
     public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('dashboard');
        } else {
           return Redirect::to('admin')->send();
        }
    }

    public function add_gallery($product_id){
        $this->AuthLogin(); 
        $pro_id = $product_id;
    	return view ('admin.gallery.add_gallery')->with('pro_id',$pro_id);
    }

    public function select_gallery(Request $request){
        $this->AuthLogin(); 
        $product_id = $request->pro_id; 
        $gallery = DB::table('tbl_gallery')->where('product_id',$product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<form>
                '.csrf_field().'
                <table class="table table-hover">
                                            <thead>
                                              <tr>
                                                <th>Thứ Tự</th>
                                                <th>Tên Hình</th>
                                                <th>Hình</th>
                                                <th>Quản Lý</th>
                                              </tr>
                                            </thead>
                                            <tbody>


        ';
        if ($gallery_count>0) {
            $i = 0;
            foreach ($gallery as $key => $value) {
                $i++;
                $output.='

                <tr>

                                                <td>'.$i.'</td>
                                                <td class="edit_gal_name">'.$value->gallery_name.'</td>
                                                <td><img src="'.url('public/uploads/gallery/'.$value->gallery_image).'" class="img-thumbnail" width="200" height="200"></td>
                                                <td>
                                                     <button type="button" data-gal_id="'.$value->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">Xóa</button>
                                                </td>
                                              </tr>
                                              </form>


                ';
            }
        }else{
             $output.='<tr>
                                                <td colspan="4">Sản Phẩm Này Chưa Có Ảnh</td>
                                              </tr>


                ';

        }
        $output.='</tbody>
                    </table>
                    </form>
                                                    


                ';
        echo $output;
    }   

    public function insert_gallery(Request $request,$pro_id){
        $this->AuthLogin(); 
        $gallery = array();
      
        $get_image = $request->file('file');
        if($get_image){
            foreach ($get_image as  $image) {
                $get_name_image = $image->getClientOriginalName(); 
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension(); 
                //Lấy đuôi mở rộng của hình vd: .png,.pdf
                $image->move('public/uploads/gallery',$new_image); 
                //Lấy hình từ thư mục public/upload/product trên máy
               
                $gallery['gallery_name'] = $new_image;
                $gallery['gallery_image'] = $new_image;
                $gallery['product_id'] = $pro_id;
                DB::table('tbl_gallery')->insert($gallery);
            }
        }

                Session::put('message','Thêm thư viện thành công');
                return Redirect()->back();
    }

    public function delete_gallery(Request $request){
            $this->AuthLogin(); 
            $gal_id = $request->gal_id;
            $gallery = Gallery::find($gal_id);

            unlink('public/uploads/gallery/'.$gallery->gallery_image);
            $gallery->delete();

    }   
}
