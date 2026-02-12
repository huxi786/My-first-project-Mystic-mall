<x-app-layout>
    <!-- Dark Hero Section -->
    <div class="py-5" style="background-color: var(--primary-color); margin-top: 56px;">
        <div class="container py-5">
            <div class="row justification-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold text-white mb-3">Premium <span class="text-accent">Support</span></h1>
                    <p class="lead text-white-50">We are here to help you 24/7. Your satisfaction is our priority.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Light Content Section -->
    <div class="container py-5">
        <div class="row g-4 mt-n5 position-relative" style="top: -50px;">
            <!-- Contact Options Cards -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-shadow">
                    <div class="mb-3 text-primary"><i class="fas fa-phone-alt fa-3x"></i></div>
                    <h4 class="text-dark">Call Us</h4>
                    <p class="text-muted">Speak directly to our support team.</p>
                    <a href="tel:+923217079965" class="btn btn-outline-primary rounded-pill">+92 321 7079965</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-shadow">
                    <div class="mb-3 text-primary"><i class="fas fa-envelope fa-3x"></i></div>
                    <h4 class="text-dark">Email Us</h4>
                    <p class="text-muted">Send us your queries anytime.</p>
                    <a href="mailto:mysticmall@gmail.com" class="btn btn-outline-primary rounded-pill">mysticmall@gmail.com</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center hover-shadow">
                    <div class="mb-3 text-primary"><i class="fas fa-comments fa-3x"></i></div>
                    <h4 class="text-dark">Live Chat</h4>
                    <p class="text-muted">Chat with our agents instantly.</p>
                    <button class="btn btn-outline-primary rounded-pill">Start Chat</button>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-dark mb-4 border-bottom pb-2">Frequently Asked Questions</h2>
                
                <div class="accordion accordion-flush" id="faqAccordion">
                    <div class="accordion-item bg-transparent border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How do I track my order?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                You can track your order by visiting the "My Orders" section in your profile or using the tracking ID sent to your email.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item bg-transparent border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                What is your return policy?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                We offer a 7-day return policy for defective or incorrect items. Please contact support within 7 days of delivery.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item bg-transparent border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark shadow-none fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Do you ship internationally?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Currently, we only ship within Pakistan. Adding international shipping soon!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
