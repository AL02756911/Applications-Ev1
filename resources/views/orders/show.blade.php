@extends('layouts.app')
@section('content')
<h2>Order #{{ $order->invoiceNumber }}</h2>
<dl class="row">
    <dt class="col-sm-3">Customer</dt>
    <dd class="col-sm-9">{{ optional($order->customer)->name }}</dd>
    <dt class="col-sm-3">Date</dt>
    <dd class="col-sm-9">{{ $order->orderDateTime }}</dd>
    <dt class="col-sm-3">Status</dt>
    <dd class="col-sm-9">{{ $order->status->statusName }}</dd>
    <dt class="col-sm-3">Address</dt>
    <dd class="col-sm-9">{{ $order->deliveryAddress }}</dd>
    <dt class="col-sm-3">Notes</dt>
    <dd class="col-sm-9">{{ $order->notes }}</dd>
</dl>

@if(in_array($order->status->statusName, ['In Route','Delivered']))
<form action="{{ route('orders.uploadPhoto', $order) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Upload Evidence Photo</label>
        <input type="file" name="photo" class="form-control" required>
    </div>
    <button class="btn btn-warning">Upload</button>
</form>
@if($order->loadedPhoto && $order->status->statusName == 'In Route')
<img src="{{ asset('storage/'.$order->loadedPhoto) }}"
    class="img-thumbnail mt-3" alt="Loaded Photo">
@endif
@if($order->deliveredPhoto && $order->status->statusName == 'Delivered')
<img src="{{ asset('storage/'.$order->deliveredPhoto) }}"
    class="img-thumbnail mt-3" alt="Delivered Photo">
@endif
@endif

<a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection