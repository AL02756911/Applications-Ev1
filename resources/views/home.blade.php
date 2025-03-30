<!DOCTYPE html>
<html>

<head>
    <title>Order Search</title>
</head>

<body>
    <h1>Search Order by Invoice Number</h1>
    <form action="{{ route('order.search') }}" method="POST">
        @csrf
        <input type="text" name="invoiceNumber" placeholder="Enter Invoice Number" required>
        <button type="submit">Search</button>
    </form>

    @if(isset($order))
    <h2>Order Details</h2>
    <p>Invoice: {{ $order->invoiceNumber }}</p>
    <p>Status: {{ $order->status->statusName }}</p>
    @if($order->status->statusName == 'Delivered')
    <img src="{{ asset('storage/' . $order->deliveredPhoto) }}" alt="Delivered Photo" width="200">
    @elseif($order->status->statusName == 'In Process')
    <p>Process Name: In Process</p>
    <p>Date: {{ $order->orderDateTime }}</p>
    @endif
    @endif
</body>

</html>