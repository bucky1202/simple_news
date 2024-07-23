<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }
    //
    public function show_login()
    {
        return view('user.auth.login');
    }


    public function authenticate(Request $request)
    {
        request()->validate([
            'username' => 'required|exists:users,username|min:3',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($request->only('username', 'password')) && Auth::user()->role_id === 3)
        {
            $request->session()->regenerate();

            $request->session()->put('user', Auth::user());

            return redirect()->route('home');
        }
        Auth::logout();
        return redirect()->back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


    public function show_register()
    {
        return view('user.auth.register');
    }


    public function register(Request $request)
    {
        $validated = request()->validate([
            'username' => 'required|string|min:3|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role_id' => 3,
        ]);

        $request->session()->put('user', $user);
        // You can optionally log in the user after registration
        // Auth::login($user);

        return redirect()->route('auth.login')->with('success', 'Registration successful! Please login.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }



}
