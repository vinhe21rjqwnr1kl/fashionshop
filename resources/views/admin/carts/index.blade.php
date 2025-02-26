@extends('admin.main')

@section('content')
<table >
    <thead>
        <tr>
            <th style="width: 50px; padding-left: 15px;">ID</th>
            <th>Mã Đơn Hàng</th>
            <th>Số Tiền</th>
            <th>Nội Dung</th>
            <th>Mã Phản Hồi</th>
            <th>Mã Giao Dịch</th>
            <th>Mã Ngân Hàng</th>
            <th>Thời Gian</th>
            <th>Kết Quả</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td style="width: 50px; padding-left: 15px;">{{ $payment->id }}</td>
                <td>{{ $payment->madonhang }}</td>
                <td>{{ $payment->sotien }}</td>
                <td>{{ $payment->noidung }}</td>
                <td>{{ $payment->maphanhoi }}</td>
                <td>{{ $payment->magiaodich }}</td>
                <td>{{ $payment->manganhang }}</td>
                <td>{{ $payment->thoigian }}</td>
                <td>{{ $payment->ketqua }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{  $payments->links('pagination::bootstrap-4')  }}
@endsection