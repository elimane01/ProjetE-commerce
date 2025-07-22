@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            Commande réussie !
        </div>
    @endif
    <h2>Mes commandes</h2>
    
    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Mode de paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                            <td>
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
                            </td>
                            <td>
                                @if($order->mode_paiement == 'en_ligne')
                                    Paiement en ligne
                                @else
                                    Paiement à la livraison
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                    <i class="fas fa-download"></i> Facture
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Vous n'avez pas encore passé de commande.
            <a href="{{ route('home') }}" class="alert-link">Découvrir nos produits</a>
        </div>
    @endif
</div>
@endsection 