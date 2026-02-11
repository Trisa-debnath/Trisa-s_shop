@extends('layouts.user')
@section('home')

<h3>Order Summary</h3>

@if(count($cart) > 0)
    <ul class="list-group mb-3">
        @foreach($cart as $id => $item)
            <li class="list-group-item d-flex justify-content-between">
                {{ $item['name'] }} × {{ $item['quantity'] }}
                <span>${{ $item['quantity'] * $item['price'] }}</span>
            </li>
        @endforeach       
    
    {{-- Total Price --}}
    <li class="list-group-item d-flex justify-content-between border border-primary rounded">
        <strong>Total:</strong>
        <span>${{ $total }}</span>
    </li>
   
  </ul>

    <form method="POST" action="{{ route('order.store') }}">
        @csrf
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        {{-- Payment Method --}}
        <div class="mb-3">
            <h4>Select Payment Option</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="cod" required>
                <label class="form-check-label">Cash On Delivery</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="bkash">
                <label class="form-check-label">Pay by Bkash</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="nagad">
                <label class="form-check-label">Pay by Nagad</label>
            </div>
  
<div class="card border-primary shadow-sm my-3" style="max-width: 300px; border-radius: 12px;">
    <div class="card-body text-center">
        <h5 class="card-title text-primary mb-3">Payment Option</h5>
        <a href="{{ url('stripe', $total) }}" 
           class="btn btn-outline-primary px-4 py-2 rounded-pill fw-semibold">
           💳 Pay by Card
        </a>
    </div>

        </div>

        <button type="submit" class="btn btn-success">Confirm Order</button>
    </form>
@else
    <p>Your cart is empty!</p>
@endif

@endsection
