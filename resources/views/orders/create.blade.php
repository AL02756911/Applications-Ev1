@extends('layouts.app')
@section('content')
<h2>Create Order</h2>
<form action="{{ route('orders.store') }}" method="POST" class="row g-3">
    @csrf
    <div class="col-md-3">
        <label class="form-label">Invoice #</label>
        <input type="text" name="invoiceNumber" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Customer</label>
        <select name="customerNumber" class="form-select" required>
            <option value="">Select customer</option>
            @foreach($customers as $cust)
            <option value="{{ $cust->customerNumber }}">
                {{ $cust->name }} ({{ $cust->customerNumber }})
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Order Date</label>
        <input type="datetime-local" name="orderDateTime" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="statusID" class="form-select" required>
            @foreach($statuses as $st)
            <option value="{{ $st->statusID }}">{{ $st->statusName }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Delivery Address</label>
        <input type="text" name="deliveryAddress" class="form-control" required>
    </div>
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-success">Save Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection