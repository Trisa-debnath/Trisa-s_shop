@extends('admin.layouts.layout')

@section('admin_page_title')
Admin Dashboard
@endsection

@section('admin_layout')
<style>
    .dashboard-shell {
        color: #1f2937;
    }

    .dashboard-hero {
        background: linear-gradient(135deg, #123b73 0%, #276fbf 48%, #1cbb8c 100%);
        border-radius: 8px;
        color: #fff;
        overflow: hidden;
        padding: 24px;
        position: relative;
    }

    .dashboard-hero::after {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        content: "";
        height: 220px;
        position: absolute;
        right: -80px;
        top: -90px;
        width: 220px;
    }

    .dashboard-hero h1 {
        color: #fff;
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .dashboard-hero p {
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 0;
    }

    .quick-action {
        align-items: center;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 7px;
        color: #fff;
        display: inline-flex;
        font-weight: 600;
        gap: 8px;
        padding: 10px 14px;
    }

    .quick-action:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
        text-decoration: none;
    }

    .metric-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 8px;
        box-shadow: 0 10px 24px rgba(18, 59, 115, 0.06);
        height: 100%;
        padding: 18px;
    }

    .metric-card .metric-icon {
        align-items: center;
        border-radius: 8px;
        display: inline-flex;
        height: 42px;
        justify-content: center;
        width: 42px;
    }

    .metric-label {
        color: #6b7280;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .metric-value {
        color: #111827;
        font-size: 1.55rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .panel-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 8px;
        box-shadow: 0 10px 24px rgba(18, 59, 115, 0.05);
    }

    .panel-title {
        color: #111827;
        font-size: 1rem;
        font-weight: 800;
        margin: 0;
    }

    .status-row {
        display: grid;
        gap: 8px;
    }

    .soft-badge {
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 5px 10px;
    }

    .product-thumb {
        background: #f3f6fb;
        border-radius: 7px;
        height: 44px;
        object-fit: cover;
        width: 44px;
    }

    .table-clean td,
    .table-clean th {
        border-color: #edf1f7;
        vertical-align: middle;
    }

    @media (max-width: 767.98px) {
        .dashboard-hero {
            padding: 18px;
        }

        .dashboard-hero h1 {
            font-size: 1.35rem;
        }
    }
</style>

<div class="dashboard-shell">
    <div class="dashboard-hero mb-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="metric-label text-white-50 mb-2">Store Command Center</div>
                <h1>Welcome back, {{ auth()->user()->name ?? 'Admin' }}</h1>
                <p>Track products, orders, revenue, and customer activity from one clean workspace.</p>
            </div>
            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.order.history') }}" class="quick-action me-2 mb-2">
                    <i class="bi bi-receipt"></i>
                    Orders
                </a>
                <a href="{{ route('product.manage') }}" class="quick-action mb-2">
                    <i class="bi bi-box-seam"></i>
                    Products
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="metric-label">Revenue</div>
                        <div class="metric-value">${{ number_format($total_revenue, 2) }}</div>
                        <small class="text-muted">${{ number_format($today_revenue, 2) }} today</small>
                    </div>
                    <span class="metric-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="metric-label">Orders</div>
                        <div class="metric-value">{{ $total_order }}</div>
                        <small class="text-muted">{{ $today_orders }} new today</small>
                    </div>
                    <span class="metric-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-bag-check fs-4"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="metric-label">Products</div>
                        <div class="metric-value">{{ $total_product }}</div>
                        <small class="text-muted">Active catalog items</small>
                    </div>
                    <span class="metric-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-box2-heart fs-4"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="metric-label">Customers</div>
                        <div class="metric-value">{{ $total_user }}</div>
                        <small class="text-muted">{{ $paid_orders }} paid orders</small>
                    </div>
                    <span class="metric-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-people fs-4"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-4">
            <div class="panel-card h-100">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="panel-title">Order Health</h2>
                        <small class="text-muted">Current delivery pipeline</small>
                    </div>
                </div>
                <div class="p-3 status-row">
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold">Completed</span>
                            <span>{{ $total_deleverd }} orders</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: {{ $completed_percent }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold">Pending</span>
                            <span>{{ $total_pending }} orders</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: {{ $pending_percent }}%"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="text-muted">Cancelled orders</span>
                        <span class="soft-badge bg-danger bg-opacity-10 text-danger">{{ $total_cancelled }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="panel-card h-100">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <h2 class="panel-title">Recent Orders</h2>
                    <a href="{{ route('admin.order.history') }}" class="btn btn-sm btn-outline-primary">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-clean mb-0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->name ?? 'N/A' }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="soft-badge {{ $order->payment_status === 'paid' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="soft-badge bg-secondary bg-opacity-10 text-secondary">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No recent orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="panel-card">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <h2 class="panel-title">Latest Products</h2>
                    <a href="{{ route('discount.manage') }}" class="btn btn-sm btn-outline-success">Manage discounts</a>
                </div>
                <div class="row g-0">
                    @forelse($recent_products as $product)
                        <div class="col-xl-3 col-md-6 border-end border-bottom">
                            <div class="p-3 d-flex align-items-center">
                                @php
                                    $image = $product->images->first();
                                @endphp
                                @if($image)
                                    <img src="{{ asset('storage/'.$image->img_path) }}" class="product-thumb me-3" alt="{{ $product->product_name }}">
                                @else
                                    <div class="product-thumb me-3 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="fw-bold text-dark text-truncate">{{ $product->product_name }}</div>
                                    <small class="text-muted">${{ number_format($product->regular_price, 2) }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 p-4 text-center text-muted">No products found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
