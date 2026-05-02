<?php

namespace App\Http\Controllers;

use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class AdminMainController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $total_product = Product::count();
        $total_order = Order::count();
        $total_user = User::count();
        $total_revenue = Order::sum('total');
        $total_deleverd = Order::where('status', 'completed')->count();
        $total_pending = Order::where('status', 'pending')->count();
        $total_cancelled = Order::where('status', 'cancelled')->count();
        $today_orders = Order::whereDate('created_at', $today)->count();
        $today_revenue = Order::whereDate('created_at', $today)->sum('total');
        $paid_orders = Order::where('payment_status', 'paid')->count();
        $recent_orders = Order::latest()->take(5)->get();
        $recent_products = Product::with('images')->latest()->take(4)->get();
        $completed_percent = $total_order > 0 ? round(($total_deleverd / $total_order) * 100) : 0;
        $pending_percent = $total_order > 0 ? round(($total_pending / $total_order) * 100) : 0;

        return view('admin.admin', compact(
            'total_product',
            'total_order',
            'total_user',
            'total_revenue',
            'total_deleverd',
            'total_pending',
            'total_cancelled',
            'today_orders',
            'today_revenue',
            'paid_orders',
            'recent_orders',
            'recent_products',
            'completed_percent',
            'pending_percent'
        ));
    }

    public function seeting()
    {
        $products = Product::all();
        $homepagesetting = HomePageSetting::first() ?? new HomePageSetting();

        return view('admin.seeting', compact('products', 'homepagesetting'));
    }

    public function homepage_settingupdate(Request $request)
    {
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

        return redirect()->route('admin.seeting')->with('success', 'Home Page Setting Update successfully.');
    }

    public function manage_user()
    {
        return view('admin.manage.user');
    }

    public function manage_stores()
    {
        return view('admin.manage.store');
    }

    public function cart_history()
    {
        $orders = Order::latest()->paginate(10);

        return view('admin.cart.history', compact('orders'));
    }

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

    public function Print_pdf($id)
    {
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
