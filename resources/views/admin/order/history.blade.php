@extends('admin.layouts.layout')

@section('admin_page_title')
order history page
@endsection

@section('admin_layout')
    <div class="container mt-4">
    <h3 class="mb-4">All Order History</h3>

     <div class="input-group" style="max-width: 400px;">
     <form action="{{ route('admin.order.search') }}" method="GET" class="mb-3">

        @csrf

       <input type="text" name="search" 
               class="form-control border border-primary rounded-start" 
               placeholder="Search by Name, Email or Product..." 
               value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i>
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
                <th>Action</th>
                <th>Print PDF</th>
                        </tr>
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
                                    
                                    <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a></br>
                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                     </td>
                                          <td>
                                          <a href="{{ route('admin.order.Printpdf', $order->id) }}" class="btn btn-secondary">Print PDF</a>


                                          </td>
                                    </form>
                               
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
