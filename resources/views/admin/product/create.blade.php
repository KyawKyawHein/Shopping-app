@props(['categories'])
@extends('admin.layout.master')

@section('content')
    <a href="{{route('admin.products.index')}}" class="btn btn-primary btn-sm mb-2">All Products</a>
    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <label for="name">Products Name</label>
            <input type="text" name="name" class="form-control mt-1" >
        </div>
        <div class="form-group mb-2">
            <label for="category">Category</label>
            <select name="category_id" class="form-control" id="category">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" >{{$category->name}}</option>
                @endforeach
            </select>
        </div>  
        <div class="form-group mb-2">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control mt-1" >
        </div>
        <div class="form-group mb-2">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group mb-2">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control mt-1" >
        </div>
        <div class="text-end mt-2">
            <button class="btn btn-outline-primary">Add product</button>
        </div>
    </form>
@endsection