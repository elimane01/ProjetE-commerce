<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Commande #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f5f5f5; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Facture - Commande #{{ $order->id }}</h2>
        <p>Date : {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>
    <div class="section">
        <h4>Informations client</h4>
        <p><strong>Nom :</strong> {{ $order->user ? $order->user->name : 'N/A' }}</p>
        <p><strong>Email :</strong> {{ $order->user ? $order->user->email : 'N/A' }}</p>
    </div>
    <div class="section">
        <h4>Détails de la commande</h4>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ number_format($product->pivot->price, 0, ',', ' ') }} CFA</td>
                        <td>{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', ' ') }} CFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="total">Total TTC : {{ number_format($order->calculated_total, 0, ',', ' ') }} CFA</p>
    </div>
    <div class="section">
        <p><strong>Mode de paiement :</strong> {{ $order->payment_method ?? 'Non renseigné' }}</p>
        <p><strong>Statut paiement :</strong> {{ ucfirst($order->payment_status) }}</p>
    </div>
</body>
</html> 