<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
    $topUsers = News::select(DB::raw('COUNT(*) as news_count, author'))
                        ->groupBy('author')
                        ->orderByDesc('news_count')
                        ->limit(5)
                        ->get();

        $newsByMonth = News::select(DB::raw('COUNT(*) as news_count'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();


        $months = $newsByMonth->pluck('month');
        $newsCounts = $newsByMonth->pluck('news_count');

        return view('admin.dashboard', compact('topUsers', 'months', 'newsCounts'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
