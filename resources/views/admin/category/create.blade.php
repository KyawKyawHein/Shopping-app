@extends('admin.layout.master')

@section('content')
    <a href="{{route('admin.categories.index')}}" class="btn btn-primary btn-sm mb-2">All Category</a>
    <form action="{{route('admin.categories.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control mt-1" >
        </div>
        <div class="text-end mt-2">
            <button class="btn btn-outline-primary">Add Category</button>
        </div>
    </form>
@endsection