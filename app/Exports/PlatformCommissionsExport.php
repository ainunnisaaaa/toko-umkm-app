<?php

namespace App\Exports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlatformCommissionsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Store::withSum(['orders as total_revenue' => function ($query) {
                $query->where('status', 'completed');
            }], 'total_amount')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Toko',
            'Nama Toko',
            'Total Pendapatan (Pesanan Selesai)',
            'Komisi Platform (2%)',
        ];
    }

    public function map($store): array
    {
        $revenue = $store->total_revenue ?? 0;
        $commission = $revenue * 0.02;

        return [
            $store->id,
            $store->name,
            $revenue,
            $commission,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
