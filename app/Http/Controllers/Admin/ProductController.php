<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(3);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> ['required','string'],
            "category_id"=> ['required'],
            "description"=>['required'],
            'image'=>['required','mimes:jpg,jpeg,png'],
            'price'=>['required'],
        ]);

        // store image 
        $file = $request->file('image');
        $imgName = uniqid().$file->getClientOriginalName();
        $path = 'image/'.$imgName;
        $file->storeAs($path);
        

        // store to database
        $product=Product::create([
            "name" =>$request->name,
            "slug" => Str::slug($request->name),
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            "image"=>"image/$imgName",
            "price"=>"$request->price",
            "view_count"=>0
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('admin.product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id',$id)->with('category')->first();
        $categories = Category::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            "name"=> ['required','string'],
            "category_id"=> ['required'],
            "description"=>['required'],
            'image'=>['required','mimes:jpg,jpeg,png'],
            'price'=>['required'],
        ]);
        $product = Product::find($id);

        if($request->file('image')){
            // delete old image
            $img_arr = explode('/',$product->image);
            Storage::disk('image')->delete($img_arr[1]);
            //new file
            $file = $request->file('image');
            $file_name = uniqid().$file->getClientOriginalName();
            $path = "image/$file_name";
            $file->storeAs($path);
        }else{
            $path = $product->image;
        }   

        // add to database
        $product->update([
            "name" =>$request->name,
            "slug" => Str::slug($request->name),
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            "image"=>$path,
            "price"=>"$request->price",
        ]);

        return redirect()->route('admin.products.index')->with('success',"Post is successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $img_arr = explode('/',$product->image);
        Storage::disk('image')->delete($img_arr[1]);

        $product->delete();
        return redirect()->back()->with('success',"Post is deleted successfully.");
    }
}
