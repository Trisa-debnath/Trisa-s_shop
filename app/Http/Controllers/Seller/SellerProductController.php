<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Productimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
     public  function index(){
        $authuserid = Auth::id();
        $stores = Store::where('user_id', $authuserid)->get();
        return view('seller.product.create', compact('stores'));
    }
       public  function manage(){
        $curentseller = Auth::id();
        $products = Product::where('seller_id',$curentseller)->get();
        return view('seller.product.manage', compact('products'));
    }

    public function store(Request $request){
        $request->validate([
             'product_name' => 'required|string|max:255',
        'description' => 'required|string',
      
        'sku' => 'nullable|string|max:100|unique:products,sku',
        'store_id' => 'required|exists:stores,id',
        'regular_price' => 'required|numeric|min:0',

'discount_percent' => 'nullable|numeric|min:0|max:100',


        'discounted_price' => 'nullable|numeric|min:0|lte:regular_price',
        'tax_rate' => 'nullable|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'slug' => 'nullable|string|max:255|unique:products,slug',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'required|exists:subcategories,id',
          'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
//discoun price calculate
$discountedPrice = $request->regular_price;

if ($request->discount_percent && $request->discount_percent > 0) {
    $discountedPrice = intval($request->regular_price - ($request->regular_price * $request->discount_percent / 100));
}
 else {
    $discountedPrice = null; // no discount, show only regular price
}


    
  

        $sku = $request->sku ?: strtoupper(Str::random(8));
        $slug = $request->slug ?: Str::slug($request->product_name).'-'.Str::lower(Str::random(6));

        $product = Product::create([
            'product_name' => $request->product_name,
             'description' => $request->description,
               'sku' => $sku,
               'seller_id' => Auth::id(),

                'store_id' => $request->store_id,  
            'regular_price' => $request->regular_price,
            
             'discount_percent' => $request->discount_percent,

            'discounted_price' => $discountedPrice,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'category_id' => $request->category_id,
             'subcategory_id' => $request->subcategory_id,
             'status' => 'Draft',


        ]);
        

  if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imageName = $image->store('product_images','public');
                Productimage::create([
                    'product_id'=> $product->id,
                    'img_path' => $imageName,
                    'is_primary' => false

                ]);
            }
        }

        return redirect()->back()->with('success', 'Product created successfully!');

    }
}
