@props(['orders'])
@extends('admin.layout.master')

@section("content")
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>User</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>
                        <img src="{{asset($order->product->image)}}" width="50px" alt="">
                    </td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->qty}}</td>
                    <td>{{$order->qty * $order->product->price}}</td>
                    <td>{{$order->status}}</td>
                    <th>
                        <form action="{{route('admin.orders.makeComplete',$order->id)}}" method="post">
                            @csrf
                            @method("PUT")
                            <button class="btn btn-sm btn-success">make complete</butt>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$orders->links()}}
@endsection