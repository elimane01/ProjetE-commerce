<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route de test (à supprimer après)
Route::get('/test', function () {
    return view('test');
})->name('test');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Routes protégées (nécessitent une connexion)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'changePassword'])->name('profile.password');
});
