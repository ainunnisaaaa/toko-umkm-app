<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Optional: Implement if buyers can see list of their own reviews
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, \App\Services\ReviewService $reviewService)
    {
        $order_id = $request->query('order_id');
        $product_id = $request->query('product_id');

        if (!$order_id || !$product_id) {
            abort(404);
        }

        $eligibility = $reviewService->validateReviewEligibility($order_id, $product_id, auth()->id());

        if (!$eligibility['status']) {
            if ($eligibility['code'] === 409) {
                return redirect()->route('products.show', $product_id)->with('error', $eligibility['message']);
            }
            abort($eligibility['code'], $eligibility['message']);
        }

        $order = $eligibility['order'];
        $product = Product::findOrFail($product_id);

        return view('buyer.reviews.create', compact('order', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, \App\Services\ReviewService $reviewService)
    {
        $validated = $request->validated();
        
        try {
            $reviewService->createReview($validated, auth()->id());
        } catch (\Exception $e) {
            abort($e->getCode() ?: 403, $e->getMessage());
        }

        return redirect()->route('products.show', $validated['product_id'])
            ->with('success', 'Ulasan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
