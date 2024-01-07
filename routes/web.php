<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});


//Error handler url
Route::fallback(function () {
    return view('errors.404');
});

//Admin login
Route::match(['get', 'post'], '/admin/login', [AdminController::class, 'login'])->name('admin.login');


//Admin Dashboard 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::match(['get', 'post'], '/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
