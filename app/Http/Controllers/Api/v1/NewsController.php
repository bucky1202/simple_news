<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function index()
    {
        return response()->json(News::all());
    }

    public function show($id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }
        return response()->json($news);
    }
}
