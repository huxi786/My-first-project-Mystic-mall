<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return response()->json($products);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with('images', 'reviews.user')->findOrFail($id);
        return response()->json($product);
    }

    /**
     * Display a listing of categories.
     */
    public function categories()
    {
        $categories = Product::select('category')->distinct()->get()->pluck('category');
        return response()->json($categories);
    }
}
