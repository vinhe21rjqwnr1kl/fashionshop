<?php

namespace App\View\Composers;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

class CartComposer
{
    protected $users;

    /**
     * Create a new profile composer.
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
          $carts = Session::get('carts');

    // Debugging: Check if carts are set
    if (is_null($carts)) {
        $view->with('products', []);
        return;
    }

    // Debugging: Log the carts content
    \Log::info('Carts:', $carts);

    $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1)
        ->whereIn('id', $productId)
        ->get();
        $view->with('products', $products);
    }
}