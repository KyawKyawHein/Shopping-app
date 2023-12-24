<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserPageController extends Controller
{
    public function index(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $products= Product::where('name',"like","%$search%")->latest()->with('category')->paginate(6);
        }else{
            $products = Product::latest()->with('category')->paginate(6);
        }
        return view('user.index',compact('products'));
    }
    public function show($slug){
        $product= Product::where('slug',$slug);
        $product->update([
            "view_count"=>DB::raw('view_count+1')
        ]);
        $product = $product->with('category')->first();
        return view('user.detail',compact('product'));
    }

    public function productByCategory($slug){
        $category_id = Category::where('slug',$slug)->first()->id;
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $products= Product::where('category_id',$category_id)->where('name',"like","%$search%")->latest()->with('category')->paginate(6);
        }else{
            $products= Product::where('category_id',$category_id)->latest()->with('category')->paginate(6);
        }
        return view('user.index',compact('products'));
    }

    // profile change
    public function changeProfile(){
        $user = Auth::user();
        return view('user.profile',compact('user'));
    }
    public function changeProfileHandler(Request $request){
        $request->validate([
            "name"=>['required','string'],
            "password"=>['required'],
            "image"=>['mimes:jpg,jpeg,png']
        ]);
        $user = Auth::user();
        if(!Hash::check($request->password,$user->password)){
            return redirect()->back()->with('fail',"Password is not match.");
        }else{
            if(!$request->image){
                $image = $user->image;
            }else{
             //delete old image
            $img_arr = explode('/',$user->first()->image);
            Storage::disk('image')->delete($img_arr[1]);
            //insert into database
            $img = $request->file('image');
            $img_name = uniqid().$img->getClientOriginalName();
            $path = "image/$img_name";
            $img->storeAs($path);
            $image = $path;
            }
            $user->update([
                "name"=>$request->name,
                "image"=>$image
            ]);
            return redirect()->back()->with('success',"Update successfully.");
        }
    }

    public function changePassword(){
        $user = Auth::user();
        return view('user.changePassword',compact('user'));
    }

    public function changePasswordHandler(Request $request){
        $user= auth()->user();
        $request->validate([
            'password'=>['required','confirmed']
        ]);
        $user->update([
            "password"=>bcrypt($request->password)
        ]);
        return redirect()->route('changeProfile')->with('success',"Update successfully");
    }
}
