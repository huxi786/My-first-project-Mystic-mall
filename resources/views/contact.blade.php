<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <!-- 10x Professional Custom CSS for Contact Page -->
    <style>
        :root {
            --lux-gold: #D4AF37;
            --lux-gold-light: #F3E5AB;
            --lux-purple-dark: #1A0B2E;
            --lux-purple: #2D1457;
            --lux-gray: #F8F9FA;
            --text-dark: #222;
        }

        body {
            background-color: var(--lux-gray);
        }

        /* Hero Section */
        .contact-hero {
            position: relative;
            background: linear-gradient(rgba(26, 11, 46, 0.85), rgba(45, 20, 87, 0.75)), url('https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?auto=format&fit=crop&q=80&w=1920');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 160px 0 100px;
            text-align: center;
        }

        .gold-divider {
            width: 80px;
            height: 3px;
            background-color: var(--lux-gold);
            margin: 25px auto;
        }

        /* Contact Info Cards */
        .info-card {
            background: #fff;
            border-radius: 4px;
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            z-index: 1;
            border-bottom: 3px solid transparent;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        }

        .info-card:hover {
            transform: translateY(-10px);
            border-bottom-color: var(--lux-gold);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            transition: all 0.4s ease;
        }

        .info-card:hover .icon-wrapper {
            background: var(--lux-gold);
        }

        .icon-wrapper i {
            font-size: 2rem;
            color: var(--lux-gold);
            transition: color 0.4s ease;
        }

        .info-card:hover .icon-wrapper i {
            color: #fff;
        }

        .info-title {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            color: var(--lux-purple-dark);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .info-text {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Form Area */
        .contact-form-wrapper {
            background: #fff;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.08);
            position: relative;
        }

        .contact-form-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--lux-gold);
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .form-title {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            color: var(--lux-purple-dark);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-control-lux {
            border: none;
            border-bottom: 1px solid #ddd;
            border-radius: 0;
            padding: 15px 0;
            background: transparent;
            color: var(--text-dark);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control-lux:focus {
            outline: none;
            box-shadow: none;
            border-bottom-color: var(--lux-gold);
            background: transparent;
        }

        .form-control-lux::placeholder {
            color: #aaa;
            font-weight: 300;
        }

        .btn-lux {
            background: var(--lux-purple-dark);
            color: #fff;
            padding: 15px 40px;
            border-radius: 0;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 1px solid var(--lux-purple-dark);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-lux::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: var(--lux-gold);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .btn-lux:hover {
            color: var(--lux-purple-dark);
            border-color: var(--lux-gold);
        }

        .btn-lux:hover::before {
            width: 100%;
        }

        /* Map Section */
        .map-section {
            height: 500px;
            width: 100%;
            background: #eee;
            position: relative;
            filter: grayscale(80%) contrast(120%);
            transition: filter 0.5s ease;
        }

        .map-section:hover {
            filter: grayscale(0%) contrast(100%);
        }

        .map-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Scroll Reveal Animation Classes */
        .reveal-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
    </style>

    <!-- 1. Hero Section -->
    <section class="contact-hero text-white">
        <div class="container position-relative z-index-1">
            <h5 class="text-white text-uppercase letter-spacing-2 fw-light mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 5px; color: var(--lux-gold) !important;">At Your Service</h5>
            <h1 class="display-2 fw-bold mb-3 animate__animated animate__zoomIn" style="font-family: 'Cinzel', serif; text-shadow: 2px 2px 15px rgba(0,0,0,0.8);">Contact Concierge</h1>
            <div class="gold-divider animate__animated animate__fadeInUp"></div>
            <p class="lead text-white font-weight-light animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.15rem; opacity: 0.85; max-width: 600px; margin: 0 auto;">
                Whether you seek styling advice, have inquiries about your order, or wish to arrange a private viewing, our dedicated team is here to assist you perfectly.
            </p>
        </div>
    </section>

    <!-- 2. Contact Information Cards -->
    <section class="py-5" style="margin-top: -60px; position: relative; z-index: 10;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <!-- Location -->
                <div class="col-lg-4 col-md-6 reveal-up">
                    <div class="info-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 class="info-title">The Flagship</h4>
                        <p class="info-text">
                            123 Mystic Avenue,<br>
                            Gulberg III, Lahore,<br>
                            Pakistan
                        </p>
                    </div>
                </div>
                <!-- Phone -->
                <div class="col-lg-4 col-md-6 reveal-up delay-100">
                    <div class="info-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h4 class="info-title">Direct Line</h4>
                        <p class="info-text" style="font-size: 1.1rem;">
                            <strong>+92 300 1234567</strong><br>
                            <span class="small text-muted">Mon-Sat: 10:00 AM - 8:00 PM</span><br>
                            <span class="small text-muted">Sunday: VIP Appointments Only</span>
                        </p>
                    </div>
                </div>
                <!-- Email -->
                <div class="col-lg-4 col-md-6 reveal-up delay-200">
                    <div class="info-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h4 class="info-title">Digital Correspondence</h4>
                        <p class="info-text">
                            <strong>Support:</strong> concierge@mysticmall.com<br>
                            <strong>Press:</strong> media@mysticmall.com<br>
                            <strong>Careers:</strong> join@mysticmall.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Contact Form & Image Section -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="row align-items-center g-0">
                <div class="col-lg-5 d-none d-lg-block reveal-up">
                    <div style="height: 600px; overflow: hidden; border-top-left-radius: 4px; border-bottom-left-radius: 4px; box-shadow: -20px 20px 50px rgba(0,0,0,0.1);">
                        <img src="https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&q=80&w=800" alt="Customer Service" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7 reveal-up delay-100">
                    <div class="contact-form-wrapper h-100" style="min-height: 600px; display: flex; flex-direction: column; justify-content: center;">
                        <span class="text-uppercase mb-2 d-block" style="color: var(--lux-gold); letter-spacing: 3px; font-weight: 600; font-size: 0.85rem;">Reach Out</span>
                        <h3 class="form-title">Send a Message</h3>
                        <p class="text-muted mb-5">Fill out the form below and our concierge team will respond within 24 hours.</p>

                        <form>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-lux" placeholder="First Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-lux" placeholder="Last Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control form-control-lux" placeholder="Email Address *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control form-control-lux" placeholder="Phone Number (Optional)">
                                </div>
                                <div class="col-12">
                                    <select class="form-select form-control-lux mb-0" style="border-bottom: 1px solid #ddd; border-top:none; border-left:none; border-right:none; border-radius:0;">
                                        <option selected disabled>Subject of Inquiry</option>
                                        <option value="order">Order Status/Tracking</option>
                                        <option value="product">Product Information</option>
                                        <option value="styling">Personal Styling Advice</option>
                                        <option value="returns">Returns & Exchanges</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control form-control-lux" rows="4" placeholder="Your Message *" required></textarea>
                                </div>
                                <div class="col-12 mt-5 text-end">
                                    <button type="submit" class="btn btn-lux w-100 w-md-auto">
                                        Send Inquiry <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Global Map Area -->
    <section class="map-section reveal-up">
        <!-- Google Maps Embed (Centered on a luxury aesthetic area or explicit location) -->
        <iframe class="map-iframe" 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13606.877843810237!2d74.3400589!3d31.5042835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919045a289dc645%3A0x6eac041cbf486d34!2sGulberg%20III%2C%20Lahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1684989065123!5m2!1sen!2s" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

    <!-- Initialize Scroll Reveal -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const revealElements = document.querySelectorAll('.reveal-up');
            
            const revealCallback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            };

            const revealObserver = new IntersectionObserver(revealCallback, {
                root: null,
                threshold: 0.15,
                rootMargin: "0px 0px -50px 0px"
            });

            revealElements.forEach(el => revealObserver.observe(el));
        });
    </script>
</x-app-layout>