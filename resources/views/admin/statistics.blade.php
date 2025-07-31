<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold text-white mb-8">Statistiques avancées</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Chiffre d'affaires</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['chiffre_affaires'], 0, ',', ' ') }} CFA</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre de commandes</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Produit le plus vendu</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        @if($stats['produit_plus_vendu'])
                            {{ $stats['produit_plus_vendu']->name }} ({{ $stats['produit_plus_vendu']->ventes }} ventes)
                        @else
                            Aucun produit
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Commandes payées</p>
                    <p class="text-2xl font-semibold text-green-700 dark:text-green-400">{{ $stats['paid_orders'] }}</p>
                    <p class="text-sm text-gray-500 mt-2">CA encaissé : <span class="font-bold">{{ number_format($stats['ca_paye'], 0, ',', ' ') }} CFA</span></p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Commandes non payées</p>
                    <p class="text-2xl font-semibold text-red-700 dark:text-red-400">{{ $stats['unpaid_orders'] }}</p>
                    <p class="text-sm text-gray-500 mt-2">CA en attente : <span class="font-bold">{{ number_format($stats['ca_non_paye'], 0, ',', ' ') }} CFA</span></p>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:underline">Retour au dashboard</a>
    </div>
</x-app-layout> 