<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductCartController extends Controller
{
    public function index(){
        $cartItems = ProductCart::where('user_id',Auth::id())->with('product')->get();
        return view('user.cart',compact('cartItems'));
    }

     public function addtocart($slug){
        $product = Product::where('slug',$slug)->first();
        if(!Auth::check()){
            return redirect()->route('login');
        }else{
            $user_id = Auth::id();
            //check product is already in cart table or not, if table has product, add +1 to qty
            $isCartHasProduct = ProductCart::where('user_id',$user_id)->where('product_id',$product->id);
            if($isCartHasProduct->first()){
                $isCartHasProduct->update([
                    "qty" => DB::raw("qty+1")
                ]);
            }else{
                ProductCart::create([
                    "product_id"=> $product->id,
                    "user_id"=>$user_id,
                    "qty"=>1
                ]);
            }
            return redirect()->back()->with("success","Product is added.");
        }
    }
    public function removeFromCart($slug){
        $product = Product::where('slug',$slug)->first();
         if(!Auth::check()){
            return redirect()->route('login');
        }else{
            $user_id = Auth::id();
            //check product is already in cart table or not, if table has product, add -1 to qty
            $isCartHasProduct = ProductCart::where('user_id',$user_id)->where('product_id',$product->id);
            if($isCartHasProduct->first()){
                if($isCartHasProduct->first()->qty ==1){
                    $isCartHasProduct->delete();
                    return redirect()->back()->with('success',"Product is deleted from cart.");
                }else{
                    $isCartHasProduct->update([
                        "qty" => DB::raw("qty-1")
                    ]);
                }
            }else{
                return redirect()->route('user.dashboard');
            }
            return redirect()->back()->with("success","Product is removed from cart.");
        }
    }
      public function orderProduct(){
        $user_id = Auth::id();
        $products_from_cart = ProductCart::where('user_id',$user_id)->get();
        //add order to product_orders table
        foreach($products_from_cart as $p){
            ProductOrder::create([
                'product_id'=>$p->product_id,
                "user_id"=>$user_id,
                "qty"=>$p->qty
            ]);
        }
        // after adding order,delete items from cart table
        foreach($products_from_cart  as $p){
            $p->delete();
        }
        return redirect()->route('user.dashboard')->with('success',"Orders make successfully.");
    }
}
