<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="body-color">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="/">MM-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('user.dashboard')}}">Home</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="btn dropdown-item">Logout</button>
                                </form>
                        </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>
                            <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item d-flex align-items-center me-3">
                    <a class="nav-link" href="{{route('productCart.index')}}">Your Cart</a>
                    <span class="badge bg-danger rounded rounded-circle">{{$cart_count}}</span>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('orders.index')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Your Orders
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('orders.index')}}">All</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.pending')}}">Pending</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.complete')}}">Success</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" value="{{$_GET['search']??''}}" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12 col-md-3 ">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="list-group">
                            <a href="{{route('orders.index')}}" class="text-decoration-none">
                                <li class="list-group-item">Your Order List</li>
                            </a>
                            <a href="{{route('changeProfile')}}" class="text-decoration-none">
                                <li class="list-group-item">Your Profile info</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body p-0">
                        <ul class="list-group">
                            <a href="/" class="text-decoration-none">
                                <li class="list-group-item bg-primary text-light">All Category</li>
                            </a>
                            @foreach ($categories as $c)
                                <a href="{{route('category.product',$c->slug)}}" class="text-decoration-none">
                                    <li class="list-group-item w-100 text-dark px-2 d-flex justify-content-between align-items-center">
                                        {{$c->name}}
                                        <span class="badge bg-danger">{{$c->products_count}}</span>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                @include('inc.error')
                @yield('content')
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield("script")
</body>
</html>
