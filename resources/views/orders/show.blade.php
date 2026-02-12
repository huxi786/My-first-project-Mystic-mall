<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate__animated animate__fadeInUp">
                <!-- Back Link -->
                <a href="{{ route('orders.index') }}" class="text-decoration-none text-muted mb-4 d-inline-block">
                    <i class="fas fa-arrow-left me-2"></i> Back to Orders
                </a>

                <!-- Order Status Card -->
                <div class="card card-custom shadow-sm border-0 mb-4 overflow-hidden">
                    <div class="card-header bg-mystic text-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Order #{{ $order->id }}</h5>
                        <span class="badge bg-white text-dark">{{ $order->status }}</span>
                    </div>
                    <div class="card-body p-4">
                        <!-- Progress Tracker -->
                        @if($order->status != 'Cancelled')
                        <div class="position-relative m-4">
                            <div class="progress" style="height: 4px;">
                                @php
                                    $progress = 0;
                                    if($order->status == 'Pending') $progress = 10;
                                    if($order->status == 'Processing') $progress = 40;
                                    if($order->status == 'Shipped') $progress = 70;
                                    if($order->status == 'Delivered') $progress = 100;
                                @endphp
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            
                            <div class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-{{ $progress >= 0 ? 'warning' : 'secondary' }} rounded-pill" style="width: 2rem; height:2rem;">1</div>
                            <div class="position-absolute top-0 start-33 translate-middle btn btn-sm btn-{{ $progress >= 40 ? 'warning' : 'secondary' }} rounded-pill" style="width: 2rem; height:2rem; left: 33%;">2</div>
                            <div class="position-absolute top-0 start-66 translate-middle btn btn-sm btn-{{ $progress >= 70 ? 'warning' : 'secondary' }} rounded-pill" style="width: 2rem; height:2rem; left: 66%;">3</div>
                            <div class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-{{ $progress >= 100 ? 'success' : 'secondary' }} rounded-pill" style="width: 2rem; height:2rem;">4</div>

                            <div class="d-flex justify-content-between mt-2 pt-2 text-muted small fw-bold">
                                <span>Placed</span>
                                <span>Processing</span>
                                <span>Shipped</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                        @else
                            <div class="alert alert-danger text-center">
                                <i class="fas fa-times-circle me-2"></i> This order has been cancelled.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Details -->
                <div class="card card-custom shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Order Items</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $item->product_name }}</span>
                                        </td>
                                        <td>Rs. {{ number_format($item->product_price, 0) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end fw-bold">Rs. {{ number_format($item->product_price * $item->quantity, 0) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="border-top">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Grand Total</td>
                                        <td class="text-end fw-bold text-primary fs-5">Rs. {{ number_format($order->total_price, 0) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Shipping Address</h6>
                                <p class="text-muted mb-0">
                                    {{ $order->full_name }}<br>
                                    {{ $order->address }}<br>
                                    {{ $order->postal_code }}<br>
                                    {{ $order->phone }}
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h6 class="fw-bold">Payment Info</h6>
                                <p class="text-muted mb-0">
                                    Method: Online/COD<br>
                                    Transaction ID: <span class="badge bg-light text-dark border">{{ $order->tid ?? 'N/A' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
