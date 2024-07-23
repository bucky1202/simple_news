<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {

        return view('admin.users.index', [
            'users' =>User::with('role')
                    ->where('role_id', 3)
                    ->latest()
                    ->get(),
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 3,
        ]);

        return redirect()->back()
                         ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
                            'string',
                            'min:3',
                            'max:255',
                            Rule::unique('users')->ignore($user->id),
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->back()
                         ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()
                         ->with('success', 'User deleted successfully.');
    }
}
