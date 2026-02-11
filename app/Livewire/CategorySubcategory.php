<?php

namespace App\Livewire;

use App\Models\category;
use App\Models\subcategory;
use Livewire\Component;

class CategorySubcategory extends Component
{
    public $categories=[];
    public $selectedCategory;
    public $subcategories=[];

    public function mount(){
        $this->categories = Category::all();
    }

    public function updatedSelectedCategory($categoryId){
        $this->subcategories = Subcategory::where('category_id',$categoryId)->get();
    }


    public function render()
    {
        return view('livewire.category-subcategory');
    }
}
