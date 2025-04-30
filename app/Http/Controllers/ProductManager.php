<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductManager extends Controller
{
    public function index(){
        $products = Product::query()->get();

        return view('products',compact('products'));
    }

    public function details($slug){
        $product = Product::query()->whereSlug($slug)->first();
        $isCarted = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();
        return view('details',compact('product','isCarted'));
    }

    public function addToCart($id){

        $user_id = auth()->user()->id;

       Cart::create([
            'user_id'=>$user_id,
            'product_id'=>$id,
        ]);

        return redirect()->back()->with("success",'Product add to cart successfully');
    }

    public function showCart(){
        $cartItems = DB::table("carts")
            ->join('products','carts.product_id', '=', 'products.id')
            ->select("carts.product_id",DB::raw("count(*) as quantity"), 'products.title', 'products.price', 'products.image')
            ->where("carts.user_id", auth()->user()->id)
            ->groupBy("carts.product_id", "products.title", "products.price", "products.image")
            ->get();

        return view('cart',compact('cartItems'));
    }
}
