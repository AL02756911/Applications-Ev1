@extends('layouts.app')

@section('content')
<h2>Dashboard</h2>
<div class="row">
    <div class="col-md-6 mb-3">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100">Manage Users</a>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary w-100">Manage Orders</a>
    </div>
</div>
@endsection