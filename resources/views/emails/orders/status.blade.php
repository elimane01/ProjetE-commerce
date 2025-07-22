@component('mail::message')
# Mise à jour de votre commande

Bonjour {{ $order->email }},

Le statut de votre commande **#{{ $order->id }}** a été mis à jour.

**Nouveau statut :**
@switch($statut)
    @case('expediee')
        📦 Expédiée
        @break
    @case('livree')
        ✅ Livrée
        @break
    @case('validee')
        🟢 Validée
        @break
    @case('en_attente')
        ⏳ En attente
        @break
    @case('annulee')
        ❌ Annulée
        @break
    @default
        {{ ucfirst($statut) }}
@endswitch

@component('mail::button', ['url' => route('orders.show', $order->id)])
Voir ma commande
@endcomponent

Merci pour votre confiance !
@endcomponent
