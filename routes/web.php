<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Editor\EditorNewsController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Editor\EditorDashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class,'index'])->name('home');
Route::get('/ajax-paginate',[IndexController::class,'ajax_paginate'])->name('ajax.paginate');

Route::get('/news', [NewsController::class,'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class,'show'])->name('news.show');

 // pages for if users arenot authenticated
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class,'show_login'])->name('auth.login');
    Route::post('/login', [AuthController::class,'authenticate'])->name('login.post');

    Route::get('/register', [AuthController::class,'show_register'])->name('auth.register');
    Route::post('/register', [AuthController::class,'register'])->name('register.post');

    // Admin login routes
    Route::get('/auth/login',[AdminAuthController::class, 'index'])->name('auth.index');
    Route::post('/auth/login',[AdminAuthController::class, 'store'])->name('auth.store');
});

Route::middleware('auth','back')->group(function () {

    //   User routes
    Route::middleware('user')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/profile', [ProfileController::class,'index'])->name('profile.index');
        Route::get('/profile/add-news', [ProfileController::class,'add_news'])->name('profile.add_news');
        Route::post('/profile/add-news', [ProfileController::class,'store_news'])->name('profile.store_news');
        Route::get('/profile/my-news', [ProfileController::class,'my_news'])->name('profile.my_news');
        Route::get('/profile/change-password', [ProfileController::class,'show_change_password'])->name('profile.show_change_password');
        Route::post('/profile/change-password', [ProfileController::class,'change_password'])->name('profile.change_password');

    });

        //  Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::post('admin/logout', [AdminDashboardController::class, 'logout'])->name('admin.auth.logout');
        Route::resource('/admin/users', UserController::class);
        Route::resource('/admin/editors', EditorController::class);
        Route::resource('/admin/admins', AdminController::class);
        Route::resource('/admin/news', AdminNewsController::class);
    });


          //  Editor routes
    Route::middleware('editor')->group(function () {
        Route::get('/editor/dashboard',[EditorDashboardController::class,'index'])->name('editor.dashboard');
        Route::post('editor/logout', [EditorDashboardController::class, 'logout'])->name('editor.auth.logout');
        Route::resource('/editor/news', EditorNewsController::class);
    });

});






