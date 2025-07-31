<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold text-white mb-6">Détail de la commande #{{ $order->id }}</h1>
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-2">Informations client</h2>
            <p><span class="font-semibold">Nom :</span> {{ $order->user ? $order->user->name : 'N/A' }}</p>
            <p><span class="font-semibold">Email :</span> {{ $order->user ? $order->user->email : 'N/A' }}</p>
            <p><span class="font-semibold">Date :</span> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><span class="font-semibold">Statut :</span> {{ ucfirst($order->status) }}</p>
            <p><span class="font-semibold">Mode de paiement :</span> {{ $order->payment_method ?? 'Non renseigné' }}</p>
            <p><span class="font-semibold">Statut paiement :</span> {{ ucfirst($order->payment_status) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-2">Produits commandés</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->pivot->quantity }}</td>
                            <td class="px-4 py-2">{{ number_format($product->pivot->price, 0, ',', ' ') }} CFA</td>
                            <td class="px-4 py-2">{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', ' ') }} CFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 text-right">
                <span class="font-bold">Total :</span> {{ number_format($order->calculated_total, 0, ',', ' ') }} CFA
            </div>
        </div>
        <div class="flex justify-between">
            <a href="{{ route('orders.index') }}" class="text-gray-500 hover:underline">Retour à la liste</a>
            <a href="{{ route('orders.invoice', $order) }}" class="bg-indigo-600 text-white px-6 py-2 rounded font-semibold hover:bg-indigo-700 transition">Télécharger la facture</a>
            <a href="{{ route('orders.edit', $order) }}" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700 transition">Modifier le statut</a>
        </div>
    </div>
</x-app-layout> 