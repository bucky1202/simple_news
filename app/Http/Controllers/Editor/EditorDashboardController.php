<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditorDashboardController extends Controller
{
    //
    public function index()
    {
        return view('editor.dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
