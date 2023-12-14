@props(['product','categories'])
@extends('admin.layout.master')

@section('content')
    <a href="{{route('admin.products.index')}}" class="btn btn-primary btn-sm mb-2">All Products</a>
    <form action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group mb-2">
            <label for="name">Products Name</label>
            <input type="text" value="{{$product->name}}" name="name" class="form-control mt-1" >
        </div>
        <div class="form-group mb-2">
            <label for="category">Category</label>
            <select name="category_id" class="form-control" id="category">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ $category->id==$product->category->id ? 'selected':'' }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>  
        <div class="form-group mb-2">
            <label for="price">Price</label>
            <input type="number" value="{{$product->price}}" name="price" id="price" class="form-control mt-1" >
        </div>
        <div class="form-group mb-2">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{$product->description}}</textarea>
        </div>
        <div class="form-group mb-2">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control mt-1" >
            <img src="{{asset($product->image)}}" width="100px" alt="">
        </div>
        <div class="text-end my-2">
            <button class="btn btn-outline-primary">Edit product</button>
        </div>
    </form>
@endsection