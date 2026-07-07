<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beri Ulasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Ulasan untuk {{ $product->name }}</h3>
                    <form method="POST" action="{{ route('buyer.reviews.store') }}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                            <select id="rating" name="rating" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500" required>
                                <option value="5">5 Bintang (Sangat Bagus)</option>
                                <option value="4">4 Bintang (Bagus)</option>
                                <option value="3">3 Bintang (Cukup)</option>
                                <option value="2">2 Bintang (Buruk)</option>
                                <option value="1">1 Bintang (Sangat Buruk)</option>
                            </select>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Komentar</label>
                            <textarea id="comment" name="comment" rows="4" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500"></textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700" id="btn-submit-review">
                                Simpan Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
