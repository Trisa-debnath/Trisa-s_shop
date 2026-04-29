@extends('seller.layouts.layout')
@section('seller_page_title')
product manage
@endsection
@section('seller_layout')
    <div class="message">
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

        <!-- seller product manage-->
        <div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header primary">
									<h5 class="card-title mb-4 ">Vendor Product Management</h5>

                                    
       @if(session('success'))
      <div class="alert alert-success">
       <h3 class="mb-4">{{session('success')}}</h3>
       </div>
        @endif
               
        <!-- Seller Product table -->
       

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle shadow-sm">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Images</th>
                <th>SKU</th>
                <th>Store</th>
                <th>Regular Price</th>
                <th>Discounted Price</th>
                <th>Tax Rate</th>
                <th>Stock</th>
                <th>Slug</th>
                <th>Meta Title</th>
                <th>Meta Description</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ Str::limit($product->description, 30) }}</td>
                    <td>
                        @foreach ($product->images as $img)
                            <img src="{{ asset('storage/' . $img->img_path) }}" alt="Image" width="50" class="rounded me-1 mb-1">
                        @endforeach
                    </td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->store->store_name ?? 'N/A' }}</td>
                    <td>৳{{ $product->regular_price }}</td>
                    <td>
                        @if($product->discounted_price)
                            <span class="text-success">৳{{ $product->discounted_price }}</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ $product->tax_rate }}%</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->meta_title }}</td>
                    <td>{{ Str::limit($product->meta_description, 25) }}</td>
                    <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                    <td>{{ $product->subcategory->subcategory_name ?? 'N/A' }}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-warning btn-sm mb-1">Edit</a>

                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="text-center text-danger">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>






				</div>


@endsection
