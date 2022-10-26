@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê users
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
                                echo '<span class="text-alert">'.$message.'</span>';
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
          
            <th>Tên user</th>
            <th>Email</th>
            <th>Phone</th>
            
            <th>Admin</th>
            <th>Product</th>
            <th>Thương hiệu</th>
            <th>Danh mục</th>
            <th>Đơn hàng</th>
            <th>Slider</th>
            <th>Thống kê</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($admin as $key => $user)
            <form action="{{url('/assign-roles')}}" method="POST">
              @csrf
              <tr>
               
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{ $user->admin_name }}</td>
                <td>{{ $user->admin_email }} <input type="hidden" name="admin_email" value="{{ $user->admin_email }}"></td>
                <td>{{ $user->admin_phone }}</td>
                
                <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="product_role" {{$user->hasRole('product') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="brand_role"  {{$user->hasRole('brand') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="category_role"  {{$user->hasRole('category') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="order_role"  {{$user->hasRole('order') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="slider_role"  {{$user->hasRole('slider') ? 'checked' : ''}}></td>
                 <td><input type="checkbox" name="stat_role"  {{$user->hasRole('stat') ? 'checked' : ''}}></td>
              <td>

                  
                <a href="{{URL::to('/edit-auth/'.$user->admin_id)}}" class="active stying-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                 <input type="submit" value="Assign roles" class="btn btn-sm btn-default">
                <a onclick="return confirm('Bạn có muốn xóa user này không')" href="{{url('/delete-user-roles/'.$user->admin_id)}}" class="active styling-delete" ui-toggle-class="">  
                <i class="fa fa-times text-danger text"></i>
              </td> 

              </tr>
            </form>
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
            {!!$admin->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection