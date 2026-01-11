<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', [ProductController::class, 'index'])->name('home');

// Authentification client
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change');
});

// Catalogue produit
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{id}', [ProductController::class, 'show'])->name('products.show');

// Panier
Route::get('/panier', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/panier/modifier/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/panier/supprimer/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Passage de commande
Route::middleware('auth')->group(function () {
    Route::get('/mes-commandes', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/commande/paiement', [OrderController::class, 'payment'])->name('orders.payment');
    Route::post('/commande/paiement', [OrderController::class, 'processPayment'])->name('orders.processPayment');
    Route::get('/commande/confirmation/{id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/commande/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/commande/{id}/statut', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/commande/{id}/facture', [OrderController::class, 'downloadInvoice'])->name('orders.invoice');
    Route::get('/commande', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/commande', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/test-paiement-auth', function() { dd('test route auth ok'); });
});

Route::get('/test-paiement', function() { dd('test route ok'); });
