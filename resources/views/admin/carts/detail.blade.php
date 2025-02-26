@extends('admin.main')

@section('content')
<div class="customer mt-5">
    <ul>
        <li>Tên Khách Hàng : <strong>{{ $customer->name }}</strong></li>
        <li>Số Điện Thoại : <strong>{{ $customer->phone }}</strong></li>
        <li>Địa Chỉ : <strong>{{ $customer->address }}</strong></li>
        <li>Email : <strong>{{ $customer->email }}</strong></li>
        <li>Ghi Chú : <strong>{{ $customer->content }}</strong></li>

    </ul>
</div>

 <div class="carts mt-5">
    @php $total = 0;  @endphp
    <table class="table">
        <tbody><tr class="table_head">
            <th class="column-1">IMG</th>
            <th class="column-2">Product Name</th>
            <th class="column-3">Price</th>
            <th class="column-4">Quantity</th>
            <th class="column-5">Total</th>

        </tr>
          @foreach ($carts as $key => $cart)
          @php
              $price = $cart->price * $cart->pty;
              $total += $price;
          @endphp
          <tr>
            <td class="column-1">
                <div class="how-itemcart1">
                    <a href="{{ $cart->product->thumb }}" target="_blank" > 
                    <img src="{{ $cart->product->thumb }}" width="100px" target="_blank" alt="IMG">
                </div>
            </td>
            <td class="column-2">{{ $cart->product->name }}</td>
            <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
            <td class="column-4">{{ $cart->pty }}</td>

            <td class="column-5"> {{ number_format($price, 0, '', '.') }}</td>
           
        </tr>
          @endforeach

          <tr>
            <td colspan="4" class="text-right">Tổng Tiền : </td>
            <td>{{ number_format($total, 0, '', '.') }}</td>
          </tr>
       

      
    </tbody>
 
</table>
 </div>
@endsection

