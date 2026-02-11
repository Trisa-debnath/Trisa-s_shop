<?php

namespace App\Http\Controllers;

use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminMainController extends Controller
{
    public  function index(){

$total_product = product::all()->count();
$total_order = Order::all()->count();
$total_user = User::all()->count();
$order = Order:: all();
$total_revenue = 0;
foreach($order as $order){
    $total_revenue = $total_revenue + $order->total;
}
$total_deleverd = Order::where('status','=','completed')->get()->count();
$total_pending = Order::where('status','=','pending')->get()->count();
$total_cancelled = Order::where('status','=','Cancelled')->get()->count();
         
        return view('admin.admin',compact('total_product','total_order','total_user','total_revenue','total_deleverd','total_pending','total_cancelled'));
    }
public  function seeting(){
    $products = Product::all();
    $homepagesetting = HomePageSetting::first() ?? new HomePageSetting();
        return view('admin.seeting', compact('products', 'homepagesetting'));
    }

    public function homepage_settingupdate(Request $request){
        $request->validate([
    'discounted_product_id' => 'required|exists:products,id',
    'discount_percent' => 'required|numeric|min:0|max:100',
    'discount_heading' => 'required|string|max:255',
    'featured_product_1_id' => 'nullable|exists:products,id',
    'featured_product_2_id' => 'nullable|exists:products,id',
]);

$homepagesetting = HomePageSetting::first() ?? new HomePageSetting();
$homepagesetting->fill($request->all());
$homepagesetting->save();

 return redirect()-> route('admin.seeting')->with('success','Home Page Setting Update successfully.');

    }





    public  function manage_user(){
        return view('admin.manage.user');
    }
    public  function manage_stores(){
        return view('admin.manage.store');
    }
    public  function cart_history(){
         $orders = Order::latest()->paginate(10);
        return view('admin.cart.history', compact('orders'));
    }
//order

    public function order_history()
{
    
    $products = Product::all();
    $orders = Order::with('items.product')->latest()->paginate(10);
    return view('admin.order.history', compact('orders', 'products'));
}


     

      public function order_edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

     public function order_update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('admin.order.history')->with('success', 'Order updated successfully!');
    }

    public function order_destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Order deleted successfully!');
    }
   public function Print_pdf($id){
    $order = Order::with('products')->findOrFail($id); 
    $pdf = Pdf::loadView('admin.pdf', compact('order'));
    return $pdf->download('order_details.pdf');
}


public function order_search(Request $request)
{
    $searchText = $request->search;
 $orders = Order::with('items.product') 
        ->where('name', 'LIKE', "%{$searchText}%")
        ->orWhere('Phone', 'LIKE', "%{$searchText}%")
        ->latest()
        ->paginate(10);

    return view('admin.order.history', compact('orders'));
}



}
