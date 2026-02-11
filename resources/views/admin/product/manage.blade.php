@extends('admin.layouts.layout')

@section('admin_page_title')
product manage page
@endsection

@section('admin_layout')



   <div class="container mt-4">
    <h2 class="mb-3">All Products</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Seller</th>
                <th>Store</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->images->first())
                        <img src="{{ asset('storage/'.$product->images->first()->img_path) }}" width="60" alt="">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->seller->name ?? 'N/A' }}</td>
                <td>{{ $product->store->store_name ?? 'N/A' }}</td>
                <td>{{ $product->category->category_name ?? '' }} > {{ $product->subcategory->name ?? '' }}</td>
                <td>${{ $product->regular_price }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>{{ $product->status ?? 'Pending' }}</td>
                <td>
                    <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No Products Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

