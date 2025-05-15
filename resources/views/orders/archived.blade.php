@extends('layouts.app')
@section('content')
<h2>Archived Orders</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Status</th>
            <th>Restore</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->invoiceNumber }}</td>
            <td>{{ optional($order->customer)->name }}</td>
            <td>{{ $order->orderDateTime }}</td>
            <td>{{ $order->status->statusName }}</td>
            <td>
                <form action="{{ route('orders.restore', $order) }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-success">Restore</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection