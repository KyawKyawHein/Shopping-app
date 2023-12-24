<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="list-group">
                            <a href="" class="text-decoration-none">
                                <li class="list-group-item bg-primary text-light">Admin Management</li>
                            </a>
                            <a href="{{route('admin.dashboard')}}" class="text-decoration-none">
                                <li class="list-group-item">Dashboard</li>
                            </a>
                            <a href="{{route('admin.categories.index')}}" class="text-decoration-none">
                                <li class="list-group-item">Category</li>
                            </a>
                            <a href="{{route('admin.products.index')}}" class="text-decoration-none">
                                <li class="list-group-item">Product</li>
                            </a>
                            <a href="{{route('admin.orders.pending')}}" class="text-decoration-none">
                                <li class="list-group-item">Pending Order</li>
                            </a>
                            <a href="{{route('admin.orders.complete')}}" class="text-decoration-none">
                                <li class="list-group-item">Complete Order</li>
                            </a>
                            <a href="{{route('admin.users')}}" class="text-decoration-none">
                                <li class="list-group-item">User List</li>
                            </a>
                            @if(Auth::user())
                                <form action="{{route('admin.logout')}}" id="logoutForm" method="post">
                                    @csrf
                                    <button class="list-group-item">Logout</button>
                                </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8 mt-3">
                @include('inc.error')
                @yield('content')
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
