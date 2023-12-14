@props(['user_count','pending_count','complete_count','orders'])
@extends('admin.layout.master')

@section("content")
    <div class="">
        <div class="card-container row justify-content-around">
            <div class="card col-md-3 bg-primary text-light">
                <div class="card-body d-flex flex-column justify-content-center align-items-center ">
                    <h5>Total User</h5>
                    <span class="bg-dark rounded rounded-circle p-1 px-2">{{$user_count}}</sp>
                </div>
            </div>
            <div class="card col-md-3 bg-danger text-light">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5>Pending Order</h5>
                    <span class="bg-dark rounded rounded-circle p-1 px-2">{{$pending_count}}</sp>
                </div>
            </div>
            <div class="card col-md-3 bg-success text-light">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5>Completed Order</h5>
                    <span class="bg-dark rounded rounded-circle p-1 px-2">{{$complete_count}}</sp>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <p class="fw-bolder">Latest Posts</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->product->name}}</td>
                            <td><img src="{{asset($order->product->image)}}" width="50px" /></td>
                            <td>{{$order->qty}}</td>
                            <td>{{$order->qty * $order->product->price}}</td>
                            <td>
                                @if($order->status == 'complete')
                                    <span class="badge bg-success">{{$order->status}}</span>
                                @else
                                    <span class="badge bg-danger">{{$order->status}}</span>
                                @endif
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection