@extends('layouts.user')
@section('home')


      
<div class="container py-4">
   <div class="row">
      @forelse ($products as $product)

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card product_card h-100 shadow-sm">
            <img src="{{ asset('storage/'.($product->images[0]?->img_path ?? 'default.png')) }}" 
                 class="product_img" 
                 alt="{{ $product->product_name }}">

            <div class="card-body text-center d-flex flex-column">
              <h5>{{ $product->product_name }}</h5>
              <p class="pcc_in">In <a href="#">
                {{ $product->category->category_name ?? 'Uncategorized' }}
              </a></p>
                {{-- Price & Discount --}}
              <p class="pcc_price">
                 @if($product->discounted_price > 0)
                 <small style="color:#dc3545;"> 
                  {{ number_format($product->discount_percent) }}% OFF 
                      </small></br>
                      <p class="fw-bold fs-5">
                 Price :
               <span style="text-decoration:line-through; color:#0ea3c9; font-size:14px; margin:0;">
                 ${{ $product->regular_price }}
                </span>
                 <span style="color:#6f42c1; font-size:16px; font-weight:600; margin-bottom:5px;">
               ${{ $product->discounted_price }}  </span>
                      </p>

         @else
              <p style="color:#218838; font-size:16px; font-weight:600; margin:0;">
                  Price: ${{ $product->regular_price }}
                </p>
               @endif



              </p>

          <!--button for  add to cart-->     
 <div style="margin-top:15px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">        
 <!--  This is add to cart component location -->
   @livewire('cart-manager-component', ['product' => $product], key($product->id))
          <!--for view details-->  
    <a href="{{ route('products.viewdetails', $product->id) }}"   style="background:#007bff; color:#fff; text-decoration:none; border-radius:8px; padding:7px 14px; font-size:14px; transition:0.3s;">
                View Details
              </a>

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

     
              



      
     


  


@endsection
