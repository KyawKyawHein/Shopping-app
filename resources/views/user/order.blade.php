@props(['orders'])
@extends('user.layout.master')

@section("content")
            @if(!count($orders))
                <p class="alert alert-danger">Sorry, there is no complete. <a href="/" class="btn btn-danger btn-sm">Make an order.</a></p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td><img src="{{asset($item->product->image)}}" width="90px" alt=""></td>
                            <td>{{$item->qty}}</td>
                            <td>
                                @if ($item->status == "pending")
                                    <p class="badge bg-danger">{{$item->status}}</p>
                                @else
                                    <p class="badge bg-success">{{$item->status}}</p>
                                @endif
                            </td>
                            <td>{{$item->product->price}}</td>
                            <td>{{$item->qty * $item->product->price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            @endif
@endsection
