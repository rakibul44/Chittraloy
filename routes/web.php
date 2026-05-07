<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/gallery', [GalleryController::class, 'index']);

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Admin (auth protected)
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');
