<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unggah Bukti Pembayaran') }} #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 bg-indigo-50 border border-indigo-100 p-4 rounded-md">
                        <h3 class="text-indigo-800 font-semibold mb-2">Total Pembayaran: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h3>
                        <p class="text-sm text-indigo-700">Silakan transfer sesuai dengan total pembayaran ke rekening penjual. Setelah transfer, unggah bukti pembayaran pada form di bawah ini agar pesanan Anda dapat segera diproses.</p>
                    </div>

                    <form method="POST" action="{{ route('buyer.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label for="payment_proof" class="block text-sm font-medium text-gray-700">URL Bukti Pembayaran</label>
                            <input type="url" name="payment_proof" id="payment_proof" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: https://example.com/bukti.jpg" required>
                            <p class="mt-2 text-xs text-gray-500">
                                Saat ini hanya mendukung input berupa link/URL gambar bukti transfer.
                            </p>
                            @error('payment_proof')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('buyer.orders.show', $order->id) }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
