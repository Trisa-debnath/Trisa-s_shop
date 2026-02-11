@extends('layouts.user')
@section('home')

<style>
  .product_card {
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 30px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .product_img {
    width: 100%;
    height: 250px;
    object-fit: contain;
    background-color: #f9f9f9;
    padding: 10px;
    border-bottom: 1px solid #f0f0f0;
    transition: transform 0.4s ease;
  }

  .product_card:hover .product_img {
    transform: scale(1.07);
  }

  .pc_content {
    padding: 20px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .pc_content h2 {
    font-size: 20px;
    color: #333;
    font-weight: 600;
    margin-bottom: 8px;
  }

  .pcc_in {
    color: #666;
    margin-bottom: 10px;
    font-size: 14px;
  }

  .pcc_in a {
    color: #007bff;
    text-decoration: none;
  }

  .pcc_price {
    font-size: 18px;
    font-weight: bold;
    color: #007bff;
    margin-bottom: 15px;
  }

  .pcc_btns {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .addtocart,
  .viewbtn {
    padding: 8px 14px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .addtocart {
    background-color: #28a745;
    color: #fff;
  }

  .addtocart:hover {
    background-color: #218838;
  }

  .viewbtn {
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
  }

  .viewbtn:hover {
    background-color: #0056b3;
  }

  .card-lg {
    background: #fff0f0;
    padding: 40px;
    border-radius: 20px;
  }

  .card-sm {
    border-radius: 15px;
    margin-bottom: 20px;
    padding: 20px;
  }

  .bg-purple {
    background-color: #6f42c1;
    color: #fff;
  }

  .bg-sky {
    background-color: #0dcaf0;
    color: #fff;
  }

  @media (max-width: 576px) {
    .product_img {
      height: 200px;
    }

    .pc_content h2 {
      font-size: 18px;
    }

    .addtocart,
    .viewbtn {
      font-size: 13px;
      padding: 6px 12px;
    }
  }
</style>




{{-- 🖼️ Full-Width Slideshow of 5 Product Images --}}
<div class="container-fluid px-0">
  <div id="productSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach ($sliderProducts as $key => $product)
    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
 <img 
 src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->img_path) : asset('home_asset/img/default.png') }}"
               alt="{{ $product->product_name ?? 'Default Product' }}"
               class="d-block w-100"
               style="height: 500px; object-fit: cover; margin: 0; padding: 0;">
        </div>
      @endforeach
    </div>

    {{-- Navigation arrows --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#productSlider" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#productSlider" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>


{{--  Discount & Featured Products Section --}}
<section id="hero" class="py-5">

  <h3 class="mb-3 text-center fw-bold text-uppercase text-primary">🔥 Discounted Products</h3>
<div class="d-flex overflow-auto gap-3 pb-2 px-3" style="scroll-behavior:smooth;">

    @foreach($discountProducts as $product)
    <div class="card shadow p-3" style="min-width:250px; flex:0 0 auto; border-radius:15px;">
        {{-- Product Image --}}
        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->img_path) : asset('home_asset/img/default.png') }}" class="img-fluid mb-2" style="height:150px; object-fit:contain;">

        {{-- Product Name --}}
        <h5 class="fw-bold">{{ $product->product_name }}</h5>
        {{-- Discount --}}
        
        @if($product->discount_percent > 0)
        
    <span class="text-danger fw-bold">{{ $product->discount_percent }}% OFF</span>
    <p>
        <span class="text-decoration-line-through text-muted">Price ${{ $product->regular_price }}</span>
        <span class="fw-bold text-success ms-2">${{ $product->discounted_price }}</span>
    </p>
@else
    <p> Price ${{ $product->regular_price }}</p>
@endif

        <div class="d-flex gap-2 flex-wrap justify-content-center">
            @livewire('cart-manager-component', ['product' => $product], key('discount-'.$product->id))
            <a href="{{ route('products.viewdetails', $product->id) }}" class="btn btn-primary btn-sm">View Details</a>        
        </div>
        
    </div>
    @endforeach
</div>

 
</section>


{{-- homePageComponent--}}
<div class="mt-4">
  @livewire('HomePageComponent')
</div>

{{-- 🆕 New Arrivals Section --}}

<div class="container-fluid p-0 m-0">

  <h3 class="mb-4 text-center fw-bold text-uppercase text-success">🛍️ New Arrivals</h3>
  <div class="row">
    @foreach ($products as $product)
      
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">

        <div class="w-100 shadow-lg rounded-3 overflow-hidden" 
             style="background:#fff; transition:0.3s ease; display:flex; flex-direction:column;">
          
          {{-- Product Image --}}
          <img 
            src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->img_path) : asset('home_asset/img/default.png') }}" 
            alt="{{ $product->product_name }}" 
            style="width:100%; height:280px; object-fit:cover; background:#f9f9f9; transition:0.4s ease;"
            onmouseover="this.style.transform='scale(1.05)'" 
            onmouseout="this.style.transform='scale(1)'" 
          >

          {{-- Product Details --}}
          <div style="padding:18px; text-align:center; flex-grow:1; display:flex; flex-direction:column; justify-content:space-between;">
            <div>
              <h2 style="font-size:20px; font-weight:600; color:#333; margin-bottom:8px;">
                {{ $product->product_name }}
              </h2>
            
                 Price :
               <span style=" color:#0ea3c9; font-size:16px; font-weight:600; margin:0;">
                 ${{ $product->regular_price }}
                </span>
            
               

            </div>

            {{-- Buttons --}}
            <div style="margin-top:15px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
   {{-- 🛒 Livewire Add To Cart --}}
   @livewire('cart-manager-component', ['product' => $product], key('new-arrival-'.$product->id))
   <a href="#"   style="background:#007bff; color:#fff; text-decoration:none; border-radius:8px; padding:7px 14px; font-size:14px; transition:0.3s;">
                🔍 View Details
              </a>
            </div>
          </div>

        </div>
      </div>
    @endforeach
  </div>
</div>


@endsection
