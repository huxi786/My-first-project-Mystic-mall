<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-5 fw-bold text-center animate__animated animate__fadeInDown">Checkout</h2>
        
        <div class="row justify-content-center animate__animated animate__fadeInUp">
            <div class="col-lg-8">
                <form action="{{ route('place.order') }}" method="POST">
                    @csrf
                    <!-- Billing Details -->
                    <div class="card card-custom shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Billing Details</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required placeholder="+92 300 1234567">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="3" required placeholder="Street address, Apartment, etc."></textarea>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card card-custom shadow-sm border-0 mb-4">
                         <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Payment Method</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label fw-bold" for="cod">
                                    Cash on Delivery (COD)
                                </label>
                                <div class="text-muted small ps-4">Pay securely when your order arrives.</div>
                            </div>
                            <!-- Future: Add Stripe/Card here -->
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="card card-custom shadow-sm border-0 mb-4 bg-light">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Order Summary</h5>
                            <ul class="list-group list-group-flush bg-transparent">
                                @php $total = 0; @endphp
                                @foreach($cart as $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                        <div>
                                            <span>{{ $details['name'] }}</span>
                                            <small class="text-muted d-block">x {{ $details['quantity'] }}</small>
                                        </div>
                                        <span>Rs. {{ number_format($details['price'] * $details['quantity']) }}</span>
                                    </li>
                                @endforeach
                                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0 fw-bold border-top mt-2 pt-3">
                                    <span>Total Amount</span>
                                    <span class="text-primary fs-5">Rs. {{ number_format($total) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-mystic btn-lg w-100 py-3">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
