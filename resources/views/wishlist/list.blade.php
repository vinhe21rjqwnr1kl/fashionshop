<!-- resources/views/wishlist/list.blade.php -->
@extends('main')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="container bg0 p-t-100 p-b-85">
    <h2>{{ $title }}</h2>
    @if($products->isEmpty())
        <div class="text-center"><h3>Danh sách yêu thích trống</h3></div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Img</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Like</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="how-itemcart1">
                            <img src="{{ $product->thumb }}" alt="IMG">
                        </div>
                    </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price_sale ?? $product->price }}</td>
                        <td>{{ session('wishlists')[$product->id] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
