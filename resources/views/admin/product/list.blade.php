@extends('admin.main')

@section('content')
<div class="card-footer">
    <a href="/admin/products/add" class="btn btn-primary">Tạo Sản Phẩm</a>
  </div>
<!-- Form tìm kiếm -->
<form action="{{ route('admin.products.search') }}" method="GET" class="form-inline mb-3">
    <input type="text" name="query" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request('query') }}">
    <button type="submit" class="btn btn-primary ml-2">Tìm kiếm</button>
</form>
   <table>
      <thead>
        <tr>
            <th style="width: 50px; padding-left: 15px;">ID</th>
            <th style="width: 23%;">Tên Sản Phẩm </th>
            <th>Danh Mục</th>
            <th>Giá Gốc</th>
            <th>Giá Khuyễn Mãi</th>
            <th>Active</th>
            <th>Update</th>
            <th>Feature</th>
            <th style="width: 130px">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $key => $product)
        <tr>
            <td style="width: 50px; padding-left: 15px;">{{ $product->id }}</td>
            <td class="d-inline-block " style="max-width: 220px;">{{ $product->name }}</td>
            <td>{{ $product->menu ? $product->menu->name : 'Không có danh mục' }}</td>
            <td>{{ $product->price }}</td>
            <td style="padding-left: 30px;
}">{{ $product->price_sale }}</td>
            <td>{!! \App\Helpers\Helper::active($product->active)  !!}</td>
            <td>{{ $product->updated_at }}</td>
            <td>
                @if ($product->is_featured == 0)
                    <span class="badge badge-danger btn-xs">NO</span>
                @else
                    <span class="badge badge-success btn-xs">YES</span>
                @endif
            </td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="/admin/products/detail/{{ $product->id }}">
                    <i class="fas fa-eye"></i>
               </a>
                <a class="btn btn-danger btn-sm" href="#" onClick="removeRow({{ $product->id }} ,'/admin/products/destroy')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
        
      </tbody>
   </table>
   {{ $products->appends(['query' => request('query')])->links('pagination::bootstrap-4') }}@endsection

