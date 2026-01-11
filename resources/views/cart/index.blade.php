@extends('layouts.app')

@section('title', 'Mon panier')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Mon panier</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(empty($cart))
        <div class="alert alert-info">Votre panier est vide.</div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Voir le catalogue</a>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $item['image'] ? (Str::startsWith($item['image'], 'http') ? $item['image'] : asset('storage/'.$item['image'])) : 'https://via.placeholder.com/100x100?text=Image' }}" alt="{{ $item['name'] }}" style="width:60px;height:60px;object-fit:cover;" class="me-2 rounded">
                                    <span>{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td>{{ number_format($item['price'], 0, ',', ' ') }} FCFA</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="d-flex align-items-center">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control w-50 me-2">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Mettre à jour</button>
                                </form>
                            </td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total :</th>
                        <th>{{ number_format($total, 0, ',', ' ') }} FCFA</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Continuer mes achats</a>
        @if(count($cart) > 0 && Auth::check())
            <div class="text-end mt-3">
                <a href="{{ route('orders.create') }}" class="btn btn-success">Passer commande</a>
            </div>
        @endif
    @endif
</div>
@endsection 