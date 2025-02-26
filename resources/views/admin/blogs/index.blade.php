
@extends('admin.main')

@section('content')
<div class="card-footer">
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-info">Thêm bài đăng</a>
  </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><img src="{{ $item->thumb }}" width="100"></td>
                    <td>{{ $item->title }}</td>     
                    <td>
                        <a href="{{ route('admin.blogs.edit', $item->id) }}" class="btn btn-warning">Sửa</a>
                        <button class="btn btn-danger" onclick="removeRow({{ $item->id }}, '{{ route('admin.blogs.destroy', $item->id) }}')">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
