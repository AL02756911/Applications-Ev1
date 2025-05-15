@extends('layouts.app')
@section('content')
<h2>Edit Order</h2>
<form action="{{ route('orders.update', $order) }}" method="POST" class="row g-3">
    @csrf @method('PUT')
    <div class="col-md-3">
        <label class="form-label">Invoice #</label>
        <input type="text" name="invoiceNumber" class="form-control"
            value="{{ $order->invoiceNumber }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Customer</label>
        <select name="customerNumber" class="form-select" required>
            @foreach($customers as $cust)
            <option value="{{ $cust->customerNumber }}"
                {{ $cust->customerNumber == $order->customerNumber ? 'selected' : '' }}>
                {{ $cust->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Order Date</label>
        <input type="datetime-local" name="orderDateTime" class="form-control"
            value="{{ \Carbon\Carbon::parse($order->orderDateTime)->format('Y-m-d\TH:i') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="statusID" class="form-select" required>
            @foreach($statuses as $st)
            <option value="{{ $st->statusID }}"
                {{ $st->statusID == $order->statusID ? 'selected' : '' }}>
                {{ $st->statusName }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Delivery Address</label>
        <input type="text" name="deliveryAddress" class="form-control"
            value="{{ $order->deliveryAddress }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control">{{ $order->notes }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection