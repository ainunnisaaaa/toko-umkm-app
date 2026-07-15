<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Order::with(['user', 'store'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Toko',
            'Pembeli',
            'Tanggal Transaksi',
            'Status',
            'Subtotal',
            'Ongkos Kirim',
            'Total Nominal',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->store->name ?? '-',
            $order->user->name ?? '-',
            $order->created_at->format('Y-m-d H:i:s'),
            ucfirst($order->status),
            $order->subtotal,
            $order->shipping_cost,
            $order->total_amount,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
