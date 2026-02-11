<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\HomePageSetting;
use Livewire\Component;

class HomePageComponent extends Component
{
   public $selectedCategory = null;
    public $categories = [];
   
    public function mount(): void
    {
        $this->categories = Category::all();
          //  Read admin discount setting
       
    }

    public function filterByCategory($categoryId): void
    {
        $this->selectedCategory = $categoryId;
    }

 
      public function render()
    {
        $products = Product::with('images')
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->take(12)
            ->get();

   return view('livewire.home-page-component', [
            'products' => $products,
            'categories' => $this->categories,
            'selectedCategory' => $this->selectedCategory,
        ]);


        
    }
}
