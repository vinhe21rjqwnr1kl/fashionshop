@extends('main')

@section('content')
<form class="bg0 p-t-100 p-b-85" method="post">
    @include('admin.alert')
    @if(count($products) != 0)

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        @php $total = 0;  @endphp
                        <table class="table-shopping-cart">
                            <tbody><tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>

                            </tr>
                              @foreach ($products as $key => $product)
                              @php
                                  $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                  $priceEnd = $price * $carts[$product->id];
                                  $total += $priceEnd;
                              @endphp
                              <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ $product->thumb }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $product->name }}</td>
                                <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                <td class="column-4">
                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product[{{ $product->id }}]" value="{{ $carts[$product->id]  }}">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="column-5"> {{ number_format($priceEnd, 0, '', '.') }}</td>
                                <td class="p-r-15">
                                    <a href="/carts/delete/{{ $product->id }}">Xoá</a>
                                </td>
                            </tr>
                              @endforeach
                           

                          
                        </tbody>
                     
                    </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
                                
                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Apply coupon
                            </div>
                        </div>

                        <input type="submit" value="Update Cart" formaction="/update-cart" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                        
                        @csrf
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, 0, '', '.') }} Đ
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        {{-- <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Shipping:
                            </span>
                        </div> --}}

                        <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">
                            {{-- <p class="stext-111 cl6 p-t-2">
                                There are no shipping methods available. Please double check your address, or contact us if you need any help.
                            </p> --}}
                            
                            <div class="p-t-15">
                                <span class="stext-112 cl8">
                                    THÔNG TIN KHÁCH HÀNG
                                </span>

                                {{-- <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2 select2-hidden-accessible" name="time" tabindex="-1" aria-hidden="true">
                                        <option>Select a country...</option>
                                        <option>USA</option>
                                        <option>UK</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 143px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-time-s3-container"><span class="select2-selection__rendered" id="select2-time-s3-container" title="Select a country...">Select a country...</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <div class="dropDownSelect2"></div>
                                </div> --}}

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên Khách Hàng" >
                                </div>
                                 
                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số Điện Thoại" >
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa Chỉ Giao Hàng">
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email Liên Hệ">
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <textarea class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="content" placeholder="Ghi Chú"></textarea>
                                </div>
                          
                                
                            
                                    
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                {{ number_format($total, '0', '', '.') }} Đ
                            </span>
                        </div>
                    </div>

                        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Thanh toán COD
                        </button>
                 
                        
                       <!-- Nút Thanh toán MoMo -->
                        <button class="mt-3 flex-c-m stext-101 cl0 size-116 bg-danger bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Thanh toán MoMo
                        </button>

                        
                        
                        

                    
                </div>
            </div>
        </div>
        
    </div>
   
</form>
<form action="/payment"  method="POST" style="margin-left: 60%; margin-bottom: 20px">
    @csrf
    <input type="text" hidden name="total" value="{{ $total }}">
    <button type="submit"  id="vnpay-btn" name="redirect" class="mt-3 vnpay-button flex-c-m stext-101 cl0 size-116 bg-success bor14 hov-btn3 p-lr-15 trans-04 pointer">
        Thanh toán VNPay
    </button>
</form>


@else
<div class="text-center"><h2>Giỏ hàng trống</h2></div>
@endif

@endsection