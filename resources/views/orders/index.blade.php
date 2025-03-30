@extends('layouts.app')

@section('content')
<h1>Order List</h1>
<a href="{{ route('orders.create') }}">Create New Order</a>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Invoice Number</th>
            <th>Customer</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->orderID }}</td>
            <td>{{ $order->invoiceNumber }}</td>
            <td>{{ $order->customer ? $order->customer->name : 'N/A' }}</td>
            <td>{{ $order->orderDateTime }}</td>
            <td>{{ $order->status->statusName }}</td>
            <td>
                <a href="{{ route('orders.show', $order->orderID) }}">View</a>
                <a href="{{ route('orders.edit', $order->orderID) }}">Edit</a>
                <form action="{{ route('orders.destroy', $order->orderID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this order?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection