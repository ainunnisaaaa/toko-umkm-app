<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\SalesSummary;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateSalesSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summary {--date= : The date to generate summary for (Y-m-d)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate daily sales summary for all stores and global platform';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateStr = $this->option('date');
        $targetDate = $dateStr ? Carbon::parse($dateStr)->toDateString() : Carbon::yesterday()->toDateString();

        $this->info("Generating sales summary for: {$targetDate}");

        // Get completed orders for the target date
        $ordersQuery = Order::where('status', 'Selesai')
            ->whereDate('created_at', $targetDate);

        // Calculate store-specific summaries
        $storeSummaries = (clone $ordersQuery)
            ->select('store_id', DB::raw('SUM(total_amount) as total_revenue'), DB::raw('COUNT(id) as total_orders'))
            ->groupBy('store_id')
            ->get();

        $storeCount = 0;
        foreach ($storeSummaries as $summary) {
            SalesSummary::updateOrCreate(
                ['store_id' => $summary->store_id, 'report_date' => $targetDate],
                [
                    'total_revenue' => $summary->total_revenue,
                    'total_orders' => $summary->total_orders,
                ]
            );
            $storeCount++;
        }

        // Calculate global platform summary
        $globalRevenue = (clone $ordersQuery)->sum('total_amount');
        $globalOrdersCount = (clone $ordersQuery)->count('id');

        SalesSummary::updateOrCreate(
            ['store_id' => null, 'report_date' => $targetDate],
            [
                'total_revenue' => $globalRevenue ?? 0,
                'total_orders' => $globalOrdersCount,
            ]
        );

        $this->info("Sales summary generated successfully for {$targetDate}. Processed {$storeCount} stores and global platform.");
    }
}
