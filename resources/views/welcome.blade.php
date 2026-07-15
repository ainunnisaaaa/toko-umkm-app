<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TokoKita - E-Commerce UMKM</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Fallback for uncompiled Tailwind classes -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            tokopedia: {
                                DEFAULT: '#03AC0E',
                                dark: '#008C0A',
                                light: '#E5F7E6',
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="antialiased bg-gray-100">
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-100 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="text-xl font-bold text-tokopedia">
                                TokoKita
                            </a>
                        </div>
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 hover:text-tokopedia font-medium">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-tokopedia font-medium">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="text-sm text-tokopedia bg-tokopedia-light px-4 py-2 rounded-md hover:bg-green-100 font-medium">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section & Search -->
            <div class="bg-tokopedia text-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl font-extrabold mb-4">Dukung UMKM Lokal</h1>
                    <p class="text-lg text-tokopedia-light mb-8">Temukan produk berkualitas dari berbagai toko di sekitar Anda.</p>
                    
                    <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full px-4 py-3 rounded-l-md text-gray-900 border-none focus:ring-2 focus:ring-tokopedia-light">
                        <button type="submit" class="bg-tokopedia-dark hover:bg-green-800 px-6 py-3 rounded-r-md font-medium transition">Cari</button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="w-full md:w-64 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori</h3>
                        <div class="space-y-2">
                            <a href="{{ route('home') }}" class="block text-sm {{ !request('category') ? 'text-tokopedia font-medium' : 'text-gray-600 hover:text-tokopedia' }}">Semua Kategori</a>
                            @foreach($categories as $category)
                                <a href="{{ route('home', ['category' => $category->id, 'search' => request('search')]) }}" 
                                   class="block text-sm {{ request('category') == $category->id ? 'text-tokopedia font-medium' : 'text-gray-600 hover:text-tokopedia' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="flex-grow">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($products as $product)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-200">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-3xl">📦</div>
                                        @endif
                                    </a>
                                    <div class="p-4">
                                        <div class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Kategori' }}</div>
                                        <a href="{{ route('products.show', $product->id) }}" class="block text-md font-semibold text-gray-900 hover:text-tokopedia truncate mb-1">
                                            {{ $product->name }}
                                        </a>
                                        <div class="text-xs text-gray-500 mb-2">
                                            <span class="inline-block bg-gray-100 rounded px-2 py-1">🏪 {{ $product->store->name ?? 'Toko' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100">
                                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($product->base_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                            <div class="text-4xl mb-3">🔍</div>
                            <h3 class="text-lg font-medium text-gray-900">Tidak ada produk ditemukan</h3>
                            <p class="text-gray-500 mt-1">Coba gunakan kata kunci pencarian atau kategori lain.</p>
                            <a href="{{ route('home') }}" class="mt-4 inline-block text-tokopedia hover:underline">Tampilkan semua produk</a>
                        </div>
                    @endif
                </div>
            </div>
            
            <footer class="bg-white border-t border-gray-200 mt-12 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} TokoKita - Platform E-Commerce UMKM. Hak Cipta Dilindungi.
                </div>
            </footer>
        </div>
    </body>
</html>
