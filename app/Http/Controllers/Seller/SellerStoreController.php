<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SellerStoreController extends Controller
{
    public function index()
    {
        return view('seller.store.create');
    }

    public function manage()
    {
        $stores = Store::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('seller.store.manage', compact('stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:stores,slug'],
            'details' => ['required', 'string'],
        ]);

        Store::create([
            'store_name' => $validated['store_name'],
            'slug' => $validated['slug'],
            'details' => $validated['details'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('vendor.store.manage')->with('success', 'Store added successfully.');
    }


    public function editstore($id)
    {
        $editstor = Store::where('user_id', Auth::id())->findOrFail($id);

        return view('seller.store.edit', compact('editstor'));
    }

    public function deletestore($id)
    {
        $storedelete = Store::where('user_id', Auth::id())->findOrFail($id);
        $storedelete->delete();

        return redirect()->route('vendor.store.manage')->with('success', 'Store deleted successfully.');
    }
     
    public function upstore(Request $request, $id)
    {
        $upstore = Store::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('stores', 'slug')->ignore($upstore->id)],
            'details' => ['required', 'string'],
        ]);

        $upstore->update($validated);

        return redirect()->route('vendor.store.manage')
            ->with('success', 'Store updated successfully.');
    }
}
