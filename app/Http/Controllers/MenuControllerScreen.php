<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class MenuControllerScreen extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuService->getId($id);
        // dd($menu);
        $products = $this->menuService->getProduct($menu, $request);
        return view('menu', [
             'title' => $menu->name,
             'products' => $products,
             'menus' => $menu,
             
        ]);
    }
}
