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
use Illuminate\Support\Facades\DB;

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
        $stripeKey = env('STRIPE_KEY');
        $bkashNumber = env('BKASH_PAYMENT_NUMBER', '01XXXXXXXXX');
        $nagadNumber = env('NAGAD_PAYMENT_NUMBER', '01XXXXXXXXX');

        return view('home.orderproceed', compact('cart', 'total', 'stripeKey', 'bkashNumber', 'nagadNumber'));
    }

    // Order Store
    public function orderstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'payment_method' => 'required|in:cod,bkash,nagad,card',
            'stripeToken' => 'required_if:payment_method,card',
            'payment_sender_phone' => 'required_if:payment_method,bkash,nagad|nullable|string|max:30',
            'mobile_transaction_id' => 'required_if:payment_method,bkash,nagad|nullable|string|max:100',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $paymentStatus = 'pending';
        $transactionId = null;
        $note = null;

        if ($request->payment_method === 'card') {
            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));

                $charge = Charge::create([
                    'amount' => (int) round($total * 100),
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Payment for cart order',
                ]);

                $paymentStatus = 'paid';
                $transactionId = $charge->id;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput($request->except('stripeToken'))
                    ->with('error', $e->getMessage());
            }
        } elseif (in_array($request->payment_method, ['bkash', 'nagad'], true)) {
            $transactionId = $request->mobile_transaction_id;
            $note = 'Sender phone: ' . $request->payment_sender_phone;
        }

        DB::transaction(function () use ($request, $cart, $total, $paymentStatus, $transactionId, $note) {
            $order = Order::create([
                'name' => $request->name,
                'Phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'user_id' => Auth::id(),
                'total' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'transaction_id' => $transactionId,
                'status' => 'pending',
                'note' => $note,
            ]);

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
        });

        Session::forget('cart');

        return redirect()->route('order.success')
            ->with('success', 'Order placed successfully! ' . strtoupper($request->payment_method))
            ->with('total', $total);
    }
    // Stripe payment page
    public function stripe($total)
    {
        return redirect()->route('order.proceed')
            ->with('error', 'Please complete card payment from the checkout form.');
    }
    // Stripe payment post
    public function stripePost(Request $request)
    {
        return redirect()->route('order.proceed')
            ->with('error', 'Please complete card payment from the checkout form.');
    }

 }
