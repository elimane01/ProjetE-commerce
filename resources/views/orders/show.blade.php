@extends('layouts.app')

@section('title', 'Détail de la commande')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Commande #{{ $order->id }}</h2>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour aux commandes
                </a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Informations de la commande</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Statut :</strong> 
                                @if($order->statut == 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($order->statut == 'validee')
                                    <span class="badge bg-success">Validée</span>
                                @elseif($order->statut == 'expediee')
                                    <span class="badge bg-info">Expédiée</span>
                                @elseif($order->statut == 'livree')
                                    <span class="badge bg-primary">Livrée</span>
                                @elseif($order->statut == 'annulee')
                                    <span class="badge bg-danger">Annulée</span>
                                @endif
                            </p>
                            <p><strong>Mode de paiement :</strong> 
                                @if($order->mode_paiement == 'en_ligne')
                                    Paiement en ligne
                                @else
                                    Paiement à la livraison
                                @endif
                            </p>
                            <p><strong>Total :</strong> {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Adresse de livraison</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $order->adresse_livraison }}</p>
                            <p><strong>Téléphone :</strong> {{ $order->telephone }}</p>
                            <p><strong>Email :</strong> {{ $order->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Articles commandés</h5>
                </div>
                <div class="card-body">
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
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-download"></i> Télécharger la facture
                </a>
            </div>
            <div class="text-center mt-4">
                <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}" class="d-inline-block">
                    @csrf
                    <label for="statut" class="form-label">Changer le statut :</label>
                    <select name="statut" id="statut" class="form-select d-inline w-auto mx-2">
                        <option value="en_attente" @if($order->statut=='en_attente') selected @endif>En attente</option>
                        <option value="validee" @if($order->statut=='validee') selected @endif>Validée</option>
                        <option value="expediee" @if($order->statut=='expediee') selected @endif>Expédiée</option>
                        <option value="livree" @if($order->statut=='livree') selected @endif>Livrée</option>
                        <option value="annulee" @if($order->statut=='annulee') selected @endif>Annulée</option>
                    </select>
                    <button type="submit" class="btn btn-warning">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 