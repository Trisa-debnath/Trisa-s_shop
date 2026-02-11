@extends('seller.layouts.layout')
@section('seller_page_title')
orderhistory
@endsection
@section('seller_layout')
this is seller orderhistory

     <div class="container mt-4">
    <h3 class="mb-4">All Order History</h3>

     <div class="input-group" style="max-width: 400px;">
     <form action="{{ route('seller.order.search') }}" method="GET" class="mb-3">

        @csrf

       <input type="text" name="search" 
               class="form-control border border-primary rounded-start" 
               placeholder="Search by Name, Email or Product..." 
               value="{{ request('search') }}"></br>
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> search
        </button>
</form>
</div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                  <th>Address</th>
           
                <th>Total Price</th>
                <th>Payment method</th>
                <th>Payment Status</th>
                <th>Delivery status</th>
               <th>Order Date</th>
             
                    </thead>
                    <tbody class="text-center">
                        @forelse($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name ?? 'N/A'}}</td>
                                <td>{{$order->email?? 'N/A'}}</td>
                               <td>{{$order->Phone?? 'N/A'}}</td>
                               <td>{{$order->address?? 'N/A'}}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>
                                    @if($order->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->status == 'completed')
                                        <span class="badge bg-primary">Completed</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                                <td>
              
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

