@extends('user.layout.master')

@section("content")
       <div class="card shadow p-3">
            <h3 class="text-primary">Login</h3>
            <form action="{{route('postLogin')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-primary">Login</button>
                </div>
            </form>
       </div>
@endsection
