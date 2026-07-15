<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analisis Ulasan Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">Analisis Ulasan</h3>
                <p class="text-sm text-gray-600">Ringkasan rating produk dan daftar ulasan terbaru.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Bar chart distribusi rating (1 sampai 5 bintang) -->
                <div class="lg:col-span-1 bg-white shadow-sm sm:rounded-lg overflow-hidden p-6 border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Distribusi Rating (Semua Produk)</h3>
                    <div class="relative h-64">
                        <canvas id="ratingDistributionChart"></canvas>
                    </div>
                </div>

                <!-- Tabel rata-rata rating per produk -->
                <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Rata-Rata Rating Per Produk</h3>
                    </div>
                    <div class="overflow-y-auto" style="max-height: 20rem;">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Rata-Rata Rating</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Ulasan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($productRatings as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <div class="flex items-center justify-center">
                                            <span class="text-amber-500 mr-1">★</span>
                                            <span class="font-bold">{{ number_format($product->reviews_avg_rating, 1) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $product->reviews_count }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Belum ada ulasan produk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Daftar ulasan terbaru yang perlu dimoderasi admin -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Ulasan Terbaru (Perlu Dimoderasi)</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($latestReviews as $review)
                    <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex justify-between items-start">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                                    {{ substr($review->user->name ?? '?', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $review->user->name ?? 'Anonim' }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Pada produk: <span class="font-medium text-gray-700">{{ $review->product->name ?? 'Produk dihapus' }}</span>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-800">{{ $review->comment }}</div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="flex text-amber-500 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                </div>
                                <div class="text-xs text-gray-500 mt-1">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">
                        Belum ada ulasan terbaru.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('ratingDistributionChart');
            if (ctx) {
                // Ensure Chart.js is loaded
                const labels = ['1 Bintang', '2 Bintang', '3 Bintang', '4 Bintang', '5 Bintang'];
                const data = [
                    {{ $ratingDistribution[1] ?? 0 }},
                    {{ $ratingDistribution[2] ?? 0 }},
                    {{ $ratingDistribution[3] ?? 0 }},
                    {{ $ratingDistribution[4] ?? 0 }},
                    {{ $ratingDistribution[5] ?? 0 }}
                ];

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Ulasan',
                            data: data,
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.8)',   // 1 star - red
                                'rgba(249, 115, 22, 0.8)',  // 2 star - orange
                                'rgba(234, 179, 8, 0.8)',   // 3 star - yellow
                                'rgba(132, 204, 22, 0.8)',  // 4 star - lime
                                'rgba(34, 197, 94, 0.8)'    // 5 star - green
                            ],
                            borderWidth: 0,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.raw + ' Ulasan';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
