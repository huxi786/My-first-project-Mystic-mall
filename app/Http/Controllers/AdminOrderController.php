<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    protected $adminService;
    protected $orderService;

    public function __construct(AdminService $adminService, OrderService $orderService)
    {
        $this->adminService = $adminService;
        $this->orderService = $orderService;
    }

    /**
     * Display all orders for admin.
     */
    public function index()
    {
        $orders = $this->adminService->getAllOrders();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details.
     */
    public function show($id)
    {
        $order = $this->adminService->getOrder($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled'
        ]);

        $this->adminService->updateOrderStatus($id, $request->status);

        return back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Download order invoice.
     */
    public function downloadInvoice($id)
    {
        $order = $this->adminService->getOrder($id);
        return $this->orderService->generateInvoice($order);
    }

    /**
     * Preview order invoice.
     */
    public function previewInvoice($id)
    {
        $order = $this->adminService->getOrder($id);
        $isPreview = true;
        return view('admin.orders.invoice', compact('order', 'isPreview'));
    }
}
