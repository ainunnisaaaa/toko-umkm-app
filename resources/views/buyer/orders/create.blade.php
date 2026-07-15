<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('buyer.orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Ringkasan Pesanan</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toko</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuantitas</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($carts as $cart)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $cart->product->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $cart->product->store->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $cart->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($cart->product->base_price * $cart->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Total Belanja</h3>
                            <p class="text-xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">(Belum termasuk ongkir)</span></p>
                        </div>

                        <div class="mb-6">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                            <textarea id="shipping_address" name="shipping_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('buyer.carts.index') }}" class="mr-4 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Buat Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
