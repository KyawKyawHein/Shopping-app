@props(['categories'])
@extends('admin.layout.master')

@section('content')
    <a href="{{route('admin.categories.create')}}" class="btn btn-primary btn-sm">Create Category</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Control</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
                <tr>
                    <td>{{ $c->name}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit',$c->id)}}" class="btn btn-success btn-sm">Edit</a>
                        <form action="{{route('admin.categories.destroy',$c->id)}}" method="post" id="delete" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="confirm('Delete')? document.getElementById('delete').submit():''">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection