@props(['cartItems'])
@extends('user.layout.master')

@section("content")
            @if(!count($cartItems))
                <p class="alert alert-danger">There is no cart. <a href="/" class="btn btn-danger btn-sm">Add to cart</a></p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Control</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td><img src="{{asset($item->product->image)}}" width="90px" alt=""></td>
                            <td>{{$item->qty}}</td>
                            <td>
                                <a href="{{route('productCart.addtocart',$item->product->slug)}}" class="btn btn-sm btn-warning">+</a>
                                <a href="{{route('productCart.removefromcart',$item->product->slug)}}" class="btn btn-sm btn-danger">-</a>
                            </td>
                            <td>{{$item->product->price}}</td>
                            <td>{{$item->qty * $item->product->price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-end mt-2">
                    <a href="{{route('productCart.order')}}" class="btn btn-primary">Order Now</a>
                </div>
            @endif
@endsection
