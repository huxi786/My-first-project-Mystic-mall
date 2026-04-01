<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistToggleRequest;
use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    /**
     * Display a listing of personal wishlist items.
     */
    public function index()
    {
        $wishlists = $this->wishlistService->getUserWishlist();
        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * Toggle a product in/out of the user's wishlist.
     */
    public function toggle(WishlistToggleRequest $request)
    {
        $result = $this->wishlistService->toggle($request->product_id);
        return response()->json($result);
    }

    /**
     * Remove a product from the wishlist.
     */
    public function destroy($id)
    {
        $this->wishlistService->remove($id);
        return redirect()->back()->with('success', 'Product removed from wishlist.');
    }
}
