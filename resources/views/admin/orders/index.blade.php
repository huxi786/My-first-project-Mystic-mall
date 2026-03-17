@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white border-0 py-3">
        <h5 class="mb-0 fw-bold">All Orders</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-bold">{{ $order->full_name ?? $order->user->name ?? 'Guest' }}</span>
                                <small class="text-muted">{{ $order->phone ?? '-' }}</small>
                            </div>
                        </td>
                        <td>
                            {{ $order->created_at->format('M d, Y') }}
                            <br>
                            <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                        </td>
                        <td class="fw-bold text-primary">
                            Rs. {{ number_format($order->total_price, 0) }}
                        </td>
                        <td>
                            @php
                                $statusColors = [
                                    'Pending' => 'warning',
                                    'Processing' => 'info',
                                    'Shipped' => 'primary',
                                    'Delivered' => 'success',
                                    'Cancelled' => 'danger',
                                ];
                                $color = $statusColors[$order->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $order->status }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-3"><i class="fas fa-shopping-bag fa-3x"></i></div>
                            <h5>No orders found</h5>
                            <p class="text-muted">Orders will appear here once customers make a purchase.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
