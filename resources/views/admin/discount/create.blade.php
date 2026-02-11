@extends('admin.layouts.layout')

@section('admin_page_title')
discount create page
@endsection

@section('admin_layout')
    <h5> The discount create page</h5></br>
    
   <form method="POST" action="{{ route('discount.store') }}">
    @csrf

    <select name="product_id">
        @foreach($products as $product)
            <option value="{{ $product->id }}">
                {{ $product->product_name }}
            </option>
        @endforeach
    </select>

    <input type="number" name="discount_percent" placeholder="Discount %" required>

    <button type="submit">Apply Discount</button>
</form>

@endsection
