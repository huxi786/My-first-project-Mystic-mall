<x-app-layout>
    <div class="container py-5" style="margin-top: 50px;">
        <h2 class="mb-5 fw-bold text-center" style="color: var(--primary-color);">Secure Checkout</h2>
        
        <div class="row g-4 justify-content-center">
            <!-- Left Column: Billing Details & Payment -->
            <div class="col-lg-7">
                <form action="{{ route('place.order') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <!-- Billing Form -->
                    <div class="card card-custom shadow-sm border-0 mb-4 overflow-hidden">
                        <div class="card-header border-0 py-3 text-white" style="background: var(--primary-color);">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <span class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 25px; height: 25px; font-size: 0.9rem;">1</span>
                                Shipping & Billing Details
                            </h5>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label text-muted small fw-bold">FULL NAME <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" class="form-control pro-input-light" value="{{ Auth::user()->name }}" required placeholder="John Doe">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">PHONE NUMBER <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control pro-input-light" required placeholder="0300 1234567">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">POSTAL/ZIP CODE <span class="text-danger">*</span></label>
                                    <input type="text" name="postal_code" class="form-control pro-input-light" required placeholder="Ex: 54000">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-muted small fw-bold">COMPLETE ADDRESS <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control pro-input-light custom-scrollbar" rows="3" required placeholder="Street address, Apartment, Suite, building, district, etc."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card card-custom shadow-sm border-0 mb-4 overflow-hidden">
                         <div class="card-header border-0 py-3 text-white" style="background: var(--primary-color);">
                            <h5 class="mb-0 fw-bold d-flex align-items-center">
                                <span class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 25px; height: 25px; font-size: 0.9rem;">2</span>
                                Payment Method
                            </h5>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <!-- COD Option -->
                            <div class="payment-option border rounded p-3 mb-3 d-flex align-items-center active-payment" style="border-color: var(--accent-color) !important; background-color: rgba(255, 200, 0, 0.05);">
                                <div class="form-check w-100 m-0">
                                    <input class="form-check-input mt-1" type="radio" name="payment_method" id="cod" value="cod" checked>
                                    <label class="form-check-label w-100 ms-2" for="cod">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark">Cash on Delivery (COD)</h6>
                                                <small class="text-muted">Pay securely with cash when your package arrives.</small>
                                            </div>
                                            <i class="fas fa-money-bill-wave text-success fs-4"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Future Payment Providers (Disabled) -->
                            <div class="payment-option border rounded p-3 text-muted" style="opacity: 0.6;">
                                <div class="d-flex justify-content-between align-items-center ms-4 ps-2">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Credit/Debit Card (Coming Soon)</h6>
                                        <small>Pay instantly via Visa/Mastercard.</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <i class="fab fa-cc-visa fs-4"></i>
                                        <i class="fab fa-cc-mastercard fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-block d-lg-none mb-4">
                        <button type="submit" class="btn btn-luxury-cart w-100 rounded-pill py-3 px-4 shadow-lg">
                            <span>Place Secure Order</span>
                            <i class="fas fa-lock btn-icon"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Order Summary (Sticky) -->
            <div class="col-lg-5">
                <div class="card card-custom shadow-sm border-0 sticky-top" style="top: 100px; z-index: 10; background: #fdfdfd;">
                    <div class="card-body p-0">
                        <div class="p-4 bg-light border-bottom">
                            <h5 class="fw-bold mb-0">Order Summary <span class="badge bg-mystic ms-2">{{ count($cart) }} Items</span></h5>
                        </div>
                        
                        <div class="p-4 custom-scrollbar" style="max-height: 350px; overflow-y: auto;">
                            <ul class="list-unstyled mb-0">
                                @php $total = 0; @endphp
                                @foreach($cart as $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <li class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="d-flex align-items-center w-75">
                                            <div class="position-relative me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                                                @if(isset($details['image']))
                                                    <img src="{{ Str::startsWith($details['image'], 'http') ? $details['image'] : asset('uploads/' . $details['image']) }}" class="img-fluid rounded border" style="object-fit:cover; width:100%; height:100%;" alt="">
                                                @else
                                                    <div class="w-100 h-100 bg-light rounded border d-flex align-items-center justify-content-center"><i class="fas fa-box text-muted"></i></div>
                                                @endif
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill border bg-secondary bg-opacity-75" style="font-size: 0.65rem;">
                                                    {{ $details['quantity'] }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-truncate" style="max-width: 150px; font-size: 0.9rem;">{{ $details['name'] }}</h6>
                                            </div>
                                        </div>
                                        <span class="fw-bold" style="font-size: 0.95rem;">Rs. {{ number_format($details['price'] * $details['quantity']) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-4 bg-light border-top border-bottom">
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>Subtotal</span>
                                <span class="fw-bold">Rs. {{ number_format($total) }}</span>
                            </div>
                            <div class="d-flex justify-content-between text-muted">
                                <span>Shipping</span>
                                <span class="fw-bold text-success">Free</span>
                            </div>
                        </div>

                        <div class="p-4 pb-2">
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <span class="fw-bold fs-5">Total Return</span>
                                <span class="fw-bold fs-3" style="color: var(--primary-color);">Rs. {{ number_format($total) }}</span>
                            </div>
                        </div>
                        
                        <div class="p-4 pt-3 d-none d-lg-block">
                            <!-- Desktop submit button that triggers the main form -->
                            <button type="button" class="btn btn-luxury-cart w-100 rounded-pill py-3 px-4 shadow-lg" onclick="document.getElementById('checkout-form').submit();">
                                <span>Place Secure Order</span>
                                <i class="fas fa-lock btn-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
