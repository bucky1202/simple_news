<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('admin.login');
    }


    public function store(Request $request)
    {
        request()->validate([
            'username' => 'required|exists:users,username|min:3',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($request->only('username', 'password')) )
        {
            if(Auth::user()->role_id === 1){
                return redirect()->route('admin.dashboard');
            }
            elseif(Auth::user()->role_id === 2){
                return redirect()->route('editor.dashboard');
            }

        Auth::logout();
        return redirect()->back()->withErrors([
             'username' => 'The provided credentials do not match our records.',
         ]);
    }
}
}
