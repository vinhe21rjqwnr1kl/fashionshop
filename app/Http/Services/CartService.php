<?php


namespace App\Http\Services;
use Session;
use App\Models\Cart;
use App\Jobs\SendMail;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function create($request){
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if($qty <= 0 || $product_id <= 0){
               Session::flash('error', 'Số lượng sản phẩm không chính xác');
               return false;
        }

        $carts = Session::get('carts');
        // dd($carts);
        if(is_null($carts)){        
           Session::put('carts', [
                $product_id => $qty
            ]);
        return true;
        }
    
        $exists = Arr::exists($carts, $product_id);
        if($exists){
            $carts[$product_id]  =  $carts[$product_id] + $qty ;
            Session::put('carts', $carts);
            return true;
          }
          $carts[$product_id] = $qty;
          Session::put('carts', $carts);

        return true;
    
    }

    public function getProduct(){
        $carts = Session::get('carts');
        if(is_null($carts)) return [] ;

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1)
        ->whereIn('id', $productId)
        ->get();
    }

    public function update($request){
        Session::put('carts', $request->input('num_product'));

        return true;

    }

    public function remove($id){
        $carts = Session::get('carts');

        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;

    }

    public function addCart($request){
        try{
            DB::beginTransaction();
            $carts = Session::get('carts');
            if(is_null($carts)) return false ;

           $customer = Customer::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'content' => $request->input('content')
           ]);
               
           $this->infoProductCart($carts, $customer->id);

           DB::commit();

           Session::flash('success', 'Đặt Hàng Thành Công');


           #Queue
           SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(3));


           Session::forget('carts');
           
        }catch(\Exception $err){
            DB::rollback();
            Session::flash('error', 'Đặt Hàng Lỗi . Vui lòng thử lại sau');
            return false;
        }
        return true;
    }
    
    protected function infoProductCart($carts, $customer_id){
       
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1)
        ->whereIn('id', $productId)
        ->get();

        $data = [];
        foreach($products as $product){
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price

           ];

         return Cart::insert($data);
        }
    }

    public function getCustomer(){
        return Customer::orderByDesc('id')->paginate(8);
    }

    public function getProductForCart($customer)
    {
        return  $customer->carts()->with(['product' => function ($query){
            $query->select('id','thumb', 'name');
     }])->get();
    }


    #WishLish

    public function createWish($request){
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if($qty <= 0 || $product_id <= 0){
               Session::flash('error', 'Số lượng sản phẩm không chính xác');
               return false;
        }

        $wishlishs = Session::get('wishlishs');
        // dd($carts);
        if(is_null($wishlishs)){        
           Session::put('wishlishs', [
                $product_id => $qty
            ]);
        return true;
        }
    
        $exists = Arr::exists($wishlishs, $product_id);
        if($exists){
            $wishlishs[$product_id]  =  $wishlishs[$product_id] + $qty ;
            Session::put('wishlishs', $wishlishs);
            return true;
          }
          $wishlishs[$product_id] = $qty;
          Session::put('wishlishs', $wishlishs);

        return true;
    
    }

    public function getProductWish(){
        $wishlishs = Session::get('wishlishs');
        if(is_null($wishlishs)) return [] ;

        $productId = array_keys($wishlishs);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1)
        ->whereIn('id', $productId)
        ->get();
    }



}