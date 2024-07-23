<?php

namespace App\Http\Controllers\User;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('user.profile.index',[
            'my_news' => News::where('author', auth()->user()->username)->get(),
        ]);
    }


    public function show_change_password()
    {
        return view('user.profile.change-password');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }


    public function my_news()
    {
        return view('user.profile.index',[
            'my_news' => News::where('author', auth()->user()->username)->get(),
        ]);
    }


    public function add_news()
    {
        return view('user.profile.add-news');
    }


    public function store_news(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4096', // 2MB max size
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        } else {
            $imagePath = null;
        }

        // Save news item to database
        $user = auth()->user();
        $news = new News([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'author' => $user->username,
        ]);
        $news->save();

        return redirect()->route('profile.add_news')->with('success', 'News added successfully.');
    }
}
