<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    // List all users (active and inactive)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id'  => 'required|exists:roles,roleID'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->roleID   = $request->role_id;
        $user->save();

        toastr()->success('User created successfully.');

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing an existing user
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Update an existing user's information
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id'  => 'required|exists:roles,roleID',
        ]);

        $user->username = $request->username;
        $user->email    = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->roleID = $request->role_id;
        $user->save();

        toastr()->success('User updated successfully.');

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Mark a user as inactive (logical deletion)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Assuming you have an 'active' column to mark user status
        $user->active = false;
        $user->save();

        toastr()->success('User deactivated successfully.');

        return redirect()->route('users.index')->with('success', 'User deactivated successfully.');
    }
}
