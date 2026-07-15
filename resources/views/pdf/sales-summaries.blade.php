@extends('pdf.layout')

@section('title', 'Laporan Rekapitulasi Penjualan')
@section('report_title', 'Laporan Rekapitulasi Penjualan Harian/Bulanan')

@section('content')
    <table class="table-responsive">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%">Tanggal Laporan</th>
                <th width="20%">Nama Toko</th>
                <th width="15%" class="text-center">Total Pesanan</th>
                <th width="20%" class="text-right">Total Pendapatan</th>
                <th width="25%" class="text-right">Komisi Platform</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $grandTotalPesanan = 0;
                $grandTotalPendapatan = 0;
                $grandTotalKomisi = 0;
            @endphp
            @forelse($salesSummaries as $index => $summary)
                @php 
                    $grandTotalPesanan += $summary->total_orders;
                    $grandTotalPendapatan += $summary->total_revenue;
                    $grandTotalKomisi += $summary->platform_fee;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($summary->report_date)->format('d M Y') }}</td>
                    <td>{{ $summary->store->name ?? '-' }}</td>
                    <td class="text-center">{{ $summary->total_orders }}</td>
                    <td class="text-right">Rp {{ number_format($summary->total_revenue, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($summary->platform_fee, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data rekapitulasi penjualan.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($salesSummaries) > 0)
        <tfoot>
            <tr>
                <td colspan="3" class="text-right text-bold">Total Keseluruhan</td>
                <td class="text-center text-bold">{{ $grandTotalPesanan }}</td>
                <td class="text-right text-bold">Rp {{ number_format($grandTotalPendapatan, 0, ',', '.') }}</td>
                <td class="text-right text-bold">Rp {{ number_format($grandTotalKomisi, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>
@endsection
