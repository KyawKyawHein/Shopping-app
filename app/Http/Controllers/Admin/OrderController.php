<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pending(){
        $orders = ProductOrder::where('status','pending')->latest('id')->with("product",'user')->paginate(5);
        return view('admin.order.pending',compact('orders'));
    }

    public function complete(){
        if(isset($_GET['start_date'])){
            $start_date = $_GET['start_date'];
            if(!empty($_GET['end_date'])){
                $end_date  = $_GET['end_date'];
            }else{
                $end_date = date("Y-m-d");
            }
            $orders = ProductOrder::where('status','complete')->whereBetween('created_at',[$start_date,$end_date])->latest('id')->with('product','user')->paginate(5)->withQueryString();
        }
        $orders = ProductOrder::where('status','complete')->latest('id')->with("product",'user')->paginate(5)->withQueryString();
        return view('admin.order.complete',compact('orders'));
    }

    public function makeComplete($id){
        $order = ProductOrder::find($id);
        $order->update([
            "status"=>"complete"
        ]);
        return redirect()->back()->with('success',"Order has successfully completed.");
    }
}
