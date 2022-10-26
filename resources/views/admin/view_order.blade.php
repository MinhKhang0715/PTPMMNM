@extends('admin_layout')
@section('admin_content')    

        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông Tin Người Mua
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
            <th>Tên Người Đặt Hàng</th>
            <th>Sđt</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
         
          <tr>
            
            <td>{{$order_by_id->customer_name}}</td>
            <td>{{$order_by_id->customer_phone}}</td>
      

            

          </tr>


        </tbody>
      </table>
    </div>
    
  </div>
</div>

<br><br>
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông Tin Vận Chuyển
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
            <th>Tên Người Nhận Hàng</th>
            <th>Địa Chỉ</th>
            <th>Số Điện Thoại</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
         
          <tr>
            
            <td>{{$order_by_id->shipping_name}}</td>
            <td>{{$order_by_id->shipping_address}}</td>
            <td>{{$order_by_id->shipping_phone}}</td>
            

            

          </tr>


        </tbody>
      </table>
    </div>
    
  </div>
</div>

<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Chi Tiết Đơn Hàng
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Giá</th>
            <th>Tổng Tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($order_d as $v_content)
          <tr>

            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$v_content->product_name}}</td>
            <td>{{$v_content->product_sales_quantity}}</td>
            <td>{{$v_content->product_price}}</td>
            <td>{{$v_content->product_price*$v_content->product_sales_quantity}}</td>
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
           

          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection            