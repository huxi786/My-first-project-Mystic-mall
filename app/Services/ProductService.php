<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    /**
     * Get paginated products with category and search filters.
     */
    public function getFilteredProducts(Request $request): array
    {
        $query = Product::query();
        $displayCategory = null;

        // Fetch Flash Sale Products (Separate from main query for component)
        $flashSaleProducts = Product::where('is_flash_deal', true)
            ->where('flash_deal_end', '>', now())
            ->where('stock', '>', 0)
            ->take(4)
            ->get();

        // Filter by Category
        if ($request->has('category')) {
            $displayCategory = $request->category;
            $query->where('category', $request->category);
        }

        // Filter by Flash Sale
        if ($request->has('flash_sale')) {
            $query->where('is_flash_deal', true)
                  ->where('flash_deal_end', '>', now());
        }

        // Filter by New Arrival
        if ($request->has('new_arrival')) {
            $query->where('category', 'New Arrivals')
                  ->orWhere('created_at', '>=', now()->subDays(30));
        }

        // Search Logic
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('category', 'LIKE', "%{$searchTerm}%");
            });
            $displayCategory = 'Search Results for: "' . $searchTerm . '"';
        }

        $products = $query->paginate(12)->withQueryString();

        return [
            'products' => $products,
            'category' => $displayCategory,
            'flashSaleProducts' => $flashSaleProducts,
            'wishlistProductIds' => $this->getUserWishlistIds()
        ];
    }

    /**
     * Get related products for a specific product.
     */
    public function getRelatedProducts(Product $product, int $limit = 4)
    {
        return Product::where('category', $product->category)
                      ->where('id', '!=', $product->id)
                      ->take($limit)
                      ->get();
    }

    /**
     * Get wishlist product IDs for the authenticated user.
     */
    private function getUserWishlistIds(): array
    {
        if (Auth::check()) {
            return Auth::user()->wishlists()->pluck('product_id')->toArray();
        }
        return [];
    }
}
