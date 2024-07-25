<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('user.index',[
            'news' => News::latest()->paginate(4),
        ]);
    }

    public function ajax_paginate(Request $request){
        return view('user.layouts.ajax-pagination',[
            'news' => News::latest()->paginate(4),
        ])->render();
    }
}
