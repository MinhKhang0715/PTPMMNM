@extends('admin_layout')
@section('admin_content')      
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Danh Mục Sản Phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <?php 
        $message = Session::get('message');
            if($message){
              echo '<span class="text-alert">',$message.'</span>';
              Session::put('message',null);
            }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <!-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> -->
            <th>Tên Danh Mục</th>
            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <!-- Hàm gọi dữ liệu đã lấy từ function category đổ vào table -->
          @foreach($all_category_product as $key => $cate_pro) 
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $cate_pro->category_name }}</td>
            <td><span class="text-ellipsis">

              <!-- Ẩn Hiện sản phẩm theo status -->
              <?php
              if($cate_pro->category_status == 0){
                ?>
                  <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a> 
                <!--icon ẩn sản phẩm , a href khi click dựa vào id trên DB thay đổi status = 0,$cate_pro lấy giá trị id -->
                <?php

                 }else{

                 ?>   
               
                  <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a> <!-- icon hiện sản phẩm phương thức y như trên -->
                  <?php
                }
              ?>
            </span></td>

            <!-- Nút edit Danh mục sản phẩm -->
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active stying-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>

            </td>
          </tr>
         @endforeach

        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!! $all_category_product->links() !!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection            