@extends('layouts.user')
@section('home')


      
 <div class="container py-5">
  <div class="row">
    <!-- Left side: Image -->
    <div class="col-md-6 text-center">
      @if($product->images->count() > 0)
        <img src="{{ asset('storage/'.$product->images[0]->img_path) }}" 
     alt="{{ $product->product_name }}" 
     class="img-fluid rounded shadow"
     style="max-width: 100%; height: auto; width:600px;"
 alt="{{ $product->product_name }}">
      @else
        <img src="{{ asset('storage/default.png') }}" 
             class="img-fluid rounded shadow" 
             alt="Default image">
      @endif
    </div>

    <!-- Right side: Details -->
    <div class="col-md-6">
      <h2 class="fw-bold">Product Name : {{ $product->product_name }}</h2>
      <p class="text-muted">
        Category: {{ $product->category->category_name ?? 'Uncategorized' }}
      </p>
 <h6 class="text-black">Product Description :{{ $product->description }}</h6>
  <h6 class="text-black">Product Sku : {{ $product->sku }}</h6>
   <h6 class="text-black">Product Stock Quantity : {{ $product->stock_quantity }}</h6>
    
      {{-- Price & Discount --}}
      @if($product->discounted_price > 0)
        <p>
          <small class="text-danger">{{ $product->discount_percent }}% OFF</small><br>
          <span style="text-decoration:line-through; color:#0ea3c9;">
            ${{ $product->regular_price }}
          </span>
          <span class="fw-bold text-success fs-4">
            ${{ $product->discounted_price }}
          </span>
        </p>
      @else
        <p class="fw-bold text-success fs-4">
          ${{ $product->regular_price }}
        </p>
      @endif

      {{-- Add to cart --}}
      <div class="mt-4">
        @livewire('cart-manager-component', ['product' => $product], key($product->id))
      </div>

{{--  Product Reviews --}}
<div class="mt-5">
    <h4 class="fw-bold mb-3">Customer Reviews</h4>

    @forelse($product->reviews as $review)
        <div class="border rounded p-3 mb-3">
             {{ $review->rating }}/5 <br>
            {{ $review->review }} <br>
            <small>By {{ $review->user->name ?? 'Guest' }}</small>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse
</div>


    </div>
  </div>
</div>
   


      
     


  


@endsection
