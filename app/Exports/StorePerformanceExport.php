<?php

namespace App\Exports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StorePerformanceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Store::withCount('orders')
            ->withCount(['orders as completed_orders_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->orderBy('rating', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Toko',
            'Nama Toko',
            'Rating Rata-rata',
            'Total Pesanan',
            'Pesanan Selesai',
            'Persentase Penyelesaian (%)',
        ];
    }

    public function map($store): array
    {
        $percentage = $store->orders_count > 0 
            ? round(($store->completed_orders_count / $store->orders_count) * 100, 2) 
            : 0;

        return [
            $store->id,
            $store->name,
            $store->rating ?? 0,
            $store->orders_count,
            $store->completed_orders_count,
            $percentage . '%',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
