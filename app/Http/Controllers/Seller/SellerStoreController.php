<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class SellerStoreController extends Controller
{
    public  function index(){
        return view('seller.store.create');
    }
       public  function manage(){
 $userid = Auth::user()->id;
  $stores = Store::where('user_id',$userid)->get(); 
        return view('seller.store.manage' ,compact('stores'));
    }

       public function store(Request $request)
    {
            $request->validate(['store_name'=>'required',
            'slug'=>'required',
            'details'=>'required'   
        ]);
      Store::create([
            'store_name' => $request->store_name,
            'slug' => $request->slug,
            'details' => $request->details,
            'user_id' => Auth::user()->id 
        ]);
       return redirect()->route('vendor.store')->with('message',"store added Successfully.");
    }


    public function editstore($id)
    {
        $editstor = Store::find($id);
        return view('seller.store.edit', compact('editstor'));
    }

      public function deletestore($id)
    {
        $storedelete= Store::find ($id);
      $storedelete -> delete();

    return redirect()->route('vendor.store.manage')->with('success', 'Store Deleted successfully.');

       
    }
     
   public function upstore(Request $request, $id)
    {
        $validate_data= $request->validate([
            'store_name' => 'required',
            'slug'=>'required',
            'details'=>'required'   
        ]);

        $upstore = Store::find($id);

        if ($validate_data['store_name'] == $upstore->store_name) {
        return redirect()->back()
            ->withErrors(['store_name' => 'You did not change the store name.']);
    } else {
        $upstore->store_name = $validate_data['store_name'];
        $upstore->save();
        return redirect()->route('vendor.store.manage')
            ->with('success', 'store updated successfully.');
    }


    }



}
