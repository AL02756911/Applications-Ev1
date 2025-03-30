@extends('layouts.app')

@section('content')
<h1>Edit User</h1>
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Username:</label>
        <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>
    <div>
        <label>Password: (leave blank if not changing)</label>
        <input type="password" name="password">
    </div>
    <div>
        <label>Role:</label>
        <select name="role_id" required>
            @foreach($roles as $role)
            <option value="{{ $role->roleID }}" {{ $user->roleID == $role->roleID ? 'selected' : '' }}>
                {{ $role->roleName }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Update User</button>
</form>
@endsection