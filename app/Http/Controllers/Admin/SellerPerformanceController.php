<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerPerformanceController extends Controller
{
    public function index(Request $request)
    {
        // Get performance for the last 3 months
        $threeMonthsAgo = Carbon::now()->subMonths(3)->startOfMonth();

        // Omzet (total revenue) per store
        $performances = Store::select(
                'stores.id',
                'stores.name',
                DB::raw('COALESCE(SUM(orders.total_amount), 0) as total_omzet'),
                DB::raw('COUNT(orders.id) as total_orders')
            )
            ->leftJoin('orders', function($join) use ($threeMonthsAgo) {
                $join->on('stores.id', '=', 'orders.store_id')
                     ->where('orders.status', '=', 'Selesai')
                     ->where('orders.created_at', '>=', $threeMonthsAgo);
            })
            ->groupBy('stores.id', 'stores.name')
            ->orderBy('total_omzet', 'desc')
            ->get();

        // Prepare chart data
        $chartLabels = $performances->pluck('name')->toJson();
        $chartData = $performances->pluck('total_omzet')->toJson();

        return view('admin.seller-performance.index', compact('performances', 'chartLabels', 'chartData'));
    }
}
