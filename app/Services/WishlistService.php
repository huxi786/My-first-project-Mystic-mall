<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    /**
     * Get all wishlist items for the authenticated user.
     */
    public function getUserWishlist()
    {
        return Auth::user()->wishlists()->with('product')->latest()->get();
    }

    /**
     * Toggle a product in the user's wishlist.
     */
    public function toggle(int $productId): array
    {
        $userId = Auth::id();
        $exists = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($exists) {
            $exists->delete();
            return ['status' => 'removed', 'message' => 'Removed from Wishlist'];
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return ['status' => 'added', 'message' => 'Added to Wishlist'];
    }

    /**
     * Remove a specific wishlist item by ID.
     */
    public function remove(int $id): void
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->firstOrFail()->delete();
    }
}
