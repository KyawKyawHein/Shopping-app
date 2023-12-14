<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductOrderController extends Controller
{
  public function index(){
    $orders = ProductOrder::where('user_id',Auth::id())->latest()->with('product')->paginate(3);
    return view('user.order',compact('orders'));
  }

  public function pending(){
    $orders = ProductOrder::where('user_id',Auth::id())->where('status','pending')->latest()->with('product')->paginate(3);
    return view('user.order',compact('orders'));
  }

  public function complete(){
    $orders = ProductOrder::where('user_id',Auth::id())->where('status','complete')->latest()->with('product')->paginate(3);
    return view('user.order',compact('orders'));
  }
}
