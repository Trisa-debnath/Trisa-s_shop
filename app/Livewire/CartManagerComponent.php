<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class CartManagerComponent extends Component
{
      public string $message = '';

     public Product $product;
  
    public int $quantity = 1;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        $product = Product::findOrFail($this->product->id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $this->quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->product_name,
                'quantity' => $this->quantity,
                'price' => $product->regular_price,
                'image' => $product->images[0]?->img_path ?? 'default.png',
            ];
        }

        session()->put('cart', $cart);

        $this->dispatch('cartUpdated');
        $this->dispatch('notify', [
            
             'title' => '🛒 ✅ Cart Added Successfully!',
            'type' => 'success',
        ]);

         // 🔔 Message for blade alert box
 $this->message = '✅ Product added successfully!';
        // Optional: Reset quantity
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.cart-manager-component');
    }
}
