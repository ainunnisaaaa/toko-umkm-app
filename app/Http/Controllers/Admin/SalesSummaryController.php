<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesSummary;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SalesSummary::with('store')->orderBy('report_date', 'desc');

        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        $salesSummaries = $query->paginate(10)->withQueryString();
        return view('admin.sales_summaries.index', compact('salesSummaries'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesSummary $salesSummary)
    {
        $salesSummary->load('store');
        return view('admin.sales_summaries.show', compact('salesSummary'));
    }
    /**
     * Export PDF report
     */
    public function exportPdf(Request $request)
    {
        $query = SalesSummary::with('store')->orderBy('report_date', 'desc');

        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        $salesSummaries = $query->get();
        $pdf = Pdf::loadView('pdf.sales-summaries', compact('salesSummaries'));
        return $pdf->download('laporan-rekap-penjualan.pdf');
    }
}
