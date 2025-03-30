@extends('layouts.app')

@section('content')
<h1>Create Order</h1>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div>
        <label>Invoice Number:</label>
        <input type="text" name="invoiceNumber" value="{{ old('invoiceNumber') }}" required>
    </div>
    <div>
        <label>Customer Number:</label>
        <select name="customerNumber" required>
            <option value="">Select Customer</option>
            @foreach($customers as $customer)
            <option value="{{ $customer->customerNumber }}">{{ $customer->name }} ({{ $customer->customerNumber }})</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Order Date & Time:</label>
        <input type="datetime-local" name="orderDateTime" value="{{ old('orderDateTime') }}" required>
    </div>
    <div>
        <label>Delivery Address:</label>
        <input type="text" name="deliveryAddress" value="{{ old('deliveryAddress') }}" required>
    </div>
    <div>
        <label>Notes:</label>
        <textarea name="notes">{{ old('notes') }}</textarea>
    </div>
    <div>
        <label>Status:</label>
        <select name="statusID" required>
            @foreach($statuses as $status)
            <option value="{{ $status->statusID }}">{{ $status->statusName }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Create Order</button>
</form>
@endsection