@extends('layouts.app')
@section('content')
<h2>User Management</h2>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ New User</a>
<table class="table table-striped">
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
            <td>{{ optional($user->role)->roleName }}</td>
            <td>
                @if($user->active ?? true)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-secondary">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Deactivate this user?')">Deactivate</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection