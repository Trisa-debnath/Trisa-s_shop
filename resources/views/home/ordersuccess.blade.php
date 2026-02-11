@extends('layouts.user')
@section('home')


<h3>Order Placed Successfully!</h3>
<p>Thank you for your order. Your cart is now empty.</p>
<a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
@endsection