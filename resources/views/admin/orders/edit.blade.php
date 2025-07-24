<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-white">Modifier le statut de la commande #{{ $order->id }}</h1>
        <form action="{{ route('orders.update', $order) }}" method="POST" class="bg-white p-6 rounded shadow text-gray-700 space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-1 font-semibold">Statut</label>
                <select name="status" class="w-full border-gray-300 rounded px-3 py-2">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @error('status') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('orders.show', $order) }}" class="text-gray-500 hover:underline">Retour</a>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700 transition">Enregistrer</button>
            </div>
        </form>
    </div>
</x-app-layout> 