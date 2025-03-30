@extends('layouts.app')

@section('content')
<h1>Create User</h1>
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div>
        <label>Username:</label>
        <input type="text" name="username" value="{{ old('username') }}" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Role:</label>
        <select name="role_id" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
            <option value="{{ $role->roleID }}">{{ $role->roleName }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Create User</button>
</form>
@endsection