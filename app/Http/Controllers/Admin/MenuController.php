<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Menu\CreateFormRequest;

class MenuController extends Controller
{
   protected $menuService;
   

   public function __construct(MenuService $menuService)
   {
      $this->menuService = $menuService;
   }
   public function create(){
     return view('admin.menu.add', [
        'title' => 'Thêm Danh Mục Mới',
        'menus' => $this->menuService->getParent()
     ]);
   }
   public function store(CreateFormRequest $request){
      // dd($request->input());
      $result = $this->menuService->create($request);
      if($result){
         return redirect('/admin/menus/list');
      }
      return redirect()->back();
   }
   public function index(){
      return view('admin.menu.list', [
         'title' => 'Danh sách Danh Mục Mới Nhất',
         'menus' => $this->menuService->getAll()
      ]);
   }
   public function show(Menu $menu){
       // Kiểm tra nếu không tìm thấy menu
    if (!$menu) {
      // Tạo một thông báo session
      Session::flash('error', 'Sản phẩm không tồn tại');
      
      // Chuyển hướng về trang danh sách menu hoặc một trang khác
      return redirect()->route('admin.menus.index');
  }

      return view('admin.menu.edit', [
         'title' => 'Chỉnh Sửa Danh Mục: ' . $menu->name,
         'menu' => $menu,
         'menus' => $this->menuService->getParent()

      ]);
   }
   public function update(Menu $menu, CreateFormRequest $request){
      $result =  $this->menuService->update($request, $menu);
      if($result){
         return redirect('/admin/menus/list');
      }
      return redirect()->back();
   }
   public function destroy(Request $request): JsonResponse{
      $result = $this->menuService->destroy($request);
      if($result){
         return response()->json([
            'error' => false,
            'message' => 'Xoá thành công danh mục'
         ]);

        
      }
      return response()->json([
         'error' => true,
         
      ]);
   }
   public function    showDetail(Menu $menu){
      // Kiểm tra nếu không tìm thấy menu
   if (!$menu) {
     // Tạo một thông báo session
     Session::flash('error', 'Sản phẩm không tồn tại');
     
     // Chuyển hướng về trang danh sách menu hoặc một trang khác
     return redirect()->route('admin.menus.index');
 }

     return view('admin.menu.detail', [
        'title' => 'Chi tiết sản phẩm: ' . $menu->name,
        'menu' => $menu,
        'menus' => $this->menuService->getParent(),
        'parentName' => $menu->parent ? $menu->parent->name : 'Không có danh mục cha',
       

     ]);
  }
}