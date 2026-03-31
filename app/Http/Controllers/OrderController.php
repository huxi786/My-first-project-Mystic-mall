<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->with('items')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function downloadInvoice($id)
    {
        $order = Auth::user()->orders()->with('items')->findOrFail($id);
        
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
        
        return $pdf->download('invoice-order-'.$order->id.'.pdf');
    }

    public function previewInvoice($id)
    {
        $order = Auth::user()->orders()->with('items')->findOrFail($id);
        $isPreview = true;
        return view('admin.orders.invoice', compact('order', 'isPreview'));
    }
}
