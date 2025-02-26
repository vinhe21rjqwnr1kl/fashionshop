@extends('admin.main')

@section('content')


   <table>
      <thead>
        <tr>
            <th style="width: 50px; padding-left: 15px;">ID</th>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Ngày Đặt Hàng</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($customers as $key => $customer)
        <tr>
            <td style="width: 50px; padding-left: 15px;">{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->phone}}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->created_at }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}">
                    <i class="fas fa-eye"></i>
                </a>
               
            </td>
        </tr>
        @endforeach
        
      </tbody>
   </table>
   {{  $customers->links('pagination::bootstrap-4')  }}
@endsection

