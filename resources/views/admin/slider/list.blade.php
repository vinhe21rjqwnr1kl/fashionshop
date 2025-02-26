@extends('admin.main')

@section('content')
<div class="card-footer">
    <a href="/admin/sliders/add" class="btn btn-primary">Tạo Slider</a>
  </div>

   <table>
      <thead>
        <tr>
            <th style="width: 50px; padding-left: 15px;">ID</th>
            <th>Tiêu Đề</th>
            <th>Ảnh</th>
            <th>Role</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sliders as $key => $slider)
        <tr>
            <td style="width: 50px; padding-left: 15px;">{{ $slider->id }}</td>
            <td>{{ $slider->name }}</td>
            <td>{{ $slider->url }}</td>
            <td>
                <a href="{{ $slider->thumb }}" target="_blank" > 
                <img src="{{ $slider->thumb }}" alt="" height="40px">
            </a>
        </td>
            <td>{!! \App\Helpers\Helper::active($slider->active)  !!}</td>
            <td>{{ $slider->updated_at }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="#" onClick="removeRow({{ $slider->id }} ,'/admin/sliders/destroy')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
        
      </tbody>
   </table>
   {!!  $sliders->links('pagination::bootstrap-4')  !!}
@endsection

