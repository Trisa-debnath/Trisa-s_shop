@extends('seller.layouts.layout')

@section('seller_page_title')
Manage Stores
@endsection

@section('seller_layout')
<div class="card">
    <div class="card-header d-flex flex-column flex-md-row gap-2 justify-content-between align-items-md-center">
        <div>
            <h5 class="card-title mb-1">Manage Stores</h5>
            <p class="text-muted mb-0">Create, update, and delete stores owned by the logged-in seller.</p>
        </div>
        <a href="{{ route('vendor.store') }}" class="btn btn-primary">Create Store</a>
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

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Store Name</th>
                        <th>Slug</th>
                        <th>Details</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stores as $store)
                        <tr>
                            <td>{{ $store->id }}</td>
                            <td>{{ $store->store_name }}</td>
                            <td>{{ $store->slug }}</td>
                            <td>{{ Str::limit($store->details, 80) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('edit.store', $store->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('delete.store', $store->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this store?')"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No stores found. Create a store to start adding vendor products.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
