<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public  function index(){
        return view('admin.category.create');
    }
    public  function manage(){
        $manage = category::all();
        return view('admin.category.manage',compact('manage'));
    }
}
