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
    public function create(Request $request)
    {
        $order_id = $request->query('order_id');
        $product_id = $request->query('product_id');

        if (!$order_id || !$product_id) {
            abort(404);
        }

        $order = Order::findOrFail($order_id);
        $product = Product::findOrFail($product_id);

        // Ensure the order belongs to the buyer and is completed
        if ($order->user_id !== auth()->id() || $order->status !== 'Selesai') {
            abort(403, 'Order is not eligible for review.');
        }

        // Check if review already exists
        $existingReview = Review::where('order_id', $order_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingReview) {
            return redirect()->route('products.show', $product_id)->with('error', 'Anda sudah memberikan ulasan untuk produk ini pada pesanan tersebut.');
        }

        return view('buyer.reviews.create', compact('order', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();
        
        $order = Order::findOrFail($validated['order_id']);
        if ($order->user_id !== auth()->id() || $order->status !== 'Selesai') {
            abort(403, 'Order is not eligible for review.');
        }

        $validated['user_id'] = auth()->id();
        
        Review::create($validated);

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
