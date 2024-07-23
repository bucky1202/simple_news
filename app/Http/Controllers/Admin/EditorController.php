<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    //
    public function index()
    {

        return view('admin.editors.index', [
            'editors' =>User::with('role')
                    ->where('role_id', 2)
                    ->latest()
                    ->get(),
        ]);
    }

    public function create()
    {
        return view('admin.editors.create');
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
            'role_id' => 2,
        ]);

        return redirect()->back()
                         ->with('success', 'Editor created successfully.');
    }

    public function edit(User $editor)
    {
        return view('admin.editors.edit', [
            'editor' => $editor,
        ]);
    }

    public function update(Request $request, User $editor)
    {
        $request->validate([
            'username' => 'required',
                            'string',
                            'min:3',
                            'max:255',
                            Rule::unique('users')->ignore($editor->id),
            'password' => 'nullable|string|min:8',
        ]);

        $editor->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $editor->password,
        ]);

        return redirect()->back()
                         ->with('success', 'Editor updated successfully.');
    }

    public function destroy(User $editor)
    {
        $editor->delete();

        return redirect()->back()
                         ->with('success', 'Editor deleted successfully.');
    }
}
