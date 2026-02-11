<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Defaultattribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
       public  function index(){
        return view('admin.productattribute.create');
    }
      public  function manage(){
         $manageat = Defaultattribute::all();
        return view('admin.productattribute.manage',compact('manageat'));
    }

    
       public function storeattribute(Request $request){
           $validate = $request->validate(['attribute_value'=>'required|unique:defaultattributes,attribute_value'   ]);    
       $attribute = new Defaultattribute();
       $attribute->attribute_value = $request ->attribute_value;
        $attribute->save();  
       return redirect()->back()->with('success',  $attribute->attribute_value." added Successfully.");
    }

    public function editattribute($id)
    {
        $editattribute = Defaultattribute::find($id);
        return view('admin.productattribute.edit', compact('editattribute'));
    }

       public function deleteattribute($id)
    {
        $subcatd = Defaultattribute::find ($id);
       $subcatd -> delete();
        return redirect()-> route('productattribute.manage')->with('message','default attribute Deleted successfully.');
   }

public function upattribute(Request $request, $id) {
    $upattribute = Defaultattribute::findOrFail($id);
    $validate_data =  $request->validate([
        'attribute_value' => 'required', 
    ]);

    if ($validate_data['attribute_value'] == $upattribute->attribute_value) {
        return redirect()->back()
            ->withErrors(['attribute_value' => 'You did not change the product-attribute name.']);
    } else {
        $upattribute->attribute_value = $validate_data['attribute_value'];
        $upattribute->save();
        return redirect()->route('productattribute.manage')
            ->with('success', 'product attribute updated successfully.');
    }
}

}
