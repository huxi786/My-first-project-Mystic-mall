<x-app-layout>
    <!-- Hero Section -->
    <div class="py-5" style="background-color: var(--primary-color); margin-top: 56px;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold text-white mb-3">Fast <span class="text-accent">Delivery</span></h1>
                    <p class="lead text-white-50">Swift, reliable, and trackable shipping services across Pakistan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- Timeline / Process -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="position-relative m-4">
                    <div class="progress" style="height: 2px; background: #e9ecef;">
                        <div class="progress-bar bg-accent" role="progressbar" style="width: 100%"></div>
                    </div>
                    <!-- Steps -->
                    <div class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-accent rounded-circle text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 2.5rem; height:2.5rem;">1</div>
                    <div class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-accent rounded-circle text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 2.5rem; height:2.5rem;">2</div>
                    <div class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-accent rounded-circle text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 2.5rem; height:2.5rem;">3</div>
                </div>
                <div class="row text-center text-dark">
                    <div class="col-4">
                        <h5 class="mt-4 fw-bold">Order Placed</h5>
                        <small class="text-muted">You confirm the order.</small>
                    </div>
                     <div class="col-4">
                        <h5 class="mt-4 fw-bold">Processing</h5>
                        <small class="text-muted">We pack it with care.</small>
                    </div>
                     <div class="col-4">
                        <h5 class="mt-4 fw-bold">Delivered</h5>
                        <small class="text-muted">At your doorstep.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Policies -->
        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="h-100 p-5 border-0 shadow-sm rounded-3 bg-white hover-shadow">
                    <h3 class="text-dark mb-3"><i class="fas fa-truck-moving text-primary me-2"></i> Shipping Times</h3>
                     <ul class="text-muted list-unstyled text-start d-inline-block">
                        <li class="mb-2"><strong class="text-dark">Lahore:</strong> 1-2 Working Days</li>
                        <li class="mb-2"><strong class="text-dark">Major Cities (Khi/Isb):</strong> 2-3 Working Days</li>
                        <li class="mb-2"><strong class="text-dark">Other Cities:</strong> 3-5 Working Days</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 border-0 shadow-sm rounded-3 bg-white hover-shadow">
                    <h3 class="text-dark mb-3"><i class="fas fa-tag text-primary me-2"></i> Shipping Costs</h3>
                    <ul class="text-muted list-unstyled text-start d-inline-block">
                        <li class="mb-2">Standard Delivery: <strong class="text-dark">Rs. 200</strong></li>
                        <li class="mb-2">Orders above Rs. 5000: <strong class="text-success fw-bold">FREE DELIVERY</strong></li>
                        <li class="mb-2"><small>No hidden charges.</small></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
