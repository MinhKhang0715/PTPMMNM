@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Đơn Hàng
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
            <!--             <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> -->
            <th>Tên Người Đặt Hàng</th>
            <th>Ngày Đặt Hàng</th>
            <th>Tình Trạng</th>
            <th>Tình Trạng</th>
            <th>Hiển Thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <!-- Hàm gọi dữ liệu đã lấy từ function order đổ vào table -->
          @foreach($all_order as $key => $order)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{$order->customer_name }}</td>
            <td>{{$order->created_at}}</td>

            <td><span class="text-ellipsis">

                <!-- Ẩn Hiện sản phẩm theo status -->
                <?php
                if ($order->order_status == 0) {
                ?>
                  Đang Chờ Xử Lý
                  <!--icon ẩn sản phẩm , a href khi click dựa vào id trên DB thay đổi status = 0,$pro lấy giá trị id -->
                <?php

                } elseif ($order->order_status == 1) {

                ?>

                  Đã Xong
                <?php
                } else {
                ?>
                  Đơn hàng đã bị hủy bỏ
                <?php
                }
                ?>

              </span></td>

            <td><span class="text-ellipsis">

                <!-- Ẩn Hiện sản phẩm theo status -->
                <?php
                if ($order->order_status == 0) {
                ?>
                  <a href="{{URL::to('/unactive-order/'.$order->order_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>

                <?php

                } elseif ($order->order_status == 1) {

                ?>

                  <a href="{{URL::to('/active-order/'.$order->order_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                } elseif ($order->order_status == 2) {
                ?>
                  Đơn Hàng Đã Bị Hủy Bỏ
                <?php
                }
                ?>

              </span></td>




            <!-- Nút xóa đơn hàng  -->
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active stying-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <?php
              if ($order->order_status == 0) {
              ?>
                <a onclick="return confirm('Bạn có muốn hủy đơn hàng này không')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-delete" ui-toggle-class=""></a>
                <i class="fa fa-times text-danger text"></i>

              <?php

              } elseif ($order->order_status == 1) {

              ?>

                <a onclick="return confirm('Bạn có muốn hủy đơn hàng này không')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-delete" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                <?php
              } elseif ($order->order_status == 2) {
                ?>
                  <a onclick="return confirm('Bạn có muốn khôi phục hàng này không')" href="{{URL::to('/return-order/'.$order->order_id)}}" class="active styling-delete" ui-toggle-class="">
                    <i class="fa fa-check text-check text"></i>
                  <?php
                }
                  ?>


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
            {!! $all_order->links() !!}

          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection