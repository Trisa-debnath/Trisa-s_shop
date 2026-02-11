@extends('admin.layouts.layout')

@section('admin_page_title')
Edit Discount
@endsection

@section('admin_layout')

<h1>Edit Discount for "{{ $product->product_name }}"</h1>


<form method="POST" action="{{ route('discount.update', $product->id) }}">
    @csrf
    <label>Discount %</label>
    <input type="number" name="discount_percent" value="{{ $product->discount_percent ?? 0 }}" min="0" max="100" required>
    <button type="submit" class="btn btn-primary">Update Discount</button>
</form>

@endsection