<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-white">Modifier la catégorie</h1>
        <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white p-6 rounded shadow text-gray-700 space-y-5">
            @csrf
            @method('PUT')
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <label class="block mb-1 font-semibold">Nom de la catégorie</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded px-3 py-2" value="{{ old('name', $category->name) }}" required>
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" class="w-full border-gray-300 rounded px-3 py-2">{{ old('description', $category->description) }}</textarea>
                @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('categories.index') }}" class="text-gray-500 hover:underline">Retour à la liste</a>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700 transition">Enregistrer</button>
            </div>
        </form>
    </div>
</x-app-layout> 