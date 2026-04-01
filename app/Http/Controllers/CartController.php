<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->input('quantity', 1);

        $cart = $this->cartService->add($productId, $quantity);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cartCount' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Show the cart view.
     */
    public function showCart()
    {
        return view('cart.index');
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $updatedCart = $this->cartService->update($request->id, $request->quantity);

            if ($updatedCart['success']) {
                return response()->json([
                    'success' => true,
                    'subtotal' => $updatedCart['subtotal'],
                    'total' => $updatedCart['total'],
                    'message' => 'Cart updated successfully'
                ]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Cart update failed'], 400);
    }

    /**
     * Remove a product from the cart.
     */
    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $this->cartService->remove($request->id);
        }

        return redirect()->back()->with('success', 'Product removed successfully');
    }
}
