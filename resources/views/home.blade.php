@extends('layouts.app')

@section('content')
<h2 class="mb-4">Track Your Order</h2>
<form action="{{ route('order.search') }}" method="POST" class="row g-3">
    @csrf
    <div class="col-md-5">
        <input type="text" name="invoiceNumber" class="form-control" placeholder="Invoice #" required>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary">Search</button>
    </div>
</form>

@if(isset($order))
<div class="card mt-4">
    <div class="card-body">
        <h5>Status: <span class="badge bg-info">{{ $order->status->statusName }}</span></h5>
        @if($order->status->statusName === 'Delivered')
        <img src="{{ asset('storage/'.$order->deliveredPhoto) }}" class="img-fluid mt-3" alt="Delivered">
        @elseif($order->status->statusName === 'In Process')
        <p class="mt-2">Processing since: {{ $order->orderDateTime }}</p>
        @endif
    </div>
</div>
@endif
@endsection