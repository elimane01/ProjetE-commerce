@extends('layouts.app')

@section('title', 'Confirmation de commande')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">
                    <i class="fas fa-check-circle me-2"></i>
                    Commande confirmée !
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <strong>Merci pour votre commande !</strong><br>
                    Votre commande a été enregistrée avec succès. Vous recevrez bientôt un email de confirmation.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Informations de la commande</h5>
                        <p><strong>Numéro de commande :</strong> #{{ $order->id }}</p>
                        <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Statut :</strong> 
                            <span class="badge bg-warning">{{ ucfirst(str_replace('_', ' ', $order->statut)) }}</span>
                        </p>
                        <p><strong>Mode de paiement :</strong> 
                            @if($order->mode_paiement == 'en_ligne')
                                Paiement avant livraison (en ligne)
                            @else
                                Paiement à la livraison (espèces)
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5>Adresse de livraison</h5>
                        <p>{{ $order->adresse_livraison }}</p>
                        <p><strong>Téléphone :</strong> {{ $order->telephone }}</p>
                        <p><strong>Email :</strong> {{ $order->email }}</p>
                    </div>
                </div>

                <hr>

                <h5>Articles commandés</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->nom }}</td>
                                    <td>{{ $item->quantite }}</td>
                                    <td>{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                    <td>{{ number_format($item->prix_unitaire * $item->quantite, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td><strong>{{ number_format($order->total, 0, ',', ' ') }} FCFA</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 