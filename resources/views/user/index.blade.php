@props(['products'])
@extends('user.layout.master')

@section("content")
        @if(isset($_GET['search']))
            <a href="{{URL::previous()}}" class="mb-3 btn btn-danger">All Product</a>
        @endif
    <div class="product-container row">
        @foreach ($products as $product)
            <div class="card col-12 col-md-4 mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <img src="{{asset($product->image)}}" width="150px" alt="">
                    </div>
                    <h5 class="text-primary text-center"><a href="{{ route('product.show',$product->slug) }}" class="text-decoration-none">{{$product->name}}</a></h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fw-bold">{{$product->price}}MMK</p>
                        <p class="badge bg-danger">{{$product->category->name}}</p>
                    </div>
                    <div class="">
                        <a href="{{route('productCart.addtocart',$product->slug)}}" class="btn btn-primary w-100">Add to cart</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $products->links() }}
    </div>
@endsection