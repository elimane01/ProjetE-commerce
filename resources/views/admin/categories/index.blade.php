<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-white">Liste des catégories</h1>
            <a href="{{ route('categories.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-green-700 transition">
                + Ajouter une catégorie
            </a>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">{{ $category->description }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('categories.edit', $category) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs">Éditer</a>
                                <a href="{{ route('categories.products', $category) }}" class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 text-xs">Voir les produits</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-400 py-8">Aucune catégorie trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 