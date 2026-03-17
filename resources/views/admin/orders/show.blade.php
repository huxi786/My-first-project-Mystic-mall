@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <!-- Order Summary & Items -->
    <div class="col-lg-8">
        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">Order #{{ $order->id }} Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Placeholder image since we don't have product_id linked yet -->
                                        <div class="bg-light rounded p-2 me-3 text-muted">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block">{{ $item->product_name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Rs. {{ number_format($item->product_price, 0) }}</td>
                                <td>x {{ $item->quantity }}</td>
                                <td class="text-end fw-bold">
                                    Rs. {{ number_format($item->product_price * $item->quantity, 0) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Grand Total</td>
                                <td class="text-end fw-bold text-primary fs-5">
                                    Rs. {{ number_format($order->total_price, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Details & Status -->
    <div class="col-lg-4">
        <!-- Status Card -->
        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">Order Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small">Current Status</label>
                        <select name="status" class="form-select border-mystic">
                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary-mystic w-100">Update Status</button>
                </form>
            </div>
        </div>

        <!-- Customer Card -->
        <div class="card card-custom">
             <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">Customer Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small d-block">Customer Name</label>
                    <span class="fw-bold">{{ $order->full_name ?? $order->user->name ?? 'Guest' }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">Phone</label>
                    <span>{{ $order->phone ?? '-' }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">Shipping Address</label>
                    <p class="mb-0">{{ $order->address }}</p>
                    <small class="text-muted">{{ $order->postal_code }}</small>
                </div>
                 <div class="mb-3">
                    <label class="text-muted small d-block">Transaction ID</label>
                    <span class="badge bg-light text-dark border">{{ $order->tid ?? $order->transaction_id ?? 'COD' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
