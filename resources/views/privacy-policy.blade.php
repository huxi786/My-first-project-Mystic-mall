<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Privacy Policy') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <section class="mystic-hero text-center reveal">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Cinzel', serif;">Privacy Policy</h1>
            <p class="lead text-white-50">Your trust is our most valuable asset.</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="reveal delay-1">
                        <p class="lead text-muted mb-5 text-center">
                            At Mystic Mall, we are committed to protecting your privacy and ensuring the security of your personal information. 
                            This policy outlines how we collect, use, and safeguard your data.
                        </p>
                    </div>

                    <div class="row g-5">
                        <!-- Navigation (Sticky Sidebar for large screens) -->
                        <div class="col-md-4 d-none d-md-block">
                            <div class="sticky-top" style="top: 100px;">
                                <div class="list-group list-group-flush border-start border-3" style="border-color: var(--color-accent) !important;">
                                    <a href="#collection" class="list-group-item list-group-item-action border-0 ps-3 bg-transparent text-dark fw-bold">1. Information Collection</a>
                                    <a href="#usage" class="list-group-item list-group-item-action border-0 ps-3 bg-transparent text-muted">2. How We Use Data</a>
                                    <a href="#sharing" class="list-group-item list-group-item-action border-0 ps-3 bg-transparent text-muted">3. Information Sharing</a>
                                    <a href="#security" class="list-group-item list-group-item-action border-0 ps-3 bg-transparent text-muted">4. Data Security</a>
                                    <a href="#cookies" class="list-group-item list-group-item-action border-0 ps-3 bg-transparent text-muted">5. Cookies & Tracking</a>
                                    <a href="#rights" class="list-group-item list-group-item-action border-0 ps-3 bg-transparent text-muted">6. Your Rights</a>
                                </div>
                            </div>
                        </div>

                        <!-- Policy Text -->
                        <div class="col-md-8">
                            
                            <div id="collection" class="mb-5 reveal">
                                <h3 class="section-header ms-0 mb-4" style="font-size: 1.75rem;">1. Information Collection</h3>
                                <p class="text-muted">We collect information that you provide directly to us when you make a purchase, create an account, or contact our support team. This includes:</p>
                                <ul class="text-muted mb-4">
                                    <li class="mb-2"><strong>Personal Identification:</strong> Name, email address, phone number, and shipping/billing address.</li>
                                    <li class="mb-2"><strong>Payment Information:</strong> Credit card details and billing information (processed securely by our payment partners).</li>
                                    <li class="mb-2"><strong>Account Credentials:</strong> Username and password for your Mystic Mall account.</li>
                                </ul>
                            </div>

                            <div id="usage" class="mb-5 reveal">
                                <h3 class="section-header ms-0 mb-4" style="font-size: 1.75rem;">2. How We Use Data</h3>
                                <p class="text-muted">We use the information we collect to provide, maintain, and improve our services, such as:</p>
                                <ul class="text-muted mb-4">
                                    <li class="mb-2">Process transactions and send related information including confirmations and receipts.</li>
                                    <li class="mb-2">Send you technical notices, updates, security alerts, and support and administrative messages.</li>
                                    <li class="mb-2">Respond to your comments, questions, and requests, and provide customer service.</li>
                                    <li class="mb-2">Analyze trends, usage, and activities in connection with our services.</li>
                                </ul>
                            </div>

                            <div id="sharing" class="mb-5 reveal">
                                <h3 class="section-header ms-0 mb-4" style="font-size: 1.75rem;">3. Information Sharing</h3>
                                <p class="text-muted">We do not share your personal information with third parties except in the following limited circumstances:</p>
                                <ul class="text-muted mb-4">
                                    <li class="mb-2"><strong>Service Providers:</strong> We may share data with vendors, consultants, and other service providers who need access to such information to carry out work on our behalf (e.g., shipping partners, payment processors).</li>
                                    <li class="mb-2"><strong>Legal Compliance:</strong> We may disclose information if we believe disclosure is in accordance with, or required by, any applicable law or legal process.</li>
                                </ul>
                            </div>

                            <div id="security" class="mb-5 reveal">
                                <h3 class="section-header ms-0 mb-4" style="font-size: 1.75rem;">4. Data Security</h3>
                                <p class="text-muted">
                                    We take reasonable measures to help protect information about you from loss, theft, misuse, and unauthorized access, disclosure, alteration, and destruction. All payment transactions are encrypted using SSL technology.
                                </p>
                            </div>

                            <div id="cookies" class="mb-5 reveal">
                                <h3 class="section-header ms-0 mb-4" style="font-size: 1.75rem;">5. Cookies & Tracking</h3>
                                <p class="text-muted">
                                    We use cookies and similar tracking technologies to track the activity on our service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                                </p>
                            </div>

                            <div id="rights" class="mb-5 reveal">
                                <h3 class="section-header ms-0 mb-4" style="font-size: 1.75rem;">6. Your Rights</h3>
                                <p class="text-muted">
                                    Depending on your location, you may have rights regarding your personal information, including the right to access, correct, or delete your personal data. To exercise these rights, please contact us at <a href="mailto:privacy@mysticmall.com" style="color: var(--color-accent);">privacy@mysticmall.com</a>.
                                </p>
                            </div>

                            <div class="mt-5 pt-5 border-top">
                                <p class="text-muted small">
                                    Last Updated: January 25, 2026 <br>
                                    Mystic Mall Inc.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
