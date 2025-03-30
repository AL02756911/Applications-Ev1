@extends('layouts.app')

@section('content')
<h1>Archived Orders</h1>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Invoice Number</th>
            <th>Customer</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Restore</th>
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
                <form action="{{ route('orders.restore', $order->orderID) }}" method="POST">
                    @csrf
                    <button type="submit">Restore</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection