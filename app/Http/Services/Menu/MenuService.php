<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }
    public function show(){
        return Menu::select('name', 'id', 'thumb')
                    ->where('parent_id', 0)
                    ->orderbyDesc('id')
                    ->get();

    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            // Lấy giá trị ban đầu của slug
            $slug = Str::slug($request->input('name'), '-');

            // Kiểm tra sự tồn tại của slug
            if (Menu::where('slug', $slug)->exists()) {
                // Tạo số ngẫu nhiên
                $randomNumber = mt_rand(1000, 9999);
                // Kết hợp slug với số ngẫu nhiên
                $slug = $slug . '-' . $randomNumber;
            }

            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'thumb' => (string) $request->input('thumb'),
                'slug' => $slug,
            ]);

            Session::flash('success', 'Tạo Danh Mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function update($request, $menu)
    {
        if($request->input('parent_id') != $menu->id){
            $menu->parent_id = (int)$request->input('parent_id');

        }
        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->thumb = (string)$request->input('thumb');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();
        
        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }

    public function destroy($request){
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
    
    public function getId($id){
        return Menu::where('id', $id)
        ->where('active', 1)
        ->firstOrFail();
    }

    public function getProduct($menu, $request){
        $query =  $menu->products()
        ->select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1);

        if($request->input('price')){
              $query->orderBy('price', $request->input('price'));
        }
      return  $query->orderByDesc('id')
                    ->paginate(4)
                    ->withQueryString();
    }
}