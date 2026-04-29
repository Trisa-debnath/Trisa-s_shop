@if ($errors->any())
    <div class="alert alert-warning">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $selectedCategory = old('category_id', optional($product)->category_id);
    $selectedSubcategory = old('subcategory_id', optional($product)->subcategory_id);
    $selectedStore = old('store_id', optional($product)->store_id);
    $selectedStatus = old('status', optional($product)->status ?? 'Draft');
    $selectedStockStatus = old('stock_status', optional($product)->stock_status ?? 'In stock');
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="{{ old('product_name', optional($product)->product_name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" rows="6" class="form-control" required>{{ old('description', optional($product)->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku', optional($product)->sku) }}" placeholder="Auto generated if empty">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', optional($product)->slug) }}" placeholder="Auto generated if empty">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Regular Price</label>
                            <input type="number" step="0.01" min="0" name="regular_price" class="form-control" value="{{ old('regular_price', optional($product)->regular_price) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Discount Percent</label>
                            <input type="number" step="0.01" min="0" max="100" name="discount_percent" class="form-control" value="{{ old('discount_percent', optional($product)->discount_percent) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Tax Rate</label>
                            <input type="number" step="0.01" min="0" name="tax_rate" class="form-control" value="{{ old('tax_rate', optional($product)->tax_rate ?? 0) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', optional($product)->meta_title) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', optional($product)->meta_description) }}">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Store</label>
                        <select name="store_id" class="form-control" required>
                            <option value="">Select store</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" @selected((string) $selectedStore === (string) $store->id)>
                                    {{ $store->store_name }} @if($store->user) - {{ $store->user->name }} @endif
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Seller will be set from the selected store owner.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected((string) $selectedCategory === (string) $category->id)>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Subcategory</label>
                        <select name="subcategory_id" class="form-control" required>
                            <option value="">Select subcategory</option>
                            @foreach($categories as $category)
                                @foreach($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" @selected((string) $selectedSubcategory === (string) $subcategory->id)>
                                        {{ $category->category_name }} - {{ $subcategory->subcategory_name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stock</label>
                            <input type="number" min="0" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', optional($product)->stock_quantity ?? 0) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stock Status</label>
                            <select name="stock_status" class="form-control" required>
                                <option value="In stock" @selected($selectedStockStatus === 'In stock')>In stock</option>
                                <option value="out of stock" @selected($selectedStockStatus === 'out of stock')>Out of stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Draft" @selected($selectedStatus === 'Draft')>Draft</option>
                            <option value="published" @selected($selectedStatus === 'published')>Published</option>
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input type="hidden" name="visibility" value="0">
                        <input class="form-check-input" type="checkbox" name="visibility" value="1" id="visibility" @checked(old('visibility', optional($product)->visibility))>
                        <label class="form-check-label fw-bold" for="visibility">Visible on storefront</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($product && $product->images->isNotEmpty())
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold">Current Images</div>
            <div class="card-body">
                <div class="row">
                    @foreach($product->images as $image)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="border rounded p-2 h-100">
                                <img src="{{ asset('storage/'.$image->img_path) }}" class="img-fluid rounded mb-2" alt="Product image">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                    <label class="form-check-label text-danger" for="delete_image_{{ $image->id }}">Remove</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-4">
        <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-check2-circle"></i> {{ $buttonText }}
        </button>
    </div>
</form>
