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
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Informasi Pesanan</h3>
                            <p class="text-sm text-gray-500">Toko: <span class="font-medium text-gray-900">{{ $order->store->name }}</span></p>
                            <p class="text-sm text-gray-500 mt-1">Tanggal: <span class="font-medium text-gray-900">{{ $order->created_at->format('d M Y H:i') }}</span></p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="text-xl font-bold uppercase text-indigo-600">{{ $order->status }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500 font-medium mb-1">Alamat Pengiriman</p>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded text-sm">{{ $order->shipping_address }}</p>
                    </div>
                    
                    @if($order->receipt_number)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-sm text-gray-500 font-medium mb-1">Nomor Resi Pengiriman</p>
                            <div class="flex items-center">
                                <span class="font-mono bg-indigo-50 text-indigo-700 px-3 py-1 rounded border border-indigo-100">{{ $order->receipt_number }}</span>
                                <span class="ml-3 text-xs text-gray-500">Gunakan nomor resi ini untuk melacak paket Anda.</span>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Daftar Produk</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Produk</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Harga</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Jumlah</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="flex items-center">
                                                @if($item->product && $item->product->image_url)
                                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="h-10 w-10 object-cover rounded mr-3">
                                                @endif
                                                <span>{{ $item->product_name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $item->quantity }}</td>
                                        <td class="px-4 py-3 text-sm text-right font-medium">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-6 text-gray-900 bg-gray-50">
                    <div class="flex flex-col md:flex-row justify-between items-start">
                        <div class="w-full md:w-1/2 mb-6 md:mb-0">
                            @if($order->status === 'pending')
                                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-md">
                                    <h4 class="font-semibold text-yellow-800 mb-2">Menunggu Pembayaran</h4>
                                    <p class="text-sm text-yellow-700 mb-4">Silakan unggah bukti pembayaran agar pesanan dapat diproses oleh penjual.</p>
                                    <a href="{{ route('buyer.orders.edit', $order->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded text-sm font-medium hover:bg-yellow-600 transition">Unggah Bukti Pembayaran</a>
                                </div>
                            @elseif($order->payment_proof)
                                <div class="bg-white border border-gray-200 p-4 rounded-md">
                                    <h4 class="font-semibold text-gray-700 mb-1">Bukti Pembayaran</h4>
                                    <a href="{{ $order->payment_proof }}" target="_blank" class="text-sm text-indigo-600 hover:underline">Lihat Bukti Terlampir</a>
                                </div>
                            @endif
                        </div>
                        
                        <div class="w-full md:w-1/3">
                            <div class="flex justify-between py-2 text-sm">
                                <span class="text-gray-600">Subtotal Produk</span>
                                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200 text-sm">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="font-bold text-lg text-gray-900">Total Pembayaran</span>
                                <span class="font-bold text-xl text-indigo-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-8">
                <a href="{{ route('buyer.orders.index') }}" class="px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-md hover:bg-gray-50 transition shadow-sm">&larr; Kembali ke Riwayat Pesanan</a>
            </div>
        </div>
    </div>
</x-app-layout>
