@props(['product'])
@extends('admin.layout.master')
@section('content')
    <a href="{{route('admin.products.index')}}" class="btn btn-primary btn-sm">All Products</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>View Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $product->name}}</td>
                <td>
                    <img src="{{asset($product->image)}}" width="50px" alt="">
                </td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->view_count}}</td>
            </tr>
        </tbody>
    </table>
    <p class="mt-3">{{$product->description}}</p>
@endsection