<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearchComponent extends Component
{
    public $query = '';
    public $products = [];

    public function search()
    {
        if (!empty($this->query)) {
            $searchText = $this->query;

            $this->products = Product::with('category')
                ->where('product_name', 'LIKE', '%' . $searchText . '%')
                ->orWhereHas('category', function ($query) use ($searchText) {
                    $query->where('category_name', 'LIKE', '%' . $searchText . '%');
                })
                ->get();
        } else {
            $this->products = [];
        }
    }

    public function render()
    {
        return view('livewire.product-search-component'); 
    }
}
