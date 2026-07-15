@extends('pdf.layout')

@section('title', 'Riwayat Pembelian')
@section('report_title', 'Laporan Riwayat Pembelian Pelanggan')

@section('content')
    <div style="margin-bottom: 20px;">
        <p><strong>Nama Pelanggan:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    </div>

    <table class="table-responsive">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%">No. Invoice</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Toko</th>
                <th width="25%">Produk</th>
                <th width="20%" class="text-right">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($orders as $index => $order)
                @php $grandTotal += $order->total_amount; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $order->invoice_number }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>{{ $order->store->name ?? '-' }}</td>
                    <td>
                        <ul style="margin: 0; padding-left: 15px;">
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->product->name ?? 'Produk Dihapus' }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada riwayat pembelian yang selesai.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($orders) > 0)
        <tfoot>
            <tr>
                <td colspan="5" class="text-right text-bold">Total Nilai Pembelanjaan</td>
                <td class="text-right text-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>
@endsection
