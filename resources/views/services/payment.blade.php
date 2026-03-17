<x-app-layout>
    <!-- Hero Section -->
    <div class="py-5" style="background-color: var(--primary-color); margin-top: 56px;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold text-white mb-3">Secure <span class="text-accent">Payment</span></h1>
                    <p class="lead text-white-50">Your transactions are safe, encrypted, and secure with us.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- Security Features -->
        <div class="row g-4 align-items-center mb-5 mt-n5 position-relative" style="top: -30px;">
            <div class="col-md-6">
                <div class="p-5 border-0 shadow-sm rounded-3 bg-white h-100 hover-shadow">
                    <div class="text-primary mb-3"><i class="fas fa-lock fa-3x"></i></div>
                    <h3 class="text-dark">SSL Encryption</h3>
                    <p class="text-muted">
                        Our website is secured with 256-bit SSL encryption. This ensures that any data you enter, including personal details and payment information, is transmitted securely and cannot be intercepted by third parties.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 border-0 shadow-sm rounded-3 bg-white h-100 hover-shadow">
                    <div class="text-primary mb-3"><i class="fas fa-shield-alt fa-3x"></i></div>
                    <h3 class="text-dark">Data Protection</h3>
                    <p class="text-muted">
                        We strictly adhere to data protection regulations. We do not store your credit card details on our servers. All payment processing is handled by certified payment gateways.
                    </p>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <h2 class="text-dark mb-4 text-center mt-5">Accepted Payment Methods</h2>
        <div class="row g-4 justify-content-center text-center">
            <div class="col-md-3 col-6">
                <div class="p-4 border rounded bg-white shadow-sm hover-shadow">
                    <i class="fas fa-money-bill-wave fa-3x text-success mb-3"></i>
                    <h5 class="text-dark">Cash on Delivery</h5>
                    <p class="text-muted small">Pay when you receive.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 border rounded bg-white shadow-sm hover-shadow">
                    <i class="fab fa-cc-visa fa-3x text-primary mb-3"></i>
                    <h5 class="text-dark">Visa</h5>
                    <p class="text-muted small">Secure card payment.</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 border rounded bg-white shadow-sm hover-shadow">
                    <i class="fab fa-cc-mastercard fa-3x text-danger mb-3"></i>
                    <h5 class="text-dark">MasterCard</h5>
                    <p class="text-muted small">Secure card payment.</p>
                </div>
            </div>
             <div class="col-md-3 col-6">
                <div class="p-4 border rounded bg-white shadow-sm hover-shadow">
                    <i class="fas fa-wallet fa-3x text-info mb-3"></i>
                    <h5 class="text-dark">EasyPaisa / JazzCash</h5>
                    <p class="text-muted small">Mobile wallets supported.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
