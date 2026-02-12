<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <section class="mystic-hero text-center reveal">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Cinzel', serif;">Our Legacy</h1>
            <p class="lead text-white-50">Redefining the digital shopping experience since 2015.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 reveal">
                    <div class="position-relative">
                        <div style="background: var(--color-primary); border-radius: 20px; overflow: hidden; height: 400px;">
                            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80" alt="Our Office" style="width:100%; height:100%; object-fit:cover; opacity: 0.8;">
                        </div>
                        <div class="bg-white p-4 shadow rounded position-absolute bottom-0 start-0 m-4" style="border-left: 5px solid var(--color-accent);">
                            <h5 class="fw-bold m-0 text-dark">Est. 2015</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5 reveal reveal-delay-2">
                    <h2 class="section-header ms-0">We Are Mystic Mall</h2>
                    <p class="text-muted mb-4">
                        Mystic Mall isn't just an ecommerce store; it's a curated experience. We started with a simple belief: 
                        that shopping should be as magical as the products you buy.
                    </p>
                    <p class="text-muted mb-4">
                        From a small garage startup to a global leader, our palette of <strong>Deep Purple and Gold</strong> represents 
                        our commitment to royalty-class service for every customer.
                    </p>
                    
                    <div class="row mt-4">
                        <div class="col-6 mb-3">
                            <i class="fas fa-check-circle me-2" style="color: var(--color-accent);"></i> Premium Quality
                        </div>
                        <div class="col-6 mb-3">
                            <i class="fas fa-check-circle me-2" style="color: var(--color-accent);"></i> 24/7 Support
                        </div>
                        <div class="col-6 mb-3">
                            <i class="fas fa-check-circle me-2" style="color: var(--color-accent);"></i> Fast Delivery
                        </div>
                        <div class="col-6 mb-3">
                            <i class="fas fa-check-circle me-2" style="color: var(--color-accent);"></i> Secure Payment
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 text-white" style="background-color: var(--color-primary-light);">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0 reveal">
                    <h2 class="fw-bold display-4" style="color: var(--color-accent);">10k+</h2>
                    <p class="mb-0">Premium Products</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0 reveal reveal-delay-1">
                    <h2 class="fw-bold display-4" style="color: var(--color-accent);">50k+</h2>
                    <p class="mb-0">Happy Customers</p>
                </div>
                <div class="col-md-4 reveal reveal-delay-2">
                    <h2 class="fw-bold display-4" style="color: var(--color-accent);">99%</h2>
                    <p class="mb-0">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5 reveal">
                <h2 class="section-header">Meet The Visionaries</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4 reveal">
                    <div class="card border-0 shadow-sm h-100 text-center p-4 hover-card" style="transition: 0.3s;">
                        <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--color-accent); overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&q=80" alt="Alex Mystic" class="w-100 h-100 object-fit-cover">
                        </div>
                        <h5 class="fw-bold text-dark">Alex Mystic</h5>
                        <p class="text-muted small">Founder & CEO</p>
                        <div class="mt-3">
                            <a href="#" class="text-dark mx-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-dark mx-2"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
