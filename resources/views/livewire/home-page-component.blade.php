<section id="product" class="p-0 m-0">
@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


  <div class="container-fluid p-0 m-0">
   <div class="row g-0 p-0 m-0">

      <!-- 🏷️ Title -->
      <div class="col-12 text-center mb-4">
        <h5 class="mb-2">Discover Your Required Product</h5>
        <h2 class="fw-bold">From 267+ Different Vendors, 10+ Categories</h2>
      </div>

      <!-- 🔘 Filter Buttons -->
      <div class="col-12 mb-5 text-center">
        
        <div class="d-flex flex-wrap justify-content-center gap-2">
          <button wire:click="filterByCategory(null)" 
                  class="btn btn-outline-dark {{ $selectedCategory === null ? 'active' : '' }}">
            All product
          </button>

          @foreach ($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})" 
                    class="btn btn-outline-secondary {{ $selectedCategory === $category->id ? 'active' : '' }}">
              {{ $category->category_name }}
            </button>
          @endforeach
        </div>
      </div>

      <!--  Included the Cart Manager Livewire Component -->
     
      <!-- 🛍️ Products Grid -->
      @forelse ($products as $product)

        
        
<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">

          <div class="card product_card h-100 shadow-sm">
            <img src="{{ asset('storage/'.($product->images[0]?->img_path ?? 'default.png')) }}" 
                 class="product_img" 
                 alt="{{ $product->product_name }}"

                 style="width:100%; height:300px; object-fit:cover; background:#f9f9f9; transition:0.4s ease;">


            <div class="card-body text-center d-flex flex-column">
              <h5>{{ $product->product_name }}</h5>
              <p class="pcc_in">In <a href="#">
                {{ $product->category->category_name ?? 'Uncategorized' }}
              </a></p>
              <p class="pcc_price">

          {{-- Price & Discount --}}
          <span>
              Price:
              @if($product->discount_percent > 0)
  <span class="text-success fw-bold">৳{{ $product->discounted_price }}</span>
  <small>({{ $product->discount_percent }}% OFF)</small>
  <span class="text-muted"><s>৳{{ $product->regular_price }}</s></span>
@else
  <span class="fw-bold">৳{{ $product->regular_price }}</span>
@endif
</span>

         
 {{-- Buttons --}}
 <div style="margin-top:15px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
 <!-- 🧠 This is add to cart component location -->
   @livewire('cart-manager-component', ['product' => $product], key($product->id))

   <a href="{{ route('products.viewdetails', $product->id) }}"   style="background:#007bff; color:#fff; text-decoration:none; border-radius:8px; padding:7px 14px; font-size:14px; transition:0.3s;">
                🔍 View Details
              </a>

              @livewire('comment-section', ['product' => $product], key('comment-'.$product->id))

  </div>
           
  

            </div>
          </div>
        </div>

   @empty
   <div class="col-12 text-center btn btn-outline-dark">
    <p >
      No product found for this category
    </p>

   </div>


      @endforelse

    </div>
  </div>
</section>
