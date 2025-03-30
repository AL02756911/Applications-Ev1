@extends('layouts.app')

@section('content')
<h1>Edit Order</h1>
<form action="{{ route('orders.update', $order->orderID) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Invoice Number:</label>
        <input type="text" name="invoiceNumber" value="{{ old('invoiceNumber', $order->invoiceNumber) }}" required>
    </div>
    <div>
        <label>Customer Number:</label>
        <select name="customerNumber" required>
            @foreach($customers as $customer)
            <option value="{{ $customer->customerNumber }}" {{ $order->customerNumber == $customer->customerNumber ? 'selected' : '' }}>
                {{ $customer->name }} ({{ $customer->customerNumber }})
            </option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Order Date & Time:</label>
        <input type="datetime-local" name="orderDateTime" value="{{ old('orderDateTime', date('Y-m-d\TH:i', strtotime($order->orderDateTime))) }}" required>
    </div>
    <div>
        <label>Delivery Address:</label>
        <input type="text" name="deliveryAddress" value="{{ old('deliveryAddress', $order->deliveryAddress) }}" required>
    </div>
    <div>
        <label>Notes:</label>
        <textarea name="notes">{{ old('notes', $order->notes) }}</textarea>
    </div>
    <div>
        <label>Status:</label>
        <select name="statusID" required>
            @foreach($statuses as $status)
            <option value="{{ $status->statusID }}" {{ $order->statusID == $status->statusID ? 'selected' : '' }}>
                {{ $status->statusName }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Update Order</button>
</form>
@endsection