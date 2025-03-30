@extends('layouts.app')

@section('content')
<h1>User List</h1>
<a href="{{ route('users.create') }}">Create New User</a>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role ? $user->role->roleName : 'N/A' }}</td>
            <td>{{ isset($user->active) && $user->active ? 'Active' : 'Inactive' }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to deactivate this user?')">Deactivate</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection