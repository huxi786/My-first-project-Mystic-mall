<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderService
{
    /**
     * Get paginated orders for the authenticated user.
     */
    public function getUserOrders(int $perPage = 10)
    {
        return Auth::user()->orders()->latest()->paginate($perPage);
    }

    /**
     * Get a specific order with items for the user.
     */
    public function getUserOrder(int $id): Order
    {
        return Auth::user()->orders()->with('items')->findOrFail($id);
    }

    /**
     * Generate a PDF invoice for an order.
     */
    public function generateInvoice(Order $order)
    {
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
        return $pdf->download('invoice-order-'.$order->id.'.pdf');
    }
}
