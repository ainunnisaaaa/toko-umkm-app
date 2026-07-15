<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $data = [];

        $role = strtolower($user->role);

        if ($role === 'admin') {
            $data['total_users'] = User::count();
            $data['total_stores'] = Store::count();
            $data['total_products'] = Product::count();
            $data['total_orders'] = Order::count();
            $data['recent_users'] = User::latest()->take(5)->get();
            $data['recent_stores'] = Store::with('user')->latest()->take(5)->get();
            $data['recent_orders'] = Order::with('user')->latest()->take(5)->get();

            // Chart Data: Revenue Last 7 Days
            $revenueData = Order::where('status', 'Selesai')
                ->where('created_at', '>=', Carbon::now()->subDays(7)->startOfDay())
                ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            $data['chart_revenue_labels'] = $revenueData->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d M'))->toJson();
            $data['chart_revenue_data'] = $revenueData->pluck('total')->toJson();

            // Chart Data: Order Status Distribution
            $statusData = Order::selectRaw('status, count(*) as count')->groupBy('status')->get();
            $data['chart_status_labels'] = $statusData->pluck('status')->map(fn($status) => ucfirst($status))->toJson();
            $data['chart_status_data'] = $statusData->pluck('count')->toJson();

            // Chart Data: Top 10 Products
            $topProducts = \App\Models\OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'Selesai')
                ->groupBy('product_id')
                ->orderBy('total_sold', 'desc')
                ->take(10)
                ->with('product')
                ->get();
            $data['chart_top_products_labels'] = $topProducts->map(fn($item) => \Illuminate\Support\Str::limit($item->product->name ?? 'Unknown', 20))->toJson();
            $data['chart_top_products_data'] = $topProducts->pluck('total_sold')->toJson();
        } elseif ($role === 'seller') {
            $store = $user->store;
            if ($store) {
                $data['total_products'] = $store->products()->count();
                $data['total_orders'] = $store->orders()->count();
                $data['total_revenue'] = $store->orders()->where('status', 'Selesai')->sum('total_amount');

                // Chart Data: Revenue Last 7 Days
                $revenueData = $store->orders()->where('status', 'Selesai')
                    ->where('created_at', '>=', Carbon::now()->subDays(7)->startOfDay())
                    ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
                $data['chart_revenue_labels'] = $revenueData->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d M'))->toJson();
                $data['chart_revenue_data'] = $revenueData->pluck('total')->toJson();

                // Chart Data: Order Status Distribution
                $statusData = $store->orders()->selectRaw('status, count(*) as count')->groupBy('status')->get();
                $data['chart_status_labels'] = $statusData->pluck('status')->map(fn($status) => ucfirst($status))->toJson();
                $data['chart_status_data'] = $statusData->pluck('count')->toJson();
            } else {
                $data['total_products'] = 0;
                $data['total_orders'] = 0;
                $data['total_revenue'] = 0;
            }
        } elseif ($role === 'buyer') {
            $data['total_orders'] = $user->orders()->count();
            $data['total_wishlists'] = $user->wishlists()->count();
            $data['total_carts'] = $user->carts()->count();
        }

        return view('dashboard', compact('data'));
    }
}
