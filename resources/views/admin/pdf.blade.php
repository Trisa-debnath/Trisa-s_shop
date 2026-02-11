<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
</head>
<body>
    <h2>Order #{{ $order->id }}</h2>
    <p>Name: {{ $order->name }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Phone: {{ $order->Phone }}</p>
    <p>Address: {{ $order->address }}</p>

    <h4>Products:</h4>
    <ul>
        @foreach($order->products as $product)
            <li>{{ $product->product_name }} - Quantity: {{ $product->pivot->quantity }}</li>
        @endforeach
    </ul>

    <p>Total Price: ${{ number_format($order->total, 2) }}</p>
    <p>Payment Method: {{ ucfirst($order->payment_method) }}</p>
    <p>Payment Status: {{ ucfirst($order->payment_status) }}</p>
    <p>Delivery Status: {{ ucfirst($order->status) }}</p>
</body>
</html>
