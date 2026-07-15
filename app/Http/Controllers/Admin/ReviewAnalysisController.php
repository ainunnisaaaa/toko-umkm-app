<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReviewAnalysisController extends Controller
{
    public function index()
    {
        // 1. Tabel rata-rata rating per produk
        $productRatings = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_avg_rating')
            ->get();

        // 2. Bar chart distribusi rating (1-5) untuk semua produk
        $ratingDistributionData = Review::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();
        
        // Memastikan rating 1-5 ada dalam array
        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDistribution[$i] = $ratingDistributionData[$i] ?? 0;
        }

        // 3. Daftar ulasan terbaru yang perlu dimoderasi admin
        $latestReviews = Review::with(['user', 'product'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.reviews.analysis', compact('productRatings', 'ratingDistribution', 'latestReviews'));
    }
}
