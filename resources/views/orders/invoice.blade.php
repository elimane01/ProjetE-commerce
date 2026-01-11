<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-info {
            float: left;
            width: 50%;
        }
        .invoice-info {
            float: right;
            width: 40%;
            text-align: right;
        }
        .clear {
            clear: both;
        }
        .customer-info {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-COMMERCE</h1>
        <p>Votre boutique en ligne de confiance</p>
    </div>

    <div class="company-info">
        <h3>Émetteur</h3>
        <p><strong>E-COMMERCE</strong><br>
        Adresse de l'entreprise<br>
        Téléphone: +123 456 789<br>
        Email: contact@ecommerce.com</p>
    </div>

    <div class="invoice-info">
        <h3>FACTURE</h3>
        <p><strong>N° Facture:</strong> #{{ $order->id }}<br>
        <strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}<br>
        <strong>Statut:</strong> 
        @if($order->statut == 'en_attente')
            En attente
        @elseif($order->statut == 'validee')
            Validée
        @elseif($order->statut == 'expediee')
            Expédiée
        @elseif($order->statut == 'livree')
            Livrée
        @elseif($order->statut == 'annulee')
            Annulée
        @endif</p>
    </div>

    <div class="clear"></div>

    <div class="customer-info">
        <h3>Client</h3>
        <p><strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong><br>
        <strong>Adresse de livraison:</strong> {{ $order->adresse_livraison }}<br>
        <strong>Téléphone:</strong> {{ $order->telephone }}<br>
        <strong>Email:</strong> {{ $order->email }}</p>
    </div>

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
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? $item->product->nom ?? 'Produit' }}</td>
                    <td>{{ $item->quantite }}</td>
                    <td>{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($item->prix_unitaire * $item->quantite, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;"><strong>TOTAL</strong></td>
                <td><strong>{{ number_format($order->total, 0, ',', ' ') }} FCFA</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Merci pour votre confiance !<br>
        Pour toute question, contactez-nous à contact@ecommerce.com</p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Imprimer la facture</button>
        <button onclick="window.close()">Fermer</button>
    </div>
</body>
</html> 