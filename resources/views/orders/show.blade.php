@extends('layouts.app')

@section('content')
<h1>Order Details</h1>
<p><strong>Invoice Number:</strong> {{ $order->invoiceNumber }}</p>
<p><strong>Customer:</strong> {{ $order->customer ? $order->customer->name : 'N/A' }}</p>
<p><strong>Order Date:</strong> {{ $order->orderDateTime }}</p>
<p><strong>Delivery Address:</strong> {{ $order->deliveryAddress }}</p>
<p><strong>Status:</strong> {{ $order->status->statusName }}</p>
<p><strong>Notes:</strong> {{ $order->notes }}</p>

@if($order->status->statusName == 'In Route' || $order->status->statusName == 'Delivered')
<h3>Upload Evidence Photo</h3>
<form action="{{ route('orders.uploadPhoto', $order->orderID) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Choose Photo:</label>
        <input type="file" name="photo" required>
    </div>
    <button type="submit">Upload Photo</button>
</form>
@endif

<a href="{{ route('orders.index') }}">Back to Order List</a>
@endsection