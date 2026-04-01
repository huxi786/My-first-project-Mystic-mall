<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        return view('checkout.index', compact('cart'));
    }

    /**
     * Handle the order placement.
     */
    public function placeOrder(CheckoutRequest $request)
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        try {
            $order = $this->checkoutService->placeOrder($request->validated(), $cart);
            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
