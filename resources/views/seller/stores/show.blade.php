<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Toko') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('seller.stores.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">&larr; Kembali ke Daftar Toko</a>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-md">
                        <div class="flex items-center space-x-4 mb-6 border-b pb-4">
                            @if($store->logo)
                                <img src="{{ $store->logo }}" alt="{{ $store->name }}" class="h-16 w-16 object-cover rounded-full">
                            @else
                                <div class="h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-xl">
                                    🏪
                                </div>
                            @endif
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $store->name }}</h3>
                                <div class="flex items-center text-sm text-yellow-500 mt-1">
                                    <span class="mr-1">⭐</span>
                                    <span>{{ $store->rating ? number_format($store->rating, 1) : 'Belum ada rating' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-1">Deskripsi Toko</p>
                                <p class="text-gray-900 bg-white p-3 rounded border border-gray-200 min-h-[4rem]">
                                    {{ $store->description ?? 'Tidak ada deskripsi.' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-1">Alamat</p>
                                <p class="text-gray-900 bg-white p-3 rounded border border-gray-200 min-h-[4rem]">
                                    {{ $store->address }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 font-medium mb-1">Dibuat Pada</p>
                                <p class="text-gray-900">
                                    {{ $store->created_at->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end space-x-3">
                            <a href="{{ route('seller.stores.edit', $store->id) }}" class="px-4 py-2 bg-amber-500 text-white rounded-md text-sm font-medium hover:bg-amber-600 transition">
                                Edit Toko
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
