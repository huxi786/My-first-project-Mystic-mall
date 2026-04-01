<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutService
{
    /**
     * Process the order placement.
     */
    public function placeOrder(array $data, array $cart): Order
    {
        return DB::transaction(function () use ($data, $cart) {
            $total = $this->calculateTotal($cart);
            $userId = Auth::id();
            $userName = Auth::user()->name;

            // Generate Transaction ID
            $tid = ($data['payment_method'] == 'cod') 
                ? 'COD-' . time() 
                : 'TXN-' . strtoupper(Str::random(10));

            // 1. Create Payment Record (Using DB table directly as per original code)
            $paymentId = DB::table('payments')->insertGetId([
                'user_id' => $userId,
                'user_name' => $userName,
                'full_name' => $data['full_name'],
                'phone_number' => $data['phone'],
                'address' => $data['address'],
                'postal_code' => $data['postal_code'],
                'total_price' => $total,
                'tid' => $tid,
                'payment_screenshot' => 'N/A',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Create Order
            $order = Order::create([
                'user_id' => $userId,
                'user_name' => $userName,
                'payment_id' => $paymentId,
                'full_name' => $data['full_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'postal_code' => $data['postal_code'],
                'total_price' => $total,
                'tid' => $tid,
                'status' => 'Pending'
            ]);

            // 3. Create Order Items
            foreach ($cart as $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $userId,
                    'user_name' => $userName,
                    'payment_id' => $paymentId,
                    'product_name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'product_price' => $details['price']
                ]);
            }

            // 4. Clear Cart Session
            session()->forget('cart');
            session()->save();

            return $order;
        });
    }

    /**
     * Calculate total price from cart items.
     */
    private function calculateTotal(array $cart): float
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
