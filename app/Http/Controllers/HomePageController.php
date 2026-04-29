<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomePageSetting;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\OrderItem;
use Stripe\Checkout\Session as StripeSession;

class HomePageController extends Controller
{
    // Home Page
    public function index()
{
    
    $homepagesetting = HomePageSetting::first() ?? new HomePageSetting();

    // Slider 
    $sliderProducts = Product::with('images')->latest()->take(5)->get();

    // Discount Products 
    $discountProducts = Product::with('images')
        ->where('discount_percent', '>', 0)
        ->get();
        $products = Product::with('images')->latest()->get();


    return view('home.index', compact('homepagesetting', 'sliderProducts', 'products', 'discountProducts'));
}
    // Category Page
    public function showCategoryProducts($category_name)
    {
        $category = Category::where('category_name', $category_name)->firstOrFail();
        $products = Product::with('images', 'category')
            ->where('category_id', $category->id) ->get();
        return view('home.categories', compact('category', 'products'));
    }
    public function viewdetails($id)
{
    $product = Product::with('images', 'category')->findOrFail($id);
    return view('home.viewdetails', compact('product'));
}
    // Order Proceed
    public function orderproceed()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('home.orderproceed', compact('cart', 'total'));
    }

    // Order Store
    public function orderstore(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = new Order();
        $order->name = $request->name;
        $order->Phone = $request->phone;
        $order->email = $request->email;
        $order->address = $request->address ?? null;
        $order->user_id = Auth::id();
        $order->total = $total;
        $order->payment_method = $request->payment_method;
        $order->payment_status = $request->payment_method === 'cod' ? 'pending' : 'paid';
        $order->status = 'pending';
        $order->save();

        // Save order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'] ?? 'Unknown',
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('order.success')
            ->with('success', 'Order placed successfully! ' . strtoupper($order->payment_method))
            ->with('total', $total);
    }
    // Stripe payment page
    public function stripe($total)
    {
        return view('home.stripe', compact('total'));
    }
    // Stripe payment post
    public function stripePost(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric|min:1',
            'stripeToken' => 'required',
        ]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                "amount" => $request->total * 100, // in cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment for Cart Order",
            ]);

            Session::flash('success', 'Payment successful!');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

 }
