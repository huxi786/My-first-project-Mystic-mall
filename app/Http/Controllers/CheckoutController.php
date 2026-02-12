<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment; // Need Payment model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        return view('checkout.index', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required'
        ]);

        $cart = session()->get('cart');
        if(!$cart) {
             return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $total = 0;
            foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Create Payment Record
            $paymentId = \Illuminate\Support\Facades\DB::table('payments')->insertGetId([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'total_price' => $total,
                'tid' => $request->payment_method == 'cod' ? 'COD-' . time() : 'TXN-' . strtoupper(Str::random(10)),
                'payment_screenshot' => 'N/A',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'payment_id' => $paymentId,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'total_price' => $total,
                'tid' => $request->payment_method == 'cod' ? 'COD' : 'TXN-' . strtoupper(Str::random(10)),
                'status' => 'Pending'
            ]);

            // Create Order Items
            foreach($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => Auth::id(),
                    'user_name' => Auth::user()->name,
                    'payment_id' => $paymentId,
                    'product_name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'product_price' => $details['price']
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();

            // Clear Cart Session explicitly
            session()->forget('cart');
            session()->save();

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollback();
            return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
