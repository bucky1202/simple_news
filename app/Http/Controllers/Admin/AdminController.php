<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index()
    {

        return view('admin.admins.index', [
            'admins' =>User::with('role')
                    ->where('role_id', 1)
                    ->latest()
                    ->get(),
        ]);
    }

    public function create()
    {
        return view('admin.admins.create');
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
            'role_id' => 1,
        ]);

        return redirect()->back()
                         ->with('success', 'Admin created successfully.');
    }

    public function edit(User $admin)
    {
        return view('admin.admins.edit', [
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'username' => 'required',
                            'string',
                            'min:3',
                            'max:255',
                            Rule::unique('users')->ignore($admin->id),
            'password' => 'nullable|string|min:8',
        ]);

        $admin->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->back()
                         ->with('success', 'Admin updated successfully.');
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->back()
                         ->with('success', 'Admin deleted successfully.');
    }
}
