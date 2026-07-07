<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Produk') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('seller.products.edit', $product->id) }}" class="px-4 py-2 bg-amber-500 text-white rounded-md text-sm font-medium hover:bg-amber-600 transition">
                    Edit Produk
                </a>
                <a href="{{ route('seller.products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white overflow-hidden shadow rounded-lg border border-gray-200">
        <div class="md:flex">
            <div class="md:flex-shrink-0 bg-gray-50 p-6 flex justify-center items-center border-b md:border-b-0 md:border-r border-gray-200 md:w-1/3">
                @if($product->image)
                    <img class="max-h-64 object-contain rounded-md" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="text-gray-400">
                        <svg class="h-24 w-24 mx-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <p class="mt-2 text-sm text-center">Tidak ada gambar</p>
                    </div>
                @endif
            </div>
            <div class="p-8 md:w-2/3">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold mb-1">
                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                </div>
                <h1 class="block mt-1 text-2xl leading-tight font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                
                <div class="flex items-center space-x-4 mb-6">
                    <div class="text-xl font-bold text-gray-900">
                        Rp {{ number_format($product->base_price, 0, ',', '.') }}
                    </div>
                    @if($product->discount_price)
                        <div class="text-sm font-medium text-green-600 bg-green-100 px-2 py-1 rounded">
                            Diskon: Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                        </div>
                    @endif
                </div>

                <div class="border-t border-b border-gray-100 py-4 mb-6 flex space-x-8">
                    <div>
                        <span class="block text-sm text-gray-500 mb-1">Stok Tersedia</span>
                        <span class="font-medium text-gray-900">{{ $product->stock }} unit</span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500 mb-1">Status</span>
                        @if($product->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Nonaktif</span>
                        @endif
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500 mb-1">Rating</span>
                        <span class="font-medium text-yellow-500">★ {{ number_format($product->rating, 1) }}</span>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Deskripsi Produk</h3>
                    <div class="text-gray-700 text-sm whitespace-pre-line">
                        {{ $product->description ?: 'Tidak ada deskripsi.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
