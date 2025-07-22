@component('mail::message')
# Merci pour votre commande !

Bonjour {{ $order->email }},

Votre commande **#{{ $order->id }}** a bien été enregistrée sur E-Commerce.

**Détails de la commande :**
- Date : {{ $order->created_at->format('d/m/Y H:i') }}
- Statut : @if($order->statut == 'en_attente')En attente@elseif($order->statut == 'validee')Validée@elseif($order->statut == 'expediee')Expédiée@elseif($order->statut == 'livree')Livrée@elseif($order->statut == 'annulee')Annulée@endif
- Total : {{ number_format($order->total, 0, ',', ' ') }} FCFA

@component('mail::table')
| Produit | Quantité | Prix unitaire | Total |
|---------|----------|---------------|-------|
@foreach($order->orderItems as $item)
| {{ $item->product->nom }} | {{ $item->quantite }} | {{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA | {{ number_format($item->prix_unitaire * $item->quantite, 0, ',', ' ') }} FCFA |
@endforeach
@endcomponent

**Adresse de livraison :**
{{ $order->adresse_livraison }}

**Téléphone :** {{ $order->telephone }}

Vous recevrez un nouvel email lors de l'expédition ou de la livraison de votre commande.

Merci pour votre confiance !

@endcomponent
