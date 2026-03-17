<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <!-- 10x Professional Custom CSS -->
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

        /* Video Hero Section */
        .hero-video-wrapper {
            position: relative;
            height: 100vh;
            min-height: 600px;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: center;
            background: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80') center center / cover no-repeat;
        }

        .hero-video-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay for readability */
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            padding: 0 20px;
        }

        .brand-title {
            font-family: 'Cinzel', serif;
            font-size: 4.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #FFF, var(--lux-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0px 10px 30px rgba(0,0,0,0.5);
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .decorative-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }

        .line {
            height: 1px;
            width: 80px;
            background: linear-gradient(90deg, transparent, var(--lux-gold), transparent);
        }

        .diamond {
            width: 10px;
            height: 10px;
            background: var(--lux-gold);
            transform: rotate(45deg);
        }

        /* The Art of Gifting (Image + Text) */
        .story-section {
            padding: 120px 0;
            background: #fff;
            position: relative;
        }

        .image-composition {
            position: relative;
            height: 600px;
        }

        .img-main {
            position: absolute;
            top: 0;
            left: 0;
            width: 80%;
            height: 80%;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            z-index: 1;
        }

        .img-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60%;
            height: 60%;
            object-fit: cover;
            border: 15px solid #fff;
            border-radius: 4px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
            z-index: 2;
        }

        .section-subtitle {
            font-family: 'Cinzel', serif;
            color: var(--lux-gold);
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            color: var(--lux-purple-dark);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 30px;
        }

        .text-body-lux {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #555;
            font-weight: 300;
        }

        /* Stats Section with Parallax */
        .stats-parallax {
            position: relative;
            background: url('https://images.unsplash.com/photo-1542204165-65bf26472b9b?auto=format&fit=crop&q=80&w=1920') center center/cover fixed;
            padding: 100px 0;
        }

        .stats-parallax::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 11, 46, 0.85); /* Dark Purple Overlay */
        }

        .stat-card-lux {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 40px 20px;
            border: 1px solid rgba(212, 175, 55, 0.2); /* Gold border faint */
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
        }

        .stat-card-lux:hover {
            transform: translateY(-10px);
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .stat-number {
            font-family: 'Cinzel', serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--lux-gold);
            line-height: 1;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Excellence Pillars (Features) */
        .pillar-card {
            background: #fff;
            padding: 50px 40px;
            border-radius: 4px;
            text-align: center;
            height: 100%;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            z-index: 1;
        }

        .pillar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--lux-purple-dark);
            border-radius: 4px;
            opacity: 0;
            z-index: -1;
            transition: opacity 0.5s ease;
        }

        .pillar-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.1);
        }

        .pillar-card:hover::before {
            opacity: 1;
        }

        .pillar-icon {
            font-size: 3rem;
            color: var(--lux-gold);
            margin-bottom: 25px;
            transition: transform 0.5s ease;
        }

        .pillar-card:hover .pillar-icon {
            transform: scale(1.1);
        }

        .pillar-title {
            font-family: 'Cinzel', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
            transition: color 0.5s ease;
        }

        .pillar-text {
            color: #666;
            line-height: 1.7;
            transition: color 0.5s ease;
        }

        .pillar-card:hover .pillar-title,
        .pillar-card:hover .pillar-text {
            color: #fff;
        }

        /* Leadership Profiles */
        .team-section {
            background: var(--lux-purple-dark);
            padding: 120px 0;
        }

        .leadership-card {
            position: relative;
            border-radius: 4px;
            overflow: hidden;
            group: hover;
        }

        .leadership-img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            filter: grayscale(40%);
            transition: all 0.8s ease;
        }

        .leadership-card:hover .leadership-img {
            filter: grayscale(0%);
            transform: scale(1.05);
        }

        .leadership-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 40px 30px;
            background: linear-gradient(to top, rgba(26, 11, 46, 0.95), transparent);
            color: #fff;
            transform: translateY(20px);
            transition: transform 0.4s ease;
        }

        .leadership-card:hover .leadership-info {
            transform: translateY(0);
        }

        .leader-role {
            color: var(--lux-gold);
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }

        .leader-name {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .leader-socials {
            opacity: 0;
            transition: opacity 0.4s ease 0.1s;
        }

        .leadership-card:hover .leader-socials {
            opacity: 1;
        }

        .social-icon {
            color: #fff;
            font-size: 1.2rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .social-icon:hover {
            color: var(--lux-gold);
        }

        /* Scroll Reveal Animation Classes */
        .reveal-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
    </style>

    <!-- 1. Video Hero Section -->
    <section class="hero-video-wrapper text-center">
        <!-- Replaced video with static CSS background image -->
        <div class="hero-content">
            <h5 class="text-white text-uppercase letter-spacing-2 fw-light mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 5px;">Welcome To The Pinnacle</h5>
            <h1 class="brand-title animate__animated animate__fadeInUp">Mystic Mall</h1>
            <div class="decorative-line animate__animated animate__fadeIn">
                <div class="line"></div>
                <div class="diamond"></div>
                <div class="line"></div>
            </div>
            <p class="lead text-white font-weight-light animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.25rem; opacity: 0.85;">
                Redefining elegance since 2015. We curate the world's most exceptional products for those who refuse to compromise on quality and aesthetics.
            </p>
        </div>
    </section>

    <!-- 2. Brand Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 reveal-up">
                    <div class="image-composition">
                        <img src="https://images.unsplash.com/photo-1555529771-835f59fc5efe?auto=format&fit=crop&q=80&w=800" alt="Mystic Mall Quality" class="img-main">
                        <img src="https://images.unsplash.com/photo-1584916201218-f4242ceb4809?auto=format&fit=crop&q=80&w=800" alt="Premium Accessories" class="img-overlay">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 reveal-up delay-200">
                    <span class="section-subtitle">Our Heritage</span>
                    <h2 class="section-title">The Art of Curated Luxury</h2>
                    
                    <p class="text-body-lux mb-4">
                        Mystic Mall was born from a singular vision: to create a digital sanctuary where commerce meets art. We believe that shopping online shouldn't feel sterile or transactional—it should feel like stepping into a grand, exclusive boutique.
                    </p>
                    <p class="text-body-lux mb-5">
                        Every product in our collection—from bespoke timepieces to handcrafted leather goods—is meticulously selected. Our signature deep purple and gold palette isn't just a design choice; it is a promise of royalty-class service extended to every patron who walks through our digital doors.
                    </p>
                    
                    <a href="{{ route('products.index') }}" class="btn rounded-0 px-5 py-3 text-uppercase fw-bold" style="background: var(--lux-gold); color: var(--lux-purple-dark); letter-spacing: 2px;">
                        Explore Collection <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Parallax Counters Section -->
    <section class="stats-parallax" id="counter-trigger">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-lg-3 reveal-up">
                    <div class="stat-card-lux">
                        <div class="stat-number"><span class="premium-counter" data-target="15000">0</span>+</div>
                        <div class="stat-label">Exquisite Items</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 reveal-up delay-100">
                    <div class="stat-card-lux">
                        <div class="stat-number"><span class="premium-counter" data-target="85">0</span>k</div>
                        <div class="stat-label">Global Patrons</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 reveal-up delay-200">
                    <div class="stat-card-lux">
                        <div class="stat-number"><span class="premium-counter" data-target="99">0</span>%</div>
                        <div class="stat-label">Client Satisfaction</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 reveal-up delay-300">
                    <div class="stat-card-lux">
                        <div class="stat-number"><span class="premium-counter" data-target="42">0</span></div>
                        <div class="stat-label">Awards Won</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Pillars of Excellence -->
    <section class="py-5" style="background: var(--lux-gray); padding-top: 120px !important; padding-bottom: 120px !important;">
        <div class="container">
            <div class="text-center mb-5 reveal-up">
                <span class="section-subtitle">Our Promise</span>
                <h2 class="section-title">Pillars of Excellence</h2>
                <div class="decorative-line mx-auto">
                    <div class="line"></div><div class="diamond"></div><div class="line"></div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 reveal-up">
                    <div class="pillar-card">
                        <i class="fas fa-crown pillar-icon"></i>
                        <h4 class="pillar-title">Uncompromising Authenticity</h4>
                        <p class="pillar-text">We guarantee the absolute authenticity of every piece in our collection. Sourced directly from artisans and master crafters globally.</p>
                    </div>
                </div>
                <div class="col-lg-4 reveal-up delay-100">
                    <div class="pillar-card">
                        <i class="fas fa-gem pillar-icon"></i>
                        <h4 class="pillar-title">White-Glove Delivery</h4>
                        <p class="pillar-text">Your acquisitions are treated with the utmost respect. We utilize insured, climate-controlled, express global logistics.</p>
                    </div>
                </div>
                <div class="col-lg-4 reveal-up delay-200">
                    <div class="pillar-card">
                        <i class="fas fa-key pillar-icon"></i>
                        <h4 class="pillar-title">Private Concierge</h4>
                        <p class="pillar-text">Experience personalized shopping. Our concierges are available 24/7 to assist with sourcing, sizing, and styling advisory.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Leadership / Team -->
    <section class="team-section">
        <div class="container">
            <div class="row align-items-end mb-5 pb-3 reveal-up">
                <div class="col-lg-6">
                    <span class="section-subtitle text-white">The Minds Behind The Magic</span>
                    <h2 class="section-title text-white mb-0" style="color: #fff !important;">Visionary Leadership</h2>
                </div>
                <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                    <p class="text-white-50 mb-0" style="font-size: 1.1rem; line-height: 1.6;">Driven by an obsession for perfection, our founders bridge the gap between classic retail heritage and modern digital innovation.</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-5 reveal-up delay-100">
                    <div class="leadership-card">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80" alt="Alex Mystic" class="leadership-img">
                        <div class="leadership-info">
                            <span class="leader-role">Founder & Chief Executive</span>
                            <h3 class="leader-name">Alexander Mystic</h3>
                            <div class="leader-socials">
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="far fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 reveal-up delay-200">
                    <div class="leadership-card">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80" alt="Eleanor Vance" class="leadership-img">
                        <div class="leadership-info">
                            <span class="leader-role">Global Creative Director</span>
                            <h3 class="leader-name">Eleanor Vance</h3>
                            <div class="leader-socials">
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // 1. Scroll Reveal Animation Logic
            const revealElements = document.querySelectorAll('.reveal-up');
            
            const revealCallback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: Stop observing once revealed
                        observer.unobserve(entry.target);
                    }
                });
            };

            const revealObserver = new IntersectionObserver(revealCallback, {
                root: null,
                threshold: 0.15, // Trigger when 15% is visible
                rootMargin: "0px 0px -50px 0px"
            });

            revealElements.forEach(el => revealObserver.observe(el));

            // 2. High-Performance Number Counter
            const counters = document.querySelectorAll('.premium-counter');
            let hasAnimated = false;

            const animateCounters = () => {
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    const duration = 2000; // Total animation time in ms
                    const startTime = performance.now();
                    const startValue = 0;

                    const step = (currentTime) => {
                        const elapsedTime = currentTime - startTime;
                        const progress = Math.min(elapsedTime / duration, 1);
                        
                        // Easing function (easeOutQuart) for premium smooth slow-down effect
                        const easeOut = 1 - Math.pow(1 - progress, 4);
                        
                        const currentVal = Math.floor(easeOut * (target - startValue) + startValue);
                        counter.innerText = currentVal;

                        if (progress < 1) {
                            requestAnimationFrame(step);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    requestAnimationFrame(step);
                });
            };

            const statsSection = document.getElementById('counter-trigger');
            if (statsSection) {
                const counterObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !hasAnimated) {
                            animateCounters();
                            hasAnimated = true;
                            counterObserver.disconnect();
                        }
                    });
                }, { threshold: 0.4 });
                
                counterObserver.observe(statsSection);
            }
        });
    </script>
</x-app-layout>
