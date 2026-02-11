
<div class="container-fluid my-4">
    
    <!-- 🔍 Searchbar -->
    <form class="d-flex search-bar mb-1" wire:submit.prevent="search">
        <input 
            class="form-control me-1" 
            type="search" 
            placeholder="Search products or categories..." 
            aria-label="Search"
            wire:model="query"
        >
        <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i> Search
        </button>
    </form>

    <!-- 🧾 Search results -->
    @if(!empty($products))
       
            <h5 class="mb-3 text-center">🔍 Search Results</h5>
           
             <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-4">
            @forelse($products as $product)
                   <div class="col">
                    
                        <div class="card shadow-sm h-100 w-100">
 <img src="{{ asset('storage/'.($product->images[0]?->img_path ?? 'default.png')) }}" 
                            class="card-img-top" 
                            style="height: 190px; object-fit: cover;"
                            alt="{{ $product->product_name }}" >
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="text-muted mb-1">
                                Category: {{ $product->category->category_name ?? 'Uncategorized' }}
                            </p>

                            @if ($product->discounted_price > 0)
                                <p class="text-danger mb-1">
                                    {{ number_format($product->discount_percent) }}% OFF
                                </p>
                                <p>
                                    <span style="text-decoration: line-through; color:#888;">
                                        ${{ $product->regular_price }}
                                    </span>
                                    <span class="fw-bold text-success">
                                        ${{ $product->discounted_price }}
                                    </span>
                                </p>
                            @else
                                <p class="fw-bold text-success mb-0">
                                    ${{ $product->regular_price }}
                                </p>
                            @endif

                            <!-- 🔘 Buttons -->
                            <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
                                @livewire('cart-manager-component', ['product' => $product], key('search-cart-'.$product->id))
                                <a href="{{ route('products.viewdetails', $product->id) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    🔍 View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">No products found.</div>
                </div>
            @endforelse
        </div>
    @endif
</div>