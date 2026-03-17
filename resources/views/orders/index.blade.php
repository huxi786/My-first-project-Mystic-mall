<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-center animate__animated animate__fadeInDown">My Orders</h2>
        
        <div class="row justify-content-center animate__animated animate__fadeInUp">
            <div class="col-lg-10">
                <div class="card card-custom shadow-sm border-0">
                    <div class="card-body p-4">
                        @if($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="fw-bold">#{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td class="fw-bold text-primary">Rs. {{ number_format($order->total_price, 0) }}</td>
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
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-mystic">
                                                        Track Order
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3 text-muted">
                                    <i class="fas fa-shopping-bag fa-4x"></i>
                                </div>
                                <h4>No orders yet</h4>
                                <p class="text-muted">Once you place an order, it will appear here.</p>
                                <a href="{{ url('/products') }}" class="btn btn-mystic mt-3">Start Shopping</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
