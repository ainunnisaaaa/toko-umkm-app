<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice INV-{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        .invoice-box {
            max-width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 35px;
            line-height: 35px;
            color: #1a202c;
            font-weight: bold;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #f7fafc;
            border-bottom: 1px solid #e2e8f0;
            font-weight: bold;
            padding: 10px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            padding: 10px;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(n+4) {
            border-top: 2px solid #e2e8f0;
            font-weight: bold;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
        .bg-green { background-color: #48bb78; }
        .bg-yellow { background-color: #ecc94b; color: #744210; }
        .bg-red { background-color: #f56565; }
        .bg-blue { background-color: #4299e1; }
        .bg-gray { background-color: #a0aec0; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                INVOICE
                            </td>
                            <td>
                                Invoice #: INV-{{ $order->id }}<br>
                                Tanggal: {{ $order->created_at->format('d M Y') }}<br>
                                Status: 
                                @if($order->status == 'Selesai') <span class="badge bg-green">Selesai</span>
                                @elseif($order->status == 'Menunggu Pembayaran') <span class="badge bg-yellow">Menunggu Pembayaran</span>
                                @elseif($order->status == 'Dibatalkan') <span class="badge bg-red">Dibatalkan</span>
                                @else <span class="badge bg-blue">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                <strong>Toko Penjual:</strong><br>
                                {{ $order->store->name ?? '-' }}<br>
                                {{ $order->store->address ?? '-' }}
                            </td>
                            <td>
                                <strong>Ditagihkan Ke:</strong><br>
                                {{ $order->user->name ?? '-' }}<br>
                                {{ $order->shipping_address }}<br>
                                Resi: {{ $order->receipt_number ?? 'Belum ada' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item</td>
                <td class="text-right">Harga</td>
                <td class="text-center">Kuantitas</td>
                <td class="text-right">Diskon</td>
                <td class="text-right">Subtotal</td>
            </tr>

            @foreach($order->orderItems as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>{{ $item->product->name ?? 'Produk Tidak Ditemukan' }}</td>
                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">Rp 0</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="3"></td>
                <td class="text-right">Subtotal:</td>
                <td class="text-right">Rp {{ number_format($order->orderItems->sum('subtotal'), 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td class="text-right">Ongkos Kirim:</td>
                <td class="text-right">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td class="text-right" style="font-size: 18px;"><strong>Total Akhir:</strong></td>
                <td class="text-right" style="font-size: 18px;"><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
        
        <div style="margin-top: 50px; text-align: center; color: #718096; font-size: 12px;">
            <p>Terima kasih telah berbelanja di TokoKita.</p>
            <p>Invoice ini sah dan diproses oleh sistem.</p>
        </div>
    </div>
</body>
</html>
