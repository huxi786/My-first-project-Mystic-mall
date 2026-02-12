<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $category = null;

        // Filter by Category
        if ($request->has('category')) {
            $category = $request->category;
            $query->where('category', $category);
        }

        // Filter by New Arrival (just an example logic, assuming 'New Arrivals' category or created_at)
        if ($request->has('new_arrival')) {
             $query->where('category', 'New Arrivals')->orWhere('created_at', '>=', now()->subDays(30));
        }

        // Search Logic
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('category', 'LIKE', "%{$searchTerm}%");
            });
            $category = 'Search Results for: "' . $searchTerm . '"';
        }

        $products = $query->get();
        
        $wishlistProductIds = [];
        if(\Illuminate\Support\Facades\Auth::check()) {
            $wishlistProductIds = \Illuminate\Support\Facades\Auth::user()->wishlists()->pluck('product_id')->toArray();
        }

        return view('home', compact('products', 'category', 'wishlistProductIds'));
    }

    public function quickView($id)
    {
        $product = Product::with(['reviews.user'])->findOrFail($id);
        
        // Related products logic
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
            
        $avgRating = $product->reviews->avg('rating');

        return response()->json([
            'status' => 'success',
            'product' => $product,
            'related_products' => $relatedProducts,
            'avg_rating' => round($avgRating, 1) ?? 0,
            'review_count' => $product->reviews->count()
        ]);
    }
}
