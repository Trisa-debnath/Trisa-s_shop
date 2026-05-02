@extends('admin.layouts.layout')

@section('admin_page_title')
Home Page Settings
@endsection

@section('admin_layout')
<style>
    .settings-shell {
        color: #1f2937;
    }

    .settings-hero {
        background: linear-gradient(135deg, #123b73 0%, #276fbf 54%, #1cbb8c 100%);
        border-radius: 8px;
        color: #fff;
        padding: 24px;
    }

    .settings-hero h1 {
        color: #fff;
        font-size: 1.55rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .settings-hero p {
        color: rgba(255, 255, 255, 0.84);
        margin-bottom: 0;
    }

    .settings-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 8px;
        box-shadow: 0 10px 24px rgba(18, 59, 115, 0.06);
    }

    .settings-card-header {
        border-bottom: 1px solid #edf1f7;
        padding: 18px 20px;
    }

    .settings-card-header h2 {
        color: #111827;
        font-size: 1rem;
        font-weight: 800;
        margin: 0;
    }

    .settings-label {
        color: #374151;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .settings-help {
        color: #6b7280;
        font-size: 0.82rem;
        margin-top: 6px;
    }

    .preview-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 18px;
    }

    .preview-title {
        color: #111827;
        font-size: 1.15rem;
        font-weight: 800;
    }

    .preview-product {
        align-items: center;
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 7px;
        display: flex;
        justify-content: space-between;
        padding: 12px;
    }

    .soft-badge {
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 5px 10px;
    }

    .action-footer {
        background: #f8fafc;
        border-top: 1px solid #edf1f7;
        padding: 16px 20px;
    }
</style>

@php
    $selectedDiscountProduct = old('discounted_product_id', $homepagesetting->discounted_product_id);
    $selectedFeaturedOne = old('featured_product_1_id', $homepagesetting->featured_product_1_id);
    $selectedFeaturedTwo = old('featured_product_2_id', $homepagesetting->featured_product_2_id);
    $discountProduct = $products->firstWhere('id', (int) $selectedDiscountProduct);
    $featuredOne = $products->firstWhere('id', (int) $selectedFeaturedOne);
    $featuredTwo = $products->firstWhere('id', (int) $selectedFeaturedTwo);
@endphp

<div class="settings-shell">
    <div class="settings-hero mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="text-white-50 fw-bold text-uppercase mb-2" style="letter-spacing: .04em;">Storefront Control</div>
                <h1>Home Page Settings</h1>
                <p>Choose the promoted discount product and featured products shown on the customer home page.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-light">
                    <i class="bi bi-box-arrow-up-right"></i> View Storefront
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Please check the form:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check2-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-info">
            Product create korar por home page settings update korte parbe.
            <a href="{{ route('admin.product.create') }}" class="alert-link">Create product</a>
        </div>
    @endif

    <form action="{{ route('home.setting.update') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xl-8 mb-4">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h2>Promotion Setup</h2>
                        <small class="text-muted">Main discount section content</small>
                    </div>

                    <div class="p-4">
                        <div class="mb-3">
                            <label for="discount_heading" class="settings-label">Discount Heading</label>
                            <input
                                type="text"
                                name="discount_heading"
                                id="discount_heading"
                                class="form-control"
                                required
                                maxlength="255"
                                value="{{ old('discount_heading', $homepagesetting->discount_heading) }}"
                                placeholder="Example: Flash Deals You Will Love"
                            >
                            <div class="settings-help">This title appears above the highlighted discount product.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="discounted_product_id" class="settings-label">Discounted Product</label>
                                <select name="discounted_product_id" id="discounted_product_id" class="form-control" required>
                                    <option value="">Select product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @selected((string) $selectedDiscountProduct === (string) $product->id)>
                                            {{ $product->product_name }} - ${{ number_format($product->regular_price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="discount_percent" class="settings-label">Discount Percent</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        name="discount_percent"
                                        id="discount_percent"
                                        class="form-control"
                                        required
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        value="{{ old('discount_percent', $homepagesetting->discount_percent) }}"
                                    >
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="settings-card mt-4">
                    <div class="settings-card-header">
                        <h2>Featured Products</h2>
                        <small class="text-muted">Optional products for homepage spotlight blocks</small>
                    </div>

                    <div class="p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="featured_product_1_id" class="settings-label">Featured Product 1</label>
                                <select name="featured_product_1_id" id="featured_product_1_id" class="form-control">
                                    <option value="">No product selected</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @selected((string) $selectedFeaturedOne === (string) $product->id)>
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="featured_product_2_id" class="settings-label">Featured Product 2</label>
                                <select name="featured_product_2_id" id="featured_product_2_id" class="form-control">
                                    <option value="">No product selected</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @selected((string) $selectedFeaturedTwo === (string) $product->id)>
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="action-footer d-flex justify-content-between align-items-center">
                        <span class="text-muted">Changes will update the home page content.</span>
                        <button type="submit" class="btn btn-success px-4" @disabled($products->isEmpty())>
                            <i class="bi bi-check2-circle"></i> Save Settings
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-4">
                <div class="settings-card">
                    <div class="settings-card-header">
                        <h2>Current Preview</h2>
                        <small class="text-muted">Saved or selected homepage content</small>
                    </div>

                    <div class="p-4">
                        <div class="preview-box mb-3">
                            <div class="soft-badge bg-success bg-opacity-10 text-success mb-3">Discount Block</div>
                            <div class="preview-title mb-2">
                                {{ old('discount_heading', $homepagesetting->discount_heading) ?: 'No heading set yet' }}
                            </div>
                            <div class="preview-product">
                                <div>
                                    <div class="fw-bold">{{ $discountProduct->product_name ?? 'Select a product' }}</div>
                                    <small class="text-muted">Homepage discount item</small>
                                </div>
                                <span class="soft-badge bg-warning bg-opacity-10 text-warning">
                                    {{ old('discount_percent', $homepagesetting->discount_percent) ?: 0 }}%
                                </span>
                            </div>
                        </div>

                        <div class="preview-box">
                            <div class="soft-badge bg-primary bg-opacity-10 text-primary mb-3">Featured</div>
                            <div class="preview-product mb-2">
                                <div>
                                    <div class="fw-bold">{{ $featuredOne->product_name ?? 'Featured product 1' }}</div>
                                    <small class="text-muted">Spotlight position 1</small>
                                </div>
                            </div>
                            <div class="preview-product">
                                <div>
                                    <div class="fw-bold">{{ $featuredTwo->product_name ?? 'Featured product 2' }}</div>
                                    <small class="text-muted">Spotlight position 2</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
