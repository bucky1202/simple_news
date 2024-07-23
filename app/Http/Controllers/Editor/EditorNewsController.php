<?php

namespace App\Http\Controllers\Editor;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EditorNewsController extends Controller
{
    //
    public function index()
    {

        return view('editor.news.index', [
            'news' =>News::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('editor.news.create');
    }

    public function store(Request $request)
    {
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
        News::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'author' => auth()->user()->username,
        ]);

        return redirect()->back()->with('success', 'News added successfully.');
    }

    public function edit(News $news)
    {
        return view('editor.news.edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4096', // 2MB max size
        ]);

        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($news->image) {
                Storage::delete('public/storage/news_images/' . $news->image);
            }
            // Upload new image
            $imagePath = $request->file('image')->store('news_images', 'public');
            $news->image = $imagePath;
        }
        $news->title = $validated['title'];
        $news->description = $validated['description'];
        $news->save();

        return redirect()->back()
                         ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
         // Delete news image if exists
         if ($news->image) {
            Storage::delete('public/storage/news_images/' . $news->image);
        }

        $news->delete();

        return redirect()->back()
                         ->with('success', 'News deleted successfully.');
    }
}
