@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4 shadow">
                <div class="row g-0">
                    <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
                        <img src="{{ $product->image ? (Str::startsWith($product->image, 'http') ? $product->image : asset('storage/'.$product->image)) : 'https://via.placeholder.com/500x500?text=Image+Produit' }}" class="img-fluid rounded w-100" style="max-height:400px;object-fit:contain;" alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h2 class="card-title mb-2">{{ $product->name }}</h2>
                            <h5 class="text-muted mb-3">Catégorie : {{ $product->category->name ?? 'Non classé' }}</h5>
                            <h4 class="text-primary mb-3">{{ number_format($product->price, 2, ',', ' ') }} €</h4>
                            <p class="card-text mb-4" style="font-size:1.1em;">{{ $product->description }}</p>
                            @if($product->description_longue)
                                <hr>
                                <h5 class="mt-4">Description détaillée & caractéristiques</h5>
                                {{-- Si la description longue contient des prix, on ajoute FCFA automatiquement --}}
                                <div class="mb-3">
                                    {!! preg_replace('/(\d{1,3}(?:[\s.,]\d{3})*(?:[.,]\d+)?)(\s*€|\s*euros?)/i', '$1 FCFA', nl2br(e($product->description_longue))) !!}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mb-3">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantité</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control w-25" value="1" min="1">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                                </button>
                            </form>
                            @if(session('success'))
                                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                            @endif
                            <a href="{{ route('products.index') }}" class="btn btn-link mt-3">&larr; Retour au catalogue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 