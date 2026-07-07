<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Produk') }}
            </h2>
            <a href="{{ route('seller.products.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition">
                Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
        <form action="{{ route('seller.products.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Produk</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama produk...">
            </div>
            
            <div class="w-full md:w-48">
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-32">
                <label for="min_price" class="block text-sm font-medium text-gray-700">Min Harga</label>
                <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Min...">
            </div>

            <div class="w-full md:w-32">
                <label for="max_price" class="block text-sm font-medium text-gray-700">Max Harga</label>
                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Max...">
            </div>

            <div>
                <button type="submit" class="w-full md:w-auto px-4 py-2 bg-gray-800 text-white border border-transparent rounded-md text-sm font-medium hover:bg-gray-700 transition">
                    Filter
                </button>
            </div>
            @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price']))
                <div>
                    <a href="{{ route('seller.products.index') }}" class="block w-full md:w-auto px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 transition text-center">
                        Reset
                    </a>
                </div>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Info Produk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-md overflow-hidden">
                                    @if($product->image)
                                        <img class="h-10 w-10 object-cover" src="{{ Storage::url($product->image) }}" alt="">
                                    @else
                                        <svg class="h-10 w-10 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->category->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format($product->base_price, 0, ',', '.') }}</div>
                            @if($product->discount_price)
                                <div class="text-xs text-green-600">Diskon: Rp {{ number_format($product->discount_price, 0, ',', '.') }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->stock }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->is_active)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('seller.products.show', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat</a>
                            <a href="{{ route('seller.products.edit', $product->id) }}" class="text-amber-600 hover:text-amber-900 mr-3">Edit</a>
                            <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            Tidak ada data produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        @if(method_exists($products, 'links'))
            {{ $products->links() }}
        @endif
    </div>
</x-app-layout>
