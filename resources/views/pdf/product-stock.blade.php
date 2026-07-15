@extends('pdf.layout')

@section('title', 'Laporan Stok Produk')
@section('report_title', 'Kartu Stok Barang')

@section('content')
    <div style="margin-bottom: 20px;">
        <p><strong>Nama Toko:</strong> {{ auth()->user()->store->name ?? '-' }}</p>
        <p><strong>Pemilik:</strong> {{ auth()->user()->name }}</p>
    </div>

    <table class="table-responsive">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="35%">Nama Produk</th>
                <th width="20%">Kategori</th>
                <th width="15%" class="text-right">Harga</th>
                <th width="15%" class="text-center">Stok</th>
                <th width="10%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($product->stock) }}</td>
                    <td class="text-center">
                        @if($product->is_active)
                            <span style="color: green; font-weight: bold;">Aktif</span>
                        @else
                            <span style="color: red; font-weight: bold;">Nonaktif</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada produk di toko ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
