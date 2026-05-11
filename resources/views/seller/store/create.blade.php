@extends('seller.layouts.layout')

@section('seller_page_title')
Create Store
@endsection

@section('seller_layout')
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Create Store</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('vendor.store.create') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="store_name" class="form-label">Store Name</label>
                        <input
                            type="text"
                            name="store_name"
                            id="store_name"
                            class="form-control"
                            value="{{ old('store_name') }}"
                            placeholder="Enter store name"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            class="form-control"
                            value="{{ old('slug') }}"
                            placeholder="store-slug"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea
                            name="details"
                            id="details"
                            class="form-control"
                            rows="5"
                            placeholder="Write store details"
                            required
                        >{{ old('details') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Create Store</button>
                        <a href="{{ route('vendor.store.manage') }}" class="btn btn-outline-secondary">Manage Stores</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
