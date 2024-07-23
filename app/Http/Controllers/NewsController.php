<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //

    public function index()
    {
        return view('user.news.index');
    }


    public function show($slug)
    {
        return view('user.news.show', [
            'news_item' => News::where('slug', $slug)->firstOrFail(),
        ]);
    }
}
