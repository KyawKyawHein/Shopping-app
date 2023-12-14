@props(['products'])
@extends('admin.layout.master')
@section('content')
    <a href="{{route('admin.products.create')}}" class="btn btn-primary btn-sm">Create Product</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->name}}</td>
                    <td>
                        <img src="{{asset($p->image)}}" width="50px" alt="">
                    </td>
                    <td>{{$p->category->name}}</td>
                    <td>
                        <a href="{{route('admin.products.edit',$p->id)}}" class="btn btn-success btn-sm">Edit</a>
                        <a href="{{route('admin.products.show',$p->id)}}" class="btn btn-secondary btn-sm">Detail</a>
                        <form action="{{route('admin.products.destroy',$p->id)}}" method="post" id="delete" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="confirm('Delete')? document.getElementById('delete').submit():''">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection