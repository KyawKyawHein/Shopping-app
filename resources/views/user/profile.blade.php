@props(['user'])
@extends('user.layout.master')

@section("content")
       <h3 class="text-primary">Change Profile</h3>
        <form action="{{route('changeProfileHandler')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{$user->name}}" name="name" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="email">Email</label>
                <input type="email" disabled  name="email" value="{{$user->email}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if($user->image)
                    <img src="{{asset($user->image)}}" width="100px" />
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter password to change" name="password" class="form-control">
            </div>
            <div class="text-end">
                <a href="{{route('changePassword')}}">Forget password?</a>
            </div>
            <div class="text-end mt-3">
                <a href="{{route('changeProfileHandler')}}"><button class="btn btn-primary">Change Name</button></a>
            </div>
        </form>
@endsection