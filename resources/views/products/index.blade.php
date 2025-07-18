@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Catalogue produits')

@section('content')
<div class="alert alert-primary text-center mb-4">
    <h2 class="mb-0">Bienvenue sur notre boutique en ligne !</h2>
    <p class="mb-0">Découvrez nos produits, filtrez par catégorie ou recherchez par mot-clé.</p>
</div>
<div class="container">
    <h1 class="mb-4">Catalogue de produits</h1>
    <form method="GET" action="{{ route('products.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Recherche par mot-clé..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-2"></i>Filtrer
            </button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height:200px;object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=Image+Produit" class="card-img-top" alt="Image par défaut">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text small text-muted mb-1">Catégorie : {{ $product->category->name ?? 'Aucune' }}</p>
                        <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                        <div class="mt-auto">
                            <span class="fw-bold fs-5">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} ms-2">
                                {{ $product->stock > 0 ? 'En stock' : 'Rupture' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Aucun produit trouvé.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection 