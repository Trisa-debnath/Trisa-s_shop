<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Review;
 

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with(['category','subcategory','store','seller','images'])
                        ->latest()
                        ->get();

        return view('admin.product.manage', compact('products'));
    }

    // Delete product
     public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->img_path)) {
                Storage::disk('public')->delete($img->img_path);
            }
            $img->delete();
        }

        $product->delete();

        return redirect()->route('product.manage')->with('success', 'Product deleted successfully!');
    }

    // Product review manage page
    public function review_manage()
    {


    $reviews = Review::with('product','user')
                     ->latest()
                     ->paginate(10);

   


        return view('admin.product.manageproductreview', compact('reviews'));
    }
}
