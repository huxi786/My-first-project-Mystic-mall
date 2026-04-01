<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    /**
     * Get all reviews (for admin).
     */
    public function getAllReviews()
    {
        return Review::with(['user', 'product'])->latest()->get();
    }

    /**
     * Store a new review for a product.
     */
    public function storeReview(Product $product, array $data): array
    {
        // Check if user already reviewed
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingReview) {
            return ['status' => 'error', 'message' => 'You have already reviewed this product.'];
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        return ['status' => 'success', 'message' => 'Your review has been submitted successfully.'];
    }

    /**
     * Delete a review.
     */
    public function deleteReview(int $id): bool
    {
        $review = Review::find($id);
        if ($review) {
            return $review->delete();
        }
        return false;
    }
}
