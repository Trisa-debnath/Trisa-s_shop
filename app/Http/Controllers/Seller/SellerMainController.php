<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\store;

class SellerMainController extends Controller
{
    public  function index(){

$total_product = product::all()->count();
$total_order = Order::all()->count();
$total_store = store::all()->count();

        return view('seller.dashboard',compact('total_product','total_order','total_store'));
    }
     public  function orderhistory(){
        $orders = Order::with('items.product')->latest()->paginate(10);
        return view('seller.orderhistory',compact('orders'));
    }



public function order_search(Request $request)
{
    $searchText = $request->search;
 $orders = Order::with('items.product') 
        ->where('name', 'LIKE', "%{$searchText}%")
        ->orWhere('Phone', 'LIKE', "%{$searchText}%")
        ->latest()
        ->paginate(10);

    return view('seller.orderhistory', compact('orders'));
}


}
