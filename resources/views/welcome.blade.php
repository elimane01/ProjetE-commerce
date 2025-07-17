@extends('layouts.app')

@section('title', 'Accueil - E-Commerce')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center py-5">
                    <h1 class="display-4 mb-3">
                        <i class="fas fa-shopping-cart me-3"></i>
                        Bienvenue sur E-Commerce
                    </h1>
                    <p class="lead mb-4">Découvrez notre sélection de produits exceptionnels</p>
                    <a href="#" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-shopping-bag me-2"></i>Voir nos produits
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg me-2">
                        <i class="fas fa-user-plus me-2"></i>S'inscrire
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg me-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-sign-out-alt me-2"></i>Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Catégories populaires -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">
                <i class="fas fa-tags me-2"></i>Catégories populaires
            </h2>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-mobile-alt fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Électronique</h5>
                    <p class="card-text">Smartphones, tablettes et accessoires</p>
                    <a href="#" class="btn btn-outline-primary">Explorer</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-tshirt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Mode</h5>
                    <p class="card-text">Vêtements et accessoires de mode</p>
                    <a href="#" class="btn btn-outline-success">Explorer</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-home fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Maison</h5>
                    <p class="card-text">Décoration et ameublement</p>
                    <a href="#" class="btn btn-outline-warning">Explorer</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Livres</h5>
                    <p class="card-text">Romans, guides et littérature</p>
                    <a href="#" class="btn btn-outline-info">Explorer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Produits en vedette -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">
                <i class="fas fa-star me-2"></i>Produits en vedette
            </h2>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top bg-light text-center py-4">
                    <i class="fas fa-image fa-4x text-muted"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produit 1</h5>
                    <p class="card-text">Description courte du produit</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">29,99 €</span>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-cart-plus me-1"></i>Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top bg-light text-center py-4">
                    <i class="fas fa-image fa-4x text-muted"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produit 2</h5>
                    <p class="card-text">Description courte du produit</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">49,99 €</span>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-cart-plus me-1"></i>Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top bg-light text-center py-4">
                    <i class="fas fa-image fa-4x text-muted"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produit 3</h5>
                    <p class="card-text">Description courte du produit</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">79,99 €</span>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-cart-plus me-1"></i>Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top bg-light text-center py-4">
                    <i class="fas fa-image fa-4x text-muted"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produit 4</h5>
                    <p class="card-text">Description courte du produit</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">99,99 €</span>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-cart-plus me-1"></i>Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Avantages -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">
                <i class="fas fa-thumbs-up me-2"></i>Pourquoi nous choisir ?
            </h2>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
                    <h5>Livraison rapide</h5>
                    <p>Livraison gratuite à partir de 50€</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                    <h5>Paiement sécurisé</h5>
                    <p>Transactions 100% sécurisées</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-headset fa-3x text-info mb-3"></i>
                    <h5>Service client</h5>
                    <p>Support 24/7 disponible</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 