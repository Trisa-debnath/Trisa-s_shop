<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCartComponent extends Component
{
   public $cart = [];

    protected $listeners = [
        'cartUpdated' => 'updateCart',
        'addToCart' => 'addToCart'
    ];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function addToCart($productId)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $this->updateCart();

        $this->dispatchBrowserEvent('notify', [
            'title' => "{$product->name} added to cart!",
            'type' => 'success'
        ]);


        
    $this->dispatchBrowserEvent('cart-updated', [
        'title' => "{$product->name} added to cart!",
        'type' => 'success'
    ]);
    }

    public function increaseQuantity($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
            $this->updateCart();
        }
    }

    public function decreaseQuantity($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
            $this->updateCart();
        }
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $this->updateCart();
        }
    }




      public function render()
    {
        return view('livewire.product-cart-component');
    }
    }


