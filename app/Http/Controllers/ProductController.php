<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SearchHistory;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $data = $this->productService->getFilteredProducts($request);
        return view('home', $data);
    }

    /**
     * Show quick view data for a product.
     */
    public function quickView($id)
    {
        $product = Product::with(['reviews.user'])->findOrFail($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        $avgRating = $product->reviews->avg('rating');

        return response()->json([
            'status' => 'success',
            'product' => $product,
            'related_products' => $relatedProducts,
            'avg_rating' => round($avgRating, 1) ?? 0,
            'review_count' => $product->reviews->count()
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with(['reviews' => function($q) {
            $q->latest();
        }, 'reviews.user', 'images'])->findOrFail($id);
        
        $avgRating = $product->reviews->avg('rating');
        
        $userReview = null;
        if (Auth::check()) {
            $userReview = $product->reviews->where('user_id', Auth::id())->first();
        }

        return view('product-details', compact('product', 'avgRating', 'userReview'));
    }

    /**
     * AJAX Autocomplete Search
     */
    public function autocomplete(Request $request)
    {
        $query = $request->get('q');
        if (!$query) return response()->json([]);

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->take(6)
            ->get(['id', 'name', 'price', 'image', 'category']);

        return response()->json($products);
    }

    /**
     * Get Search History for current user.
     */
    public function getSearchHistory()
    {
        if (Auth::check()) {
            $history = SearchHistory::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->pluck('query');
            return response()->json($history);
        }
        return response()->json([]);
    }

    /**
     * Save search term to history.
     */
    public function saveSearchTerm(Request $request)
    {
        $query = $request->get('q');
        if (!$query) return response()->json(['status' => 'ignored']);

        if (Auth::check()) {
            $history = SearchHistory::firstOrNew([
                'user_id' => Auth::id(),
                'query' => trim($query)
            ]);
            $history->hit_count += 1;
            $history->save();
        }

        return response()->json(['status' => 'success']);
    }
}
