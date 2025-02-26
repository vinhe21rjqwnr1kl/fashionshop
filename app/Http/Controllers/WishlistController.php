<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index(Request $request)
{
    $result = $this->createWish($request);
    if (!$result) {
        return redirect()->back();
    }

    // Sau khi thêm vào wishlist, chuyển về trang chủ
    return redirect('/')->with('message', 'Sản phẩm đã được thêm vào wishlist.');
}

    public function show()
    {
        $products = $this->getProductWish();
        return view('wishlist.list', [
            'title' => 'Lượt Thích',
            'products' => $products,
            'wishlists' => Session::get('wishlists')
        ]);
    }
    private function createWish(Request $request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');
    
        if ($qty < 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng sản phẩm không chính xác');
            return response()->json(['success' => false, 'error' => 'Số lượng sản phẩm không chính xác']);
        }
    
        $wishlists = Session::get('wishlists', []);
    
        // Kiểm tra sản phẩm có trong wishlist chưa để toggle
        if (Arr::exists($wishlists, $product_id)) {
            unset($wishlists[$product_id]); // Xóa sản phẩm khỏi wishlist
        } else {
            $wishlists[$product_id] = $qty; // Thêm sản phẩm vào wishlist
        }
    
        Session::put('wishlists', $wishlists);
        return response()->json(['success' => true, 'message' => 'Cập nhật wishlist thành công']);
    }
    
    
    private function getProductWish()
{
    $wishlists = Session::get('wishlists', []);
    if (empty($wishlists)) return collect(); // Trả về một Collection rỗng

    $productIds = array_keys($wishlists);
    return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1)
        ->whereIn('id', $productIds)
        ->get(); // Phương thức get() sẽ trả về một Collection
}

}