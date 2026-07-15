<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Keinginan (Wishlist)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(count($wishlists) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($wishlists as $wishlist)
                                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden flex flex-col">
                                    @if($wishlist->product->image_url)
                                        <img src="{{ $wishlist->product->image_url }}" alt="{{ $wishlist->product->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-4xl text-gray-400">
                                            📦
                                        </div>
                                    @endif
                                    
                                    <div class="p-4 flex-grow flex flex-col justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1 truncate" title="{{ $wishlist->product->name }}">
                                                {{ $wishlist->product->name }}
                                            </h3>
                                            <p class="text-indigo-600 font-bold mb-2">Rp {{ number_format($wishlist->product->base_price, 0, ',', '.') }}</p>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-4">
                                            <a href="{{ route('products.show', $wishlist->product->id) }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                                                Lihat Detail
                                            </a>
                                            <form action="{{ route('buyer.wishlists.destroy', $wishlist->id) }}" method="POST" onsubmit="return confirm('Hapus dari wishlist?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            {{ $wishlists->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-5xl mb-4 text-red-400">❤️</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Wishlist Anda masih kosong</h3>
                            <p class="text-gray-500 mb-6">Simpan produk yang Anda suka untuk dibeli nanti.</p>
                            <a href="/" class="px-6 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition">
                                Cari Produk
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
