<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productimage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Review;
use App\Models\Store;
 

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with(['category','subcategory','store','seller','images'])
                        ->latest()
                        ->get();

        return view('admin.product.manage', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        $store = Store::findOrFail($validated['store_id']);

        $discountPercent = $validated['discount_percent'] ?? 0;
        $discountedPrice = $discountPercent > 0
            ? round($validated['regular_price'] - ($validated['regular_price'] * $discountPercent / 100), 2)
            : null;

        $product = Product::create([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'sku' => $validated['sku'] ?: $this->uniqueSku(),
            'seller_id' => $store->user_id,
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'store_id' => $store->id,
            'regular_price' => $validated['regular_price'],
            'discount_percent' => $discountPercent ?: null,
            'discounted_price' => $discountedPrice,
            'tax_rate' => $validated['tax_rate'] ?? 0,
            'stock_quantity' => $validated['stock_quantity'],
            'stock_status' => $validated['stock_status'],
            'slug' => $validated['slug'] ?: $this->uniqueSlug($validated['product_name']),
            'visibility' => $request->boolean('visibility'),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->storeImages($request, $product);

        return redirect()->route('product.manage')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);

        return view('admin.product.edit', array_merge($this->formData(), compact('product')));
    }

    public function update(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $validated = $this->validateProduct($request, $product->id);
        $store = Store::findOrFail($validated['store_id']);

        $discountPercent = $validated['discount_percent'] ?? 0;
        $discountedPrice = $discountPercent > 0
            ? round($validated['regular_price'] - ($validated['regular_price'] * $discountPercent / 100), 2)
            : null;

        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'sku' => $validated['sku'] ?: $product->sku,
            'seller_id' => $store->user_id,
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'store_id' => $store->id,
            'regular_price' => $validated['regular_price'],
            'discount_percent' => $discountPercent ?: null,
            'discounted_price' => $discountedPrice,
            'tax_rate' => $validated['tax_rate'] ?? 0,
            'stock_quantity' => $validated['stock_quantity'],
            'stock_status' => $validated['stock_status'],
            'slug' => $validated['slug'] ?: $product->slug,
            'visibility' => $request->boolean('visibility'),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'status' => $validated['status'],
        ]);

        $this->deleteSelectedImages($request);
        $this->storeImages($request, $product);

        return redirect()->route('product.manage')->with('success', 'Product updated successfully!');
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

    private function formData(): array
    {
        return [
            'categories' => Category::with('subcategories')->orderBy('category_name')->get(),
            'stores' => Store::with('user')->orderBy('store_name')->get(),
        ];
    }

    private function validateProduct(Request $request, ?int $productId = null): array
    {
        return $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'sku' => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($productId)],
            'store_id' => ['required', 'exists:stores,id'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'discount_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'tax_rate' => ['nullable', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'stock_status' => ['required', Rule::in(['In stock', 'out of stock'])],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'visibility' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required', 'exists:subcategories,id'],
            'status' => ['required', Rule::in(['Draft', 'published'])],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['integer', 'exists:productimages,id'],
        ]);
    }

    private function storeImages(Request $request, Product $product): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('product_images', 'public');

            Productimage::create([
                'product_id' => $product->id,
                'img_path' => $imagePath,
                'is_primary' => false,
            ]);
        }
    }

    private function deleteSelectedImages(Request $request): void
    {
        if (! $request->filled('delete_images')) {
            return;
        }

        $images = Productimage::whereIn('id', $request->delete_images)->get();

        foreach ($images as $image) {
            if (Storage::disk('public')->exists($image->img_path)) {
                Storage::disk('public')->delete($image->img_path);
            }

            $image->delete();
        }
    }

    private function uniqueSku(): string
    {
        do {
            $sku = strtoupper(Str::random(8));
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }

    private function uniqueSlug(string $name): string
    {
        $baseSlug = Str::slug($name) ?: 'product';
        $slug = $baseSlug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter++;
        }

        return $slug;
    }
}
