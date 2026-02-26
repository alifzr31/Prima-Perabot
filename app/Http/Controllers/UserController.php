<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('admin.pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = ['superadmin', 'admin', 'customer'];

        return view('admin.pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|digits_between:10,14|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:superadmin,admin,customer',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('dashboard.user')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = ['superadmin', 'admin', 'customer'];

        return view('admin.pages.user.edit', compact('user', 'roles'));
    }

    public function update(User $user, Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|digits_between:10,14|unique:users,phone,' . $user->id,
            'role' => 'required|in:superadmin,admin,customer',
        ]);

        $user->update($validated);

        return redirect()->route('dashboard.user')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.user')->with('success', 'Pengguna berhasil dihapus.');
    }
}
