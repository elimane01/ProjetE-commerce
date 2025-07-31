<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold text-white mb-6">Détail de l'utilisateur #{{ $user->id }}</h1>
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-2">Informations utilisateur</h2>
            <p><span class="font-semibold">Nom :</span> {{ $user->name }}</p>
            <p><span class="font-semibold">Email :</span> {{ $user->email }}</p>
            <p><span class="font-semibold">Date d'inscription :</span> {{ $user->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-2">Historique des commandes</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($user->orders as $order)
                        <tr>
                            <td class="px-4 py-2">{{ $order->id }}</td>
                            <td class="px-4 py-2">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-2">{{ number_format($order->calculated_total, 0, ',', ' ') }} CFA</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('orders.show', $order) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-8">Aucune commande trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ route('users.edit', $user) }}" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700 transition">Modifier</a>
        <a href="{{ route('users.index') }}" class="text-gray-500 hover:underline">Retour à la liste</a>
    </div>
</x-app-layout> 