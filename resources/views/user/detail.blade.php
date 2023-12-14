@props(['product'])
@extends('user.layout.master')

@section("content")
    <div class="card col-12">
        <div class="card-header">
            <h4>{{$product->name}}</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <a href="{{route('productCart.addtocart',$product->slug)}}" class="text-decoration-none"><i class="fa-solid fa-cart-plus"></i></a>
                <p class=""><i class="fa-regular fa-eye"></i> : {{$product->view_count}} </p>
                <p class="badge bg-danger">{{$product->category->name}}</p>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="{{asset($product->image)}}" width="200px" alt="">
                <p class="">{{ $product->description }}</p>
            </div>

        </div>
    </div>
@endsection