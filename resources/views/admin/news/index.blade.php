
@extends('admin.main')

@section('content')
<div class="card-footer">
    <a href="{{ route('admin.news.create') }}" class="btn btn-info">Thêm tin tức</a>
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
            @foreach($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><img src="{{ $item->thumb }}" width="100"></td>
                    <td>{{ $item->title }}</td>     
                    <td>
                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning">Sửa</a>
                        <button class="btn btn-danger" onclick="removeRow({{ $item->id }}, '{{ route('admin.news.destroy', $item->id) }}')">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
