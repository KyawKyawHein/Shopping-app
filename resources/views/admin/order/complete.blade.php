@props(['orders'])
@extends('admin.layout.master')

@section("content")
    <h3 class="text-primary mb-3">Complete Order</h3>
    <div class="card">
        <div class="card-body">
            <form action="" method="get" class="row">
                <div class="form-group col-md-4 mb-2">
                    <input type="date" class="form-control" name="start_date">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <input type="date" class="form-control" name="end_date">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <button class="btn btn-primary">Filter</button> 
                </div>
            </form>
            @if(isset($_GET['start_date']))
                <small class="text-danger fw-bold">Starting from {{ $_GET['start_date'] }} to {{$_GET['end_date']}}</small>
                <a href="{{route('admin.orders.complete')}}" class="badge bg-danger text-decoration-none text-light">Show all</a>
            @endif
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>User</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection