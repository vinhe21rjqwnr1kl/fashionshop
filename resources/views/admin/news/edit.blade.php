
@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection
@section('content')

<form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
        </div>

        <div class="form-group">
            <label for="thumb">Thay đổi hình ảnh</label>
            <input type="file" class="form-control-file" id="upload" name="file">
            <input type="hidden" id="thumb" name="thumb" value="{{ $news->thumb }}">
        
            <div id="image_show">
                <!-- Hiển thị ảnh hiện tại -->
                @if($news->thumb)
                    <img src="{{ $news->thumb }}" alt="thumb" height="150px" style="margin-top: 10px;">
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $news->content }}</textarea>
        </div>
        
      
        
    </div>
  
    
    <div class="card-footer">
        <a href="/admin/products/list" class="btn btn-danger">Trở Về</a>

        <button type="submit" class=" ml-2 btn btn-success">Cập nhật</button>
    </div>
</form>

@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection