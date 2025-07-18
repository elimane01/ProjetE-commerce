@extends('layouts.app')

@section('title', 'Accueil - E-Commerce')

@section('content')
<div class="container">
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
                </div>
            </div>
        </div>
    </div>
    <!-- Ici tu peux ajouter des sections produits, catégories, etc. -->
</div>
@endsection
