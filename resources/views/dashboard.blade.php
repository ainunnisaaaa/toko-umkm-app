<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 border border-green-400 p-4 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Selamat datang, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600">Berikut adalah ringkasan akun Anda.</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('dashboard', ['refresh' => 1]) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Refresh Data
                    </a>
                    @if(strtolower(auth()->user()->role) === 'admin')
                    <a href="{{ route('admin.reports.top-products') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Top 10 Produk (PDF)
                    </a>
                    <a href="{{ route('admin.reports.transactions-excel') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:border-emerald-900 focus:ring ring-emerald-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Transaksi (Excel)
                    </a>
                    <a href="{{ route('admin.reports.store-performance-excel') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-900 focus:outline-none focus:border-amber-900 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Kinerja Toko (Excel)
                    </a>
                    <a href="{{ route('admin.reports.platform-commissions-excel') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Komisi Platform (Excel)
                    </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php $userRole = strtolower(auth()->user()->role); @endphp
                @if($userRole === 'admin')
                    <!-- Admin Stats -->
                    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white flex items-center justify-between transform transition duration-300 hover:scale-105">
                        <div>
                            <div class="text-sm font-medium text-indigo-100 truncate">Total Pengguna</div>
                            <div class="mt-1 text-4xl font-bold">{{ $data['total_users'] ?? 0 }}</div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white flex items-center justify-between transform transition duration-300 hover:scale-105">
                        <div>
                            <div class="text-sm font-medium text-emerald-100 truncate">Total Toko</div>
                            <div class="mt-1 text-4xl font-bold">{{ $data['total_stores'] ?? 0 }}</div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-amber-500 to-amber-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white flex items-center justify-between transform transition duration-300 hover:scale-105">
                        <div>
                            <div class="text-sm font-medium text-amber-100 truncate">Total Produk</div>
                            <div class="mt-1 text-4xl font-bold">{{ $data['total_products'] ?? 0 }}</div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white flex items-center justify-between transform transition duration-300 hover:scale-105">
                        <div>
                            <div class="text-sm font-medium text-blue-100 truncate">Total Pesanan</div>
                            <div class="mt-1 text-4xl font-bold">{{ $data['total_orders'] ?? 0 }}</div>
                        </div>
                        <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                    </div>
                @elseif($userRole === 'seller')
                    <!-- Seller Stats -->
                    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white transform transition duration-300 hover:scale-105">
                        <div class="text-sm font-medium text-indigo-100 truncate">Produk Anda</div>
                        <div class="mt-1 text-4xl font-bold">{{ $data['total_products'] ?? 0 }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white transform transition duration-300 hover:scale-105">
                        <div class="text-sm font-medium text-emerald-100 truncate">Pesanan Masuk</div>
                        <div class="mt-1 text-4xl font-bold">{{ $data['total_orders'] ?? 0 }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-amber-500 to-amber-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white transform transition duration-300 hover:scale-105">
                        <div class="text-sm font-medium text-amber-100 truncate">Total Pendapatan</div>
                        <div class="mt-1 text-4xl font-bold">Rp {{ number_format($data['total_revenue'] ?? 0, 0, ',', '.') }}</div>
                    </div>
                @elseif($userRole === 'buyer')
                    <!-- Buyer Stats -->
                    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white transform transition duration-300 hover:scale-105">
                        <div class="text-sm font-medium text-indigo-100 truncate">Pesanan Anda</div>
                        <div class="mt-1 text-4xl font-bold">{{ $data['total_orders'] ?? 0 }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white transform transition duration-300 hover:scale-105">
                        <div class="text-sm font-medium text-emerald-100 truncate">Keranjang</div>
                        <div class="mt-1 text-4xl font-bold">{{ $data['total_carts'] ?? 0 }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-rose-500 to-rose-600 overflow-hidden shadow-lg sm:rounded-xl p-6 text-white transform transition duration-300 hover:scale-105">
                        <div class="text-sm font-medium text-rose-100 truncate">Wishlist</div>
                        <div class="mt-1 text-4xl font-bold">{{ $data['total_wishlists'] ?? 0 }}</div>
                    </div>
                @endif
            </div>

            @if(in_array($userRole, ['admin', 'seller']))
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Revenue Chart -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden p-6 border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tren Pendapatan (7 Hari Terakhir)</h3>
                    <div class="relative h-72">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Status Distribution Chart -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden p-6 border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Distribusi Status Pesanan</h3>
                    <div class="relative h-72 flex justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
            @endif

            @if($userRole === 'admin')
            <div class="mt-8 grid grid-cols-1 gap-6">
                <!-- Top 10 Products Chart -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden p-6 border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Top 10 Produk Terlaris</h3>
                    <div class="relative h-72">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Users -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Pengguna Terbaru</h3>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">Lihat Semua &rarr;</a>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($data['recent_users'] ?? [] as $user)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }} • {{ ucfirst($user->role) }}</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-sm text-gray-500">Belum ada pengguna.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Stores -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Toko Terbaru</h3>
                        <a href="#" class="text-sm text-emerald-600 hover:text-emerald-900">Lihat Semua &rarr;</a>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($data['recent_stores'] ?? [] as $store)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold">
                                    {{ substr($store->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $store->name }}</div>
                                    <div class="text-sm text-gray-500">Pemilik: {{ $store->user->name ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $store->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-sm text-gray-500">Belum ada toko.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden lg:col-span-2">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Pesanan Terbaru</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-900">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembeli</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($data['recent_orders'] ?? [] as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $order->status === 'Selesai' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'Menunggu Pembayaran' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status === 'Dibatalkan' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Belum ada pesanan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Auto refresh every 5 minutes (300000 ms)
            setTimeout(function() {
                window.location.reload();
            }, 300000);

            @if(isset($data['chart_revenue_labels']) && isset($data['chart_revenue_data']))
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: {!! $data['chart_revenue_labels'] !!},
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: {!! $data['chart_revenue_data'] !!},
                            borderColor: '#4f46e5', // indigo-600
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            }
            @endif

            @if(isset($data['chart_status_labels']) && isset($data['chart_status_data']))
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! $data['chart_status_labels'] !!},
                        datasets: [{
                            data: {!! $data['chart_status_data'] !!},
                            backgroundColor: [
                                '#f59e0b', // amber-500 (pending)
                                '#3b82f6', // blue-500 (processing)
                                '#8b5cf6', // violet-500 (shipped)
                                '#10b981', // emerald-500 (completed)
                                '#ef4444', // red-500 (cancelled)
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'right' }
                        }
                    }
                });
            }
            @endif

            @if(isset($data['chart_top_products_labels']) && isset($data['chart_top_products_data']))
            const topProductsCtx = document.getElementById('topProductsChart');
            if (topProductsCtx) {
                new Chart(topProductsCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! $data['chart_top_products_labels'] !!},
                        datasets: [{
                            label: 'Jumlah Terjual',
                            data: {!! $data['chart_top_products_data'] !!},
                            backgroundColor: 'rgba(59, 130, 246, 0.8)', // blue-500
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            }
            @endif
        });
    </script>
    @endpush
</x-app-layout>
