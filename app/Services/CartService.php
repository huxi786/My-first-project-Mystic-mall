<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get the current cart from session.
     */
    public function getCart(): array
    {
        return session()->get('cart', []);
    }

    /**
     * Add a product to the cart.
     */
    public function add(int $productId, int $quantity = 1): array
    {
        $product = Product::findOrFail($productId);
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $effectivePrice = ($product->is_flash_deal && $product->flash_deal_end > now()) 
                ? $product->discount_price 
                : $product->price;

            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $effectivePrice,
                "original_price" => $product->price,
                "is_flash" => ($product->is_flash_deal && $product->flash_deal_end > now()),
                "image" => $product->image
            ];
        }

        $this->saveCart($cart);
        return $cart;
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(int $productId, int $quantity): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]["quantity"] = $quantity;
            $this->saveCart($cart);
            
            return [
                'success' => true,
                'subtotal' => $cart[$productId]['price'] * $cart[$productId]['quantity'],
                'total' => $this->getTotal($cart)
            ];
        }

        return ['success' => false];
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(int $productId): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->saveCart($cart);
        }
    }

    /**
     * Calculate the total price of the cart.
     */
    public function getTotal(array $cart = null): float
    {
        $cart = $cart ?? $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    /**
     * Save the cart back to session.
     */
    private function saveCart(array $cart): void
    {
        session()->put('cart', $cart);
    }
}
