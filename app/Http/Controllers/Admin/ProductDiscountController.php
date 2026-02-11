<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\product;

class ProductDiscountController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.discount.create', compact('products'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $product->discount_percent = $request->discount_percent;

        // discounted price calculate
        $product->discounted_price =
            $product->regular_price -
            ($product->regular_price * $request->discount_percent / 100);

        $product->save();

        return back()->with('success','Discount added successfully');
    }

    public function manage()
    {
      //  $products = Product::whereNotNull('discount_percent')->get();
          $products = Product::where('discount_percent', '>', 0)->get();

        return view('admin.discount.manage', compact('products'));
    }


    // Show edit page
public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.discount.edit', compact('product'));
}

    public function update(Request $request, $id)
    {
         $request->validate([
        'discount_percent' => 'required|numeric|min:0|max:100',
    ]);
        $product = Product::findOrFail($id);

        $product->discount_percent = $request->discount_percent;
        $product->discounted_price =
            $product->regular_price -
            ($product->regular_price * $request->discount_percent / 100);

        $product->save();

        return redirect()->route('discount.manage')->with('success', 'Discount updated successfully');
    }




    public function remove($id)
    {
        $product = Product::findOrFail($id);

        $product->discount_percent = null;
        $product->discounted_price = null;
        $product->save();

        return back()->with('success','Discount removed');
    }
}


