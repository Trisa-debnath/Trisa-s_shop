@extends('layouts.user')
@section('home')


<h3>Order Placed cancel!</h3>
<p>Now your cart is cancel. Your cart is now empty.</p>
<a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
@endsection