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
          <input type="text" name="name" value="{{ $slider->name }}" class="form-control"  >
        </div>

        <div class="form-group">
            <label for="menu">Đường Dẫn</label>
            <input type="text" name="url" value="{{ $slider->url }}" class="form-control"  >
        </div>
      

        <div class="form-group">
            <label for="menu">Ảnh Sản Phẩm</label>
            <input type="file"  class="form-control" id="upload"  >
            <div id="image_show" style="margin-top: 10px;">
                 <a href="{{ $slider->thumb }}">
                    <img src="{{ $slider->thumb }}" width="100px" alt="">
                 </a>
            </div>
            <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
        </div>
       
        <div class="form-group">
            <label for="menu">Sắp Xếp</label>
            <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control"  >
        </div>

        <div class="form-group">
            <label for="">Kích Hoạt</label>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
               {{ $slider->active == 1 ?'checked' : '' }}>
              <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" 
              {{ $slider->active == 0 ?'checked' : '' }}>
              <label for="no_active" class="custom-control-label">Không</label>
            </div>
           
          </div>
        

      </div>
      <!-- /.card-body -->
      
      <div class="card-footer">
        <a href="/admin/sliders/list" class="btn btn-primary">Trở Về</a>

        <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
      </div>
      
    </form>
  </div>
@endsection

