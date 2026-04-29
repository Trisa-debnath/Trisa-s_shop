@extends('admin.layouts.layout')

@section('admin_page_title')
Create Product
@endsection

@section('admin_layout')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Create Product</h2>
        <a href="{{ route('product.manage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    @include('admin.product.form', [
        'action' => route('admin.product.store'),
        'method' => 'POST',
        'buttonText' => 'Create Product',
        'product' => null,
    ])
</div>
@endsection
