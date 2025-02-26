@extends('admin.main')


@section('content')
<div class="card card-primary">
   
    <!-- /.card-header -->
    <!-- form start -->
    <form action="" method="POST">
        @csrf
      <div class="card-body">

        <div class="form-group">
          <label for="menu">Tiêu Đề</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control"  >
        </div>

        <div class="form-group">
            <label for="menu">Đường Dẫn</label>
            <input type="text" name="url" value="{{ old('url') }}" class="form-control"  >
        </div>
      

        <div class="form-group">
            <label for="menu">Ảnh Sản Phẩm</label>
            <input type="file"  class="form-control" id="upload"  >
            <div id="image_show" style="margin-top: 10px;">
                 
            </div>
            <input type="hidden" name="thumb" id="thumb">
        </div>
       
        <div class="form-group">
            <label for="menu">Sắp Xếp</label>
            <input type="number" name="sort_by" value="1" class="form-control"  >
        </div>

        <div class="form-group">
            <label for="">Kích Hoạt</label>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
              <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
              <label for="no_active" class="custom-control-label">Không</label>
            </div>
           
          </div>
        

      </div>
      <!-- /.card-body -->
      
      <div class="card-footer">
        <a href="/admin/sliders/list" class="btn btn-primary">Trở Về</a>

        <button type="submit" class="btn btn-primary">Tạo Slider</button>
      </div>
      
    </form>
  </div>
@endsection

