<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan') }} #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Informasi Pelanggan & Pengiriman</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Pembeli</p>
                            <p class="font-medium">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Pesanan</p>
                            <p class="font-bold uppercase text-indigo-600">{{ $order->status }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-sm text-gray-500">Alamat Pengiriman</p>
                            <p class="bg-gray-50 p-3 rounded mt-1">{{ $order->shipping_address }}</p>
                        </div>
                        @if($order->receipt_number)
                            <div class="col-span-2 mt-2">
                                <p class="text-sm text-gray-500">Nomor Resi</p>
                                <p class="font-mono bg-gray-100 p-2 inline-block rounded">{{ $order->receipt_number }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Daftar Produk</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Produk</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Harga Satuan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Jumlah</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">{{ $item->product_name }}</td>
                                        <td class="px-4 py-3 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 text-sm text-right font-medium">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-6 text-gray-900 bg-gray-50">
                    <div class="flex justify-end">
                        <div class="w-full max-w-sm">
                            <div class="flex justify-between py-2">
                                <span class="text-gray-600">Subtotal Produk</span>
                                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="font-bold text-lg">Total Pembayaran</span>
                                <span class="font-bold text-lg text-indigo-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('seller.orders.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition">Kembali</a>
                <a href="{{ route('seller.orders.edit', $order->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Update Status / Resi</a>
            </div>
        </div>
    </div>
</x-app-layout>
