@extends('pdf.layout')

@section('title', 'Laporan Top 10 Produk Terlaris')
@section('report_title', 'Laporan Top 10 Produk Terlaris')

@section('content')
    <table class="table-responsive">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="35%">Nama Produk</th>
                <th width="20%">Nama Toko</th>
                <th width="15%" class="text-right">Harga Satuan</th>
                <th width="10%" class="text-center">Terjual</th>
                <th width="15%" class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @forelse($products as $index => $product)
                @php $totalSemua += $product->total_revenue; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $product->total_sold }}</td>
                    <td class="text-right">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data produk terlaris.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($products) > 0)
        <tfoot>
            <tr>
                <td colspan="5" class="text-right text-bold">Total Nilai Penjualan Top 10 Produk</td>
                <td class="text-right text-bold">Rp {{ number_format($totalSemua, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>
@endsection
