@extends('user.layout.master')

@section("content")
     <div class="card p-3 shadow">
          <h3 class="text-primary">Register</h3>
        <form action="{{route('postRegister')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Enter Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="text-end mt-3">
                <button class="btn btn-primary">Register</button>
            </div>
        </form>
     </div>
@endsection
