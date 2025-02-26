@extends('admin.main')

@section('content')
<div class="card-footer">
  <a href="/admin/menus/add" class="btn btn-primary">Tạo Danh Mục</a>
</div>

   <table>
      <thead>
        <tr>
            <th style="width: 50px; padding-left: 15px;">ID</th>
            <th>Name</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 130px">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        {!! \App\Helpers\Helper::menu($menus) !!}
      </tbody>
   </table>
@endsection

