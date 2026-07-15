<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Laporan Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('admin.sales-summaries.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">&larr; Kembali ke Daftar Laporan</a>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Laporan</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Tanggal Laporan</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $salesSummary->report_date->format('d F Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Toko</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $salesSummary->store ? $salesSummary->store->name : 'Global (Semua Toko)' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Pesanan</p>
                                <p class="text-lg font-semibold text-gray-900">{{ number_format($salesSummary->total_orders) }} pesanan</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Pendapatan</p>
                                <p class="text-lg font-semibold text-green-600">Rp {{ number_format($salesSummary->total_revenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
