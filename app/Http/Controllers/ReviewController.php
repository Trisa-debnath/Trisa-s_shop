<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'rating'=>'required|between:1,5',
            'review'=>'nullable|string'
        ]);

        Review::create([
            'product_id'=>$request->product_id,
           'user_id' =>Auth::id(),
            'rating'=>$request->rating,
            'review'=>$request->review,
        ]);

        return back()->with('success','Review submitted for approval');
    }

public function approve($id)
{
    Review::findOrFail($id)->update(['status'=>'approved']);
    return back()->with('success','Review Approved');
}

public function reject($id)
{
    Review::findOrFail($id)->update(['status'=>'rejected']);
    return back()->with('success','Review Rejected');
}



}
