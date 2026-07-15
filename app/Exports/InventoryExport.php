<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $storeId;

    public function __construct($storeId = null)
    {
        $this->storeId = $storeId;
    }

    public function collection()
    {
        $query = Product::with(['category', 'store'])->orderBy('name', 'asc');
        
        if ($this->storeId) {
            $query->where('store_id', $this->storeId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID Produk',
            'Toko',
            'Kategori',
            'Nama Produk',
            'Harga Dasar',
            'Harga Diskon',
            'Sisa Stok',
            'Status Aktif',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->store->name ?? '-',
            $product->category->name ?? '-',
            $product->name,
            $product->base_price,
            $product->discount_price ?? 0,
            $product->stock,
            $product->is_active ? 'Ya' : 'Tidak',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
