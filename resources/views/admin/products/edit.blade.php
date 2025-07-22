<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-white">Modifier le produit</h1>
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow text-gray-700 space-y-5">
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
                <label class="block mb-1 font-semibold">Nom du produit</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded px-3 py-2" value="{{ old('name', $product->name) }}" required>
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" class="w-full border-gray-300 rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block mb-1 font-semibold">Prix (CFA)</label>
                    <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded px-3 py-2" value="{{ old('price', $product->price) }}" required>
                    @error('price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <div class="flex-1">
                    <label class="block mb-1 font-semibold">Stock</label>
                    <input type="number" name="stock" class="w-full border-gray-300 rounded px-3 py-2" value="{{ old('stock', $product->stock) }}" required>
                    @error('stock') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Catégorie</label>
                <select name="category_id" class="w-full border-gray-300 rounded px-3 py-2">
                    <option value="">Aucune</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Image</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Image actuelle" class="w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                    </div>
                @endif
                <input type="file" name="image" class="w-full">
                <p class="text-sm text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle</p>
                @error('image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:underline">Retour à la liste</a>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700 transition">Enregistrer</button>
            </div>
        </form>
    </div>
</x-app-layout> 