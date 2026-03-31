@extends('layouts.admin')

@section('title', 'Order Management')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Poppins:wght@300;400;600&display=swap');

    .lux-card {
        background: #fff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .lux-table-header {
        background: linear-gradient(135deg, #2e0249 0%, #1a002b 100%);
        padding: 25px 30px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .lux-table-title {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        margin: 0;
        letter-spacing: 2px;
        font-size: 1.5rem;
    }

    .table-premium {
        margin-bottom: 0;
    }

    .table-premium thead th {
        background: #f8f9fa;
        color: #666;
        font-family: 'Cinzel', serif;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 20px 25px;
        border: none;
    }

    .table-premium tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f2f2f2;
        font-family: 'Poppins', sans-serif;
        color: #444;
    }

    .order-id {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #2e0249;
    }

    .customer-name {
        font-weight: 600;
        color: #333;
        display: block;
    }

    .customer-sub {
        font-size: 0.75rem;
        color: #888;
    }

    .price-text {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #2e0249;
    }

    .badge-lux {
        padding: 8px 15px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Action Buttons Redesign */
    .action-container {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: center;
    }

    .btn-lux-action {
        width: 130px;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .btn-view-lux {
        background: rgba(46, 2, 73, 0.05);
        color: #2e0249;
        border-color: rgba(46, 2, 73, 0.1);
    }

    .btn-view-lux:hover {
        background: #2e0249;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(46, 2, 73, 0.2);
    }

    .btn-invoice-lux {
        background: rgba(212, 175, 55, 0.05);
        color: #a3892c;
        border-color: rgba(212, 175, 55, 0.2);
    }

    .btn-invoice-lux:hover {
        background: #D4AF37;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
    }

    .pagination-wrapper {
        padding: 20px 30px;
        background: #fff;
    }
</style>

<div class="lux-card">
    <div class="lux-table-header">
        <h2 class="lux-table-title">Order Repository</h2>
        <div class="badge bg-white text-dark rounded-pill px-3 py-2 fw-bold">
            <i class="fas fa-box-open me-2 text-primary"></i> Total Orders: {{ $orders->total() }}
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-premium align-middle">
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Customer Details</th>
                    <th>Date & Time</th>
                    <th>Total Value</th>
                    <th>Status</th>
                    <th class="text-center">Operations</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><span class="order-id">#{{ $order->id }}</span></td>
                    <td>
                        <span class="customer-name">{{ $order->full_name ?? $order->user->name ?? 'Guest' }}</span>
                        <span class="customer-sub"><i class="fas fa-phone-alt me-1"></i> {{ $order->phone ?? '-' }}</span>
                    </td>
                    <td>
                        <div class="fw-bold small">{{ $order->created_at->format('d M, Y') }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">{{ $order->created_at->format('h:i A') }}</div>
                    </td>
                    <td>
                        <span class="price-text">Rs. {{ number_format($order->total_price) }}</span>
                    </td>
                    <td>
                        @php
                            $statusMap = [
                                'Pending' => ['bg' => 'rgba(255, 193, 7, 0.1)', 'color' => '#ffc107'],
                                'Processing' => ['bg' => 'rgba(23, 162, 184, 0.1)', 'color' => '#17a2b8'],
                                'Shipped' => ['bg' => 'rgba(46, 2, 73, 0.1)', 'color' => '#2e0249'],
                                'Delivered' => ['bg' => 'rgba(25, 135, 84, 0.1)', 'color' => '#198754'],
                                'Cancelled' => ['bg' => 'rgba(220, 53, 69, 0.1)', 'color' => '#dc3545'],
                            ];
                            $style = $statusMap[$order->status] ?? ['bg' => '#f2f2f2', 'color' => '#666'];
                        @endphp
                        <span class="badge-lux" style="background: {{ $style['bg'] }}; color: {{ $style['color'] }};">
                            <i class="fas fa-circle me-1" style="font-size: 6px;"></i> {{ $order->status }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="action-container">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-lux-action btn-view-lux">
                                <i class="fas fa-eye"></i> View Detail
                            </a>
                            <a href="{{ route('admin.orders.invoice.preview', $order->id) }}" class="btn-lux-action btn-invoice-lux">
                                <i class="fas fa-file-invoice"></i> Get Invoice
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="mb-3"><i class="fas fa-shopping-bag fa-4x text-light"></i></div>
                        <h4 class="text-muted fw-bold">No Records Found</h4>
                        <p class="text-muted small">Your order repository is currently empty.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $orders->links() }}
    </div>
</div>
@endsection
