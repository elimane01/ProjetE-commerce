@extends('layouts.app')

@section('title', 'Paiement')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    <i class="fas fa-credit-card me-2"></i>
                    Paiement sécurisé
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Mode simulation :</strong> Ceci est un paiement simulé. Toutes les cartes sont acceptées.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Récapitulatif de la commande</h5>
                        <p><strong>Total à payer :</strong> {{ number_format($pendingOrder['total'], 0, ',', ' ') }} FCFA</p>
                        <p><strong>Adresse de livraison :</strong> {{ $pendingOrder['adresse_livraison'] }}</p>
                        <p><strong>Email :</strong> {{ $pendingOrder['email'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('orders.processPayment') }}">
                            @csrf
                            <h5>Informations de paiement</h5>
                            
                            <div class="mb-3">
                                <label for="card_holder" class="form-label">Nom du titulaire</label>
                                <input type="text" class="form-control" id="card_holder" name="card_holder" value="{{ old('card_holder') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="card_number" class="form-label">Numéro de carte</label>
                                <input type="text" class="form-control" id="card_number" name="card_number" value="{{ old('card_number') }}" maxlength="16" placeholder="1234567890123456" required>
                                <small class="form-text text-muted">Exemple : 1234567890123456</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="card_expiry" class="form-label">Date d'expiration</label>
                                        <input type="text" class="form-control" id="card_expiry" name="card_expiry" value="{{ old('card_expiry') }}" placeholder="MM/YY" maxlength="5" required>
                                        <small class="form-text text-muted">Format : MM/YY</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="card_cvv" class="form-label">Code de sécurité</label>
                                        <input type="text" class="form-control" id="card_cvv" name="card_cvv" value="{{ old('card_cvv') }}" maxlength="3" placeholder="123" required>
                                        <small class="form-text text-muted">3 chiffres au dos de la carte</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-lock me-2"></i>
                                    Payer {{ number_format($pendingOrder['total'], 0, ',', ' ') }} FCFA
                                </button>
                                <a href="{{ route('orders.create') }}" class="btn btn-secondary">Retour</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Formatage automatique de la date d'expiration
document.getElementById('card_expiry').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
});

// Formatage du numéro de carte
document.getElementById('card_number').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '');
});
</script>
@endsection 