@extends('admin.layouts.layout')

@section('admin_page_title', 'Edit Order')

@section('admin_layout')
<div class="container mt-4">
    <h3>Edit Order #{{ $order->id }}</h3>

    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="status">Delivery Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
@endsection
