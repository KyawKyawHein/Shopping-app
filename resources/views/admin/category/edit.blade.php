@props(['category'])
@extends('admin.layout.master')

@section('content')
    <a href="{{route('admin.categories.index')}}" class="btn btn-primary btn-sm mb-2">All Category</a>
    <form action="{{route('admin.categories.update',$category->id)}}" method="post">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" value="{{$category->name}}"  name="name" class="form-control mt-1" >
        </div>
        <div class="text-end mt-2">
            <button class="btn btn-outline-primary">Update Category</button>
        </div>
    </form>
@endsection