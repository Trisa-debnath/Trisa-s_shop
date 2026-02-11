<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
public  function index(){
    $categorys=Category::all();
  
        return view('admin.subcategory.create',compact('categorys'));
    }
    public  function manage(){

         $subcategorys = Subcategory::all();
        return view('admin.subcategory.manage',compact('subcategorys'));
    }
}
