<x-guest-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="product-name">
                    {{ $product->name }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ $product->store->name ?? 'Toko' }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $product->description }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Harga</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Rp {{ number_format($product->base_price, 0, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="mt-8">
            <h4 class="text-lg font-bold mb-4">Ulasan Produk</h4>
            @if ($product->reviews->isEmpty())
                <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
            @else
                <div class="space-y-4" id="reviews-list">
                    @foreach ($product->reviews as $review)
                        <div class="bg-white p-4 shadow sm:rounded-lg review-item">
                            <div class="flex items-center mb-2">
                                <span class="font-bold text-gray-800 mr-2 review-author">{{ $review->user->name }}</span>
                                <span class="text-yellow-500 review-rating">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        ★
                                    @endfor
                                    @for ($i = $review->rating; $i < 5; $i++)
                                        ☆
                                    @endfor
                                </span>
                            </div>
                            <p class="text-gray-600 review-comment">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
    </div>
</x-guest-layout>
