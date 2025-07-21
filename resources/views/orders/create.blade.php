@extends('layouts.app')

@section('title', 'Passer commande')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Passer ma commande</h2>
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="mb-3">
                <label for="adresse_livraison" class="form-label">Adresse de livraison</label>
                <input type="text" class="form-control" id="adresse_livraison" name="adresse_livraison" value="{{ old('adresse_livraison') }}" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mode de paiement</label>
                <select class="form-select" name="mode_paiement" required>
                    <option value="en_ligne" {{ old('mode_paiement') == 'en_ligne' ? 'selected' : '' }}>Paiement avant livraison (en ligne)</option>
                    <option value="a_la_livraison" {{ old('mode_paiement') == 'a_la_livraison' ? 'selected' : '' }}>Paiement à la livraison (espèces)</option>
                </select>
            </div>
            <h5>Récapitulatif du panier</h5>
            <ul class="list-group mb-3">
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item['name'] }} x {{ $item['quantity'] }}
                        <span>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €</span>
                    </li>
                    @php $total += $item['price'] * $item['quantity']; @endphp
                @endforeach
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                    Total
                    <span>{{ number_format($total, 2, ',', ' ') }} €</span>
                </li>
            </ul>
            <button type="submit" class="btn btn-success">Valider la commande</button>
        </form>
    </div>
</div>
@endsection 