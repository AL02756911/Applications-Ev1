@extends('layouts.app')
@section('content')
<h2>Edit User</h2>
<form action="{{ route('users.update', $user) }}" method="POST" class="row g-3">
    @csrf @method('PUT')
    <div class="col-md-4">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control"
            value="{{ $user->username }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
            value="{{ $user->email }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Password <small>(leave blank to keep)</small></label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Role</label>
        <select name="role_id" class="form-select" required>
            @foreach($roles as $role)
            <option value="{{ $role->roleID }}"
                {{ $user->roleID == $role->roleID ? 'selected' : '' }}>
                {{ $role->roleName }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection