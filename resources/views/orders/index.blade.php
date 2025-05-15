@extends('layouts.app')
@section('content')
<h2>Order List</h2>
<a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">+ New Order</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Invoice #</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->orderID }}</td>
            <td>{{ $order->invoiceNumber }}</td>
            <td>{{ optional($order->customer)->name }}</td>
            <td>{{ $order->orderDateTime }}</td>
            <td><span class="badge bg-info">{{ $order->status->statusName }}</span></td>
            <td>
                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View</a>
                <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Delete this order?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection