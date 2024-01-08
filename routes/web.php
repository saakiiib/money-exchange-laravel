<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\FrontEnd\HomeController;


//Error Handler Uri
Route::fallback(function () {
    return view('errors.404');
});

//Admin Login
Route::match(['get', 'post'], '/admin/login', [AdminController::class, 'login'])->name('admin.login');

//Admin After Authorization
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::match(['get', 'post'], '/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/exchange-rates', [ExchangeRateController::class, 'showExchangeRates'])->name('admin.exchangeRates');

    //Without Loading Add User Data And Table's Functions Using VUE-js
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

    //With Loading Table
    Route::get('/admin/user-list', [UserController::class, 'list'])->name('admin.users.list');

    // Admin's Permission Over User 
    Route::get('/admin/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/users/{user}/confirm-delete', [UserController::class, 'confirmDelete'])->name('admin.users.confirm-delete');
    Route::delete('/admin/users/{user}', [UserController::class, 'delete'])->name('admin.users.delete');
});

// Open For All
Route::get('/', [HomeController::class, 'home'])->name('frontend.home');
Route::get('/exchange-form', [ExchangeRateController::class, 'showExchangeRates'])->name('exchange.form');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//User Permission After Authorization
Route::group(['middleware' => 'user'], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit-profile.edit');
    Route::put('/edit-profile', [AuthController::class, 'updateProfile'])->name('edit-profile.update');
});