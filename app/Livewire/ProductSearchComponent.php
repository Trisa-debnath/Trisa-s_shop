<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearchComponent extends Component
{
    public $query = '';
    public $products = [];
    public $hasSearched = false;

    public function updatedQuery()
    {
        $this->search();
    }

    public function search()
    {
        $searchText = trim($this->query);

        if ($searchText !== '') {
            $this->hasSearched = true;

            $this->products = Product::with(['category', 'subcategory', 'images'])
                ->where(function ($query) use ($searchText) {
                    $query->where('product_name', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchText . '%')
                        ->orWhereHas('category', function ($categoryQuery) use ($searchText) {
                            $categoryQuery->where('category_name', 'LIKE', '%' . $searchText . '%');
                        })
                        ->orWhereHas('subcategory', function ($subcategoryQuery) use ($searchText) {
                            $subcategoryQuery->where('subcategory_name', 'LIKE', '%' . $searchText . '%');
                        });
                })
                ->latest()
                ->take(20)
                ->get();
        } else {
            $this->products = [];
            $this->hasSearched = false;
        }
    }

    public function render()
    {
        return view('livewire.product-search-component'); 
    }
}
