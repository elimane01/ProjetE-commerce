<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Routes admin protégées
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Routes pour les produits
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    
    // Routes pour les catégories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::get('categories/{category}/products', [App\Http\Controllers\Admin\CategoryController::class, 'showProducts'])->name('categories.products');
    
    // Ajoute ici les autres routes d'administration
});
