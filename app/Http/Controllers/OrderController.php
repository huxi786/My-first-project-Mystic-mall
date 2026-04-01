<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of personal orders.
     */
    public function index()
    {
        $orders = $this->orderService->getUserOrders();
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order details.
     */
    public function show($id)
    {
        $order = $this->orderService->getUserOrder($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Download a PDF invoice for an order.
     */
    public function downloadInvoice($id)
    {
        $order = $this->orderService->getUserOrder($id);
        return $this->orderService->generateInvoice($order);
    }

    /**
     * Preview an invoice in the browser.
     */
    public function previewInvoice($id)
    {
        $order = $this->orderService->getUserOrder($id);
        $isPreview = true;
        return view('admin.orders.invoice', compact('order', 'isPreview'));
    }
}
