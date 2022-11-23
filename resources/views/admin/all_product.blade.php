@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Sản Phẩm
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
      if ($message) {
        echo '<span class="text-alert">', $message . '</span>';
        Session::put('message', null);
      }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <!--  <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>  -->
            <th>Tên Sản Phẩm</th>
            <th>Giá</th>
            <th>Hình Sản Phẩm</th>
            <th>Thư Viện Ảnh</th>
            <th>Số lượng</th>
            <th>Danh Mục</th>
            <th>Thương hiệu</th>

            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <!-- Hàm gọi dữ liệu đã lấy từ function product đổ vào table -->
          @foreach($all_product as $key => $pro)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $pro->product_name }}</td>
            <td>{{ number_format($pro->product_price) }}</td>
            <!-- Lấy hình từ file-->
            <td><img src="public/uploads/product/{{ $pro->product_image }}" height="150" width="150"> </td>
            <td><a href="{{URL::to('/add-gallery/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-folder-open"></span></a></td>
            <td>{{ $pro->product_qty }}</td>
            <td>{{ $pro->category_name }}</td>
            <td>{{ $pro->brand_name }}</td>
            <td><span class="text-ellipsis">

                <!-- Ẩn Hiện sản phẩm theo status -->
                <?php
                if ($pro->product_status == 0) {
                ?>
                  <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                  <!--icon ẩn sản phẩm , a href khi click dựa vào id trên DB thay đổi status = 0,$pro lấy giá trị id -->
                <?php

                } else {

                ?>

                  <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a> <!-- icon hiện sản phẩm phương thức y như trên -->
                <?php
                }
                ?>
              </span></td>

            <!-- Nút edit Danh mục sản phẩm -->
            <!-- Nút xóa Danh mục sản phảm -->
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active stying-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <!-- Hỏi trước khi xóa -->
              <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-delete" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
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
            {!! $all_product->links() !!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection