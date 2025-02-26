<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use App\Http\Requests\Product\ProductRequest;


class ProductController extends Controller
{
    protected $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product.list', [
            'title' => 'Danh Sách Sản Phẩm',
            'products' => $this->productService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $result = $this->productService->insert($request);
        if($result){
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Trang Sửa Sản Phẩm',
            'product' => $product,
            'menus' => $this->productService->getMenu()

        ]);
    }

    
    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if($result){
            return redirect( '/admin/products/list');

        }
        return redirect()->back();

    }

    public function showDetail(Product $product)
    {
        return view('admin.product.detail', [
            'title' => 'Trang Chi Tiết Sản Phẩm',
            'product' => $product,
            'menus' => $this->productService->getMenu()

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công sản phẩm'
            ]);
        }
        return response()->json([ 'error' => false]);
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::where('name', 'like', "%$query%")
                ->paginate(10);

    return view('admin.product.list',[
        'title' => 'Kết quả tìm kiếm'
    ], compact('products'))->with('query', $query);
}
}