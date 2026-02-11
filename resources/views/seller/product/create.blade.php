@extends('seller.layouts.layout')
@section('seller_page_title')
create product
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
        <div class="message-success">
       @if(session('success'))
       <h3 class="mb-4">{{session('success')}}</h3>
        @endif
        </div>
        <!-- seller product Form -->
        <div class="row">
						<div class="col-12 col-lg-8  ">
							<div class="card shadow-lg">
								<div class="card-header bg-primary text-bg-white"
                          >
									<h5 class=" card-title mb-2 ">Add product</h5>
								</div>
                                
        <form action="{{ route('vendor.store.procuct') }}"  method="POST"  class="p-4" enctype="multipart/form-data">
            @csrf
            <!--  product name -->
            <div class="mb-3" >
                <label for="product_name" class="form-label fw-bold text-dark" >Give name of your Product</label>
                <input type="text" name="product_name" id="product_name" class="form-control" required placeholder="add product name" >
            </div> 
<!--  description -->
             <div class="mb-3" >
                <label for="description" class="form-label fw-bold text-dark" >Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
            </div>
              <!--  Images -->
                  <div class="mb-3" >
                <label for="Images" class="form-label fw-bold text-dark" >Uplode your Product Images</label>
                <input type="file" name="images[]" multiple>
            </div>
            <!--  sku -->
             <div class="mb-3" >
                <label for="sku" class="form-label fw-bold text-dark" >Sku</label>
                <input type="text" name="sku" id="sku" class="form-control"  placeholder="XLD3402" >
            </div>
              <!-- 	store_id  -->
             <div class="mb-3" >
                <label for="store_id" class="form-label fw-bold text-dark" >Select Yours store for this product</label>
                <select class="form-control" name="store_id" required >
    <option value=""> Select Yours store </option>
    @foreach($stores as $store)
    <option value="{{$store->id}}">{{$store->store_name}}</option>
    @endforeach
   </select>
    </div>
   <!-- 	regular_price  -->
<div class="mb-3" >
                <label for="regular_price" class="form-label fw-bold text-dark" >Product Regular Price</label>
                <input type="number" name="regular_price" id="regular_price" class="form-control"  >
            </div> 
             <!-- 	discounted_percent -->
<div class="mb-3">
    <label for="discount_percent" class="form-label fw-bold text-dark">Discount Percent (if any)</label>
    <input type="number" name="discount_percent" id="discount_percent" class="form-control" min="0" max="100">
</div>


            

              <!-- 	tax_rate  -->
              <div class="mb-3" >
                <label for="tax_rate" class="form-label fw-bold text-dark" >Product Tax Rate</label>
                <input type="number" name="tax_rate" id="tax_rate" class="form-control"  >
            </div>
             <!-- 	stock_quantity  -->
              <div class="mb-3" >
                <label for="stock_quantity" class="form-label fw-bold text-dark" >Satock Quantity</label>
                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control"  >
            </div>
             <!-- 	slug  -->
              <div class="mb-3" >
                <label for="slug" class="form-label fw-bold text-dark" >Slug </label>
                <input type="text" name="slug" id="slug" class="form-control"  >
            </div>
            <!-- 	meta_title -->
              <div class="mb-3" >
                <label for="meta_title" class="form-label fw-bold text-dark" >Meta title </label>
                <input type="text" name="meta_title" id="meta_title" class="form-control"  >
            </div>
            <!-- 	meta_description -->
              <div class="mb-3" >
                <label for="meta_description" class="form-label fw-bold text-dark" >Meta Description </label>
                <input type="text" name="meta_description" id="meta_description" class="form-control"  >
            </div>
               <!-- Category & Subcategory -->
                <div class="mb-3">
         <livewire:category-subcategory/>
                </div>
              <div class="text-end">
                    <button type="submit" class="btn btn-success w-100 px-4">Add Product</button>
                </div>
        </form>
       </div>
    </div>
@endsection