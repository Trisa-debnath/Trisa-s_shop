@extends('admin.layouts.layout')

@section('admin_page_title')
Discount Manage Page
@endsection

@section('admin_layout')
    <h1>Manage Discounts</h1>
<p>Here you can see all products with discounts and update or remove them.</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Regular Price</th>
            <th>Discount %</th>
            <th>Discounted Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->product_name }}</td>
            <td>${{ $product->regular_price }}</td>
            <td>{{ $product->discount_percent }}%</td>
            <td>${{ $product->discounted_price }}</td>
 
  <td>
       <a href="{{ route('discount.edit', $product->id)}}" method="GET"  class="btn btn-sm btn-warning">Update</a>
        <form action="{{ route('discount.update', $product->id)}}" method="POST" style="display:inline;">
 </td>

    <td>
  @csrf
  @method('DELETE')
                   
<a href="{{ route('discount.remove', $product->id)}}" method="GET"  class="btn btn-sm btn-danger"
  onclick="return confirm('Are you sure you want to remove this discount?')">Remove
 </a>
</form>
 </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No discounts applied yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>


@endsection
