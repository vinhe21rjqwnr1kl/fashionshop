<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductServiceScreen;

class ProductControllerScreen extends Controller
{
     protected $productServiceScreen;
     public function __construct(ProductServiceScreen $productServiceScreen)
     {
          $this->productServiceScreen = $productServiceScreen;
     }
     public function index($id = '', $slug = '')
     {
              $product = $this->productServiceScreen->show($id);
              $productMore = $this->productServiceScreen->more($id);

              return view('product.content', [
                   'title' => $product->name,
                   'product' => $product,
                   'products' => $productMore,


              ]);
     }

     // public function indexQuickView($id = '', $slug = '')
     // {
     //      $product = $this->productServiceScreen->show($id);
         

     //      $productMore = $this->productServiceScreen->more($id);

     //      return view('product.popup', [
     //           'title' => $product->name,
     //           'product' => $product,
     //           'products' => $productMore

     //      ]);
     // }
     public function getFeaturedProducts()
{
    $featuredProducts = Product::where('is_featured', true)->get();

    // Trả về partial view chứa danh sách sản phẩm nổi bật
    return view('product.featured_products', compact('featuredProducts'))->render();
}

public function getNewestProducts(Request $request) {
     $products = Product::orderBy('updated_at', 'desc')->paginate(16); // Lấy sản phẩm mới nhất theo thời gian tạo
 
     return view('product.newest_products',[
          'title' => 'Sản phẩm mới nhất'
     ], compact('products'));
 }

 public function search(Request $request)
{
    // Lấy giá trị tìm kiếm từ request
    $search = $request->input('search');

    // Tìm kiếm theo tên và email trong bảng `products`
    $products = Product::where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->get();

    // Trả về view kèm dữ liệu
    return view('search_results', compact('products'),[
     'title' => 'Kết quả tìm kiếm'
    ]);
}
     

}
