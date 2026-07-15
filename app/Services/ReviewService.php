<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewService
{
    /**
     * Validate if a user is eligible to review a product from a specific order.
     *
     * @param int $orderId
     * @param int $productId
     * @param int $userId
     * @return array Returns an array with 'status' (bool), 'message' (string), and optionally 'order' and 'product'
     */
    public function validateReviewEligibility(int $orderId, int $productId, int $userId): array
    {
        try {
            $order = Order::findOrFail($orderId);
        } catch (ModelNotFoundException $e) {
            return ['status' => false, 'message' => 'Pesanan tidak ditemukan.', 'code' => 404];
        }

        if ($order->user_id !== $userId || $order->status !== 'Selesai') {
            return ['status' => false, 'message' => 'Pesanan tidak memenuhi syarat untuk diulas.', 'code' => 403];
        }

        $existingReview = Review::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            return ['status' => false, 'message' => 'Anda sudah memberikan ulasan untuk produk ini pada pesanan tersebut.', 'code' => 409];
        }

        return ['status' => true, 'order' => $order];
    }

    /**
     * Handle business logic for creating a new review.
     *
     * @param array $data Validated review data
     * @param int $userId ID of the user submitting the review
     * @return Review
     * @throws Exception
     */
    public function createReview(array $data, int $userId): Review
    {
        $eligibility = $this->validateReviewEligibility($data['order_id'], $data['product_id'], $userId);
        
        if (!$eligibility['status']) {
            throw new Exception($eligibility['message'], $eligibility['code']);
        }

        $data['user_id'] = $userId;
        return Review::create($data);
    }
}
