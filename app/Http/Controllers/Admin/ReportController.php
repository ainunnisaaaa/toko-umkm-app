<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Exports\TransactionsExport;
use App\Exports\StorePerformanceExport;
use App\Exports\PlatformCommissionsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Laporan 3: Top 10 Produk Terlaris
     */
    public function topProductsPdf(Request $request)
    {
        // Ambil top 10 produk berdasarkan jumlah quantity yang terjual pada pesanan berstatus completed
        $products = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->limit(10)
            ->with('store')
            ->get();

        $pdf = Pdf::loadView('pdf.top-products', compact('products'));
        return $pdf->download('laporan-top-10-produk-terlaris.pdf');
    }

    /**
     * Laporan 5: Detail Transaksi & Omset (Excel)
     */
    public function transactionsExcel(Request $request)
    {
        return Excel::download(new TransactionsExport, 'laporan-detail-transaksi.xlsx');
    }

    /**
     * Laporan 7: Kinerja / Rating Toko (Excel)
     */
    public function storePerformanceExcel(Request $request)
    {
        return Excel::download(new StorePerformanceExport, 'laporan-kinerja-toko.xlsx');
    }

    /**
     * Laporan 9: Potongan Pendapatan / Komisi Platform (Excel)
     */
    public function platformCommissionsExcel(Request $request)
    {
        return Excel::download(new PlatformCommissionsExport, 'laporan-komisi-platform.xlsx');
    }
}
