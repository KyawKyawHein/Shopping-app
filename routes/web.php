<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserPageController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//for user auth
Route::controller(UserAuthController::class)->middleware('guest','shareData')->group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/register','postRegister')->name('postRegister');
    Route::get('/login','login')->name('login');
    Route::post('/login','postLogin')->name('postLogin');
});

// for user feature
Route::middleware('shareData')->group(function(){
    Route::get('/', [UserPageController::class,'index'])->name('user.dashboard');
    Route::get('/products/{slug}',[UserPageController::class,'show'])->name('product.show');
    //get product by category
        Route::get('/categories/{category}/products',[UserPageController::class,'productByCategory'])->name('category.product');        
});
Route::middleware('shareData','auth')->group(function(){
    //ProductCart
        Route::controller(ProductCartController::class)->group(function(){
            Route::get('/product-cart','index')->name('productCart.index');
            // add to cart
            Route::get('/products/{slug}/addtocart','addtocart')->name('productCart.addtocart');
            // remove from cart
            Route::get('/products/{slug}/removefromcart','removeFromCart')->name('productCart.removefromcart');
            // add cart to order_table and delete cart
            Route::get('/product-order','orderProduct')->name('productCart.order');
        });

    //ProductOrder
        Route::controller(ProductOrderController::class)->group(function(){
            // order list
            Route::get('/orders','index')->name('orders.index');     
            Route::get('/orders/pending','pending')->name('orders.pending');     
            Route::get('/orders/complete','complete')->name('orders.complete');     
        });

    // Profile Change
        Route::get('/profile/change',[UserPageController::class,'changeProfile'])->name('changeProfile');
        Route::put('/profile/change',[UserPageController::class,'changeProfileHandler'])->name('changeProfileHandler');
        Route::get('/password/change',[UserPageController::class,'changePassword'])->name('changePassword');
        Route::put('/password/change',[UserPageController::class,'changePasswordHandler'])->name('changePasswordHandler');
});

// for user auth logout
Route::middleware('auth')->group(function(){
    Route::post('/logout',[UserAuthController::class,'logout'])->name('logout');
});


//for admin panel
Route::prefix('admin')->as('admin.')->middleware('guest')->group(function(){
    Route::get('/',[AuthController::class,'login'])->name("login");
    Route::get('/login',[AuthController::class,'login'])->name("login");
    Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');
});

Route::prefix('admin')->as('admin.')->middleware('isAdmin')->group(function(){
    Route::get('/dashboard',[PageController::class,'dashboard'])->name('dashboard');
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);

    // for orders 
    Route::get('/orders/pending',[OrderController::class,'pending'])->name('orders.pending');
    Route::get('/orders/complete',[OrderController::class,'complete'])->name('orders.complete');
    Route::put('/orders/{id}/makeComplete',[OrderController::class,'makeComplete'])->name('orders.makeComplete');

    //for users
    Route::get('/users',[PageController::class,'getUsers'])->name('users');

    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});