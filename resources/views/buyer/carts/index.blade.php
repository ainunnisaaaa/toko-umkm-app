<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
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
                    @if(count($carts) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuantitas</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php $total = 0; @endphp
                                    @foreach ($carts as $cart)
                                        @php 
                                            $subtotal = $cart->product->base_price * $cart->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($cart->product->image_url)
                                                        <img src="{{ $cart->product->image_url }}" alt="{{ $cart->product->name }}" class="h-10 w-10 object-cover rounded mr-3">
                                                    @else
                                                        <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center text-gray-500 mr-3">📦</div>
                                                    @endif
                                                    <div class="text-sm font-medium text-gray-900">{{ $cart->product->name }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Rp {{ number_format($cart->product->base_price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('buyer.carts.update', $cart->id) }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm mr-2">
                                                    <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-900">Update</button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('buyer.carts.destroy', $cart->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-8 flex justify-end">
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100 w-full max-w-md">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Ringkasan Belanja</h3>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-600">Total Harga</span>
                                    <span class="text-xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('buyer.orders.create') }}" class="block w-full text-center px-4 py-3 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 transition">
                                    Lanjut ke Pembayaran
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-5xl mb-4">🛒</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang belanja Anda masih kosong</h3>
                            <p class="text-gray-500 mb-6">Ayo temukan produk UMKM menarik dan masukkan ke keranjang!</p>
                            <a href="/" class="px-6 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition">
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
