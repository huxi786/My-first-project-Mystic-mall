<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $quantity = $request->input('quantity', 1);

        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $quantity;
        } else {
            $cart[$request->product_id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cartCount' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function showCart()
    {
        return view('cart.index');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            
            $subtotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];
            $total = 0;
            foreach($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }

            return response()->json([
                'success' => true, 
                'subtotal' => $subtotal, 
                'total' => $total,
                'message' => 'Cart updated successfully'
            ]);
        }
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Product removed successfully');
    }
}
