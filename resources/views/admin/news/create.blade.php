@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection
@section('content')

<form action="{{ route('admin.news.store') }}" method="POST">
    @csrf
    <div class="container">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Ảnh</label>
            <input type="file" id="upload">
            <div id="image_show"></div>
            <input type="hidden" name="thumb" id="thumb">
        </div>
        <div class="form-group">
            <label>Nội dung</label>
            <textarea name="content" class="form-control"></textarea>
        </div>
       
    </div>
    <div class="card-footer">
        <a href="/admin/news/list" class="btn btn-danger">Trở Về</a>
        <button type="submit" class="ml-3 btn btn-success">Lưu Tin Tức</button>

      </div>
    
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('content');
</script>
@endsection