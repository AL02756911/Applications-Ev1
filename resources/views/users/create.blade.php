@extends('layouts.app')
@section('content')
<h2>Create User</h2>
<form action="{{ route('users.store') }}" method="POST" class="row g-3">
    @csrf
    <div class="col-md-4">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Role</label>
        <select name="role_id" class="form-select" required>
            <option value="">Select role</option>
            @foreach($roles as $role)
            <option value="{{ $role->roleID }}">{{ $role->roleName }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-success">Create</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection