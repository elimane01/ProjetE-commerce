<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');

// Authentification client
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::put('/profile/password', [AuthController::class, 'changePassword'])->name('profile.password')->middleware('auth');

Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
