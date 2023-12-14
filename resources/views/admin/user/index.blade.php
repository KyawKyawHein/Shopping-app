@props(['users'])
@extends('admin.layout.master')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{ $u->name}}</td>
                    <td>
                        <img src="{{asset($u->image)}}" width="50px" class="rounded rounded-circle"/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection