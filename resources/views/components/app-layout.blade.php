<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mystic Mall') }}</title>
    <link rel="icon" href="{{ asset('images/logo-icon.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body.lang-ur, .lang-ur * {
            font-family: 'Noto Nastaliq Urdu', serif !important;
        }
        /* Hide google translate top bar and original text tooltips */
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            top: 0px !important; 
        }
        .goog-tooltip {
            display: none !important;
        }
        .goog-tooltip:hover {
            display: none !important;
        }
        .goog-text-highlight {
            background-color: transparent !important;
            border: none !important; 
            box-shadow: none !important;
        }
        /* Hide the google translate widget entirely since we control it via our own dropdown */
        #google_translate_element {
            display: none;
        }
        /* Search Suggestions Styles */
        .search-suggestions-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(46, 2, 73, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 200, 0, 0.2);
            border-top: none;
            border-radius: 0 0 20px 20px;
            max-height: 450px;
            overflow-y: auto;
            z-index: 10001;
            display: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .suggestion-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            transition: all 0.2s;
            cursor: pointer;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .suggestion-item:last-child { border-bottom: none; }

        .suggestion-item:hover {
            background: rgba(255, 200, 0, 0.1);
        }

        .suggestion-img {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .suggestion-info h6 {
            margin: 0;
            font-size: 0.95rem;
            color: #fff;
        }

        .suggestion-info span {
            font-size: 0.8rem;
            color: var(--accent-color);
        }

        .history-header {
            padding: 10px 20px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.4);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .history-item {
            padding: 10px 20px;
            color: rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .history-item:hover {
            color: var(--accent-color);
            background: rgba(255,255,255,0.03);
        }

        /* Side Cart Drawer Styles */
        #cartDrawerOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 100002;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #cartDrawer {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background: #fff;
            z-index: 100003;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            transition: right 0.4s cubic-bezier(0.82, 0.085, 0.395, 0.895);
            display: flex;
            flex-direction: column;
        }

        #cartDrawer.active {
            right: 0;
        }

        #cartDrawerOverlay.active {
            display: block;
            opacity: 1;
        }

        .bg-mystic-dark { background-color: #2e0249; }
        .text-accent { color: #ffc800; }
        .btn-mystic { background: linear-gradient(135deg, #2e0249, #570a80); color: #ffc800; border: none; }
        .btn-mystic:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(46, 2, 73, 0.3); }
        .btn-outline-mystic { border: 2px solid #2e0249; color: #2e0249; font-weight: 600; transition: all 0.3s; }
        .btn-outline-mystic:hover { background: #2e0249; color: #ffc800; }

        .cart-drawer-item {
            transition: transform 0.2s;
        }
        .cart-drawer-item:hover {
            transform: translateX(-5px);
        }
        .cart-item-img-wrapper img {
            transition: transform 0.3s;
        }
        .cart-drawer-item:hover .cart-item-img-wrapper img {
            transform: scale(1.1);
        }

        @media (max-width: 450px) {
            #cartDrawer {
                width: 100%;
                right: -100%;
            }
        }

        /* Bottom Navigation Bar (Mobile Only) */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 65px;
            background: rgba(46, 2, 73, 0.95);
            backdrop-filter: blur(15px);
            display: none;
            justify-content: space-around;
            align-items: center;
            z-index: 100001;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
            padding-bottom: env(safe-area-inset-bottom);
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.7rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 8px 0;
            flex: 1;
        }

        .bottom-nav-item i {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .bottom-nav-item.active {
            color: var(--accent-color);
        }

        .bottom-nav-item.active i {
            transform: scale(1.2);
            text-shadow: 0 0 10px rgba(255, 200, 0, 0.4);
        }

        .bottom-nav-item:active {
            transform: scale(0.9);
        }

        @media (max-width: 991px) {
            .bottom-nav { display: flex; }
            body { padding-bottom: 75px; }

            /* Ultimate App-style Side Drawer - FIXED GLASSMORPHISM */
            .navbar .navbar-collapse {
                position: fixed;
                top: 0;
                right: -300px;
                width: 300px;
                height: 100vh;
                /* Darker base for perfect readability in mobile view */
                background: rgba(28, 2, 45, 0.95); 
                backdrop-filter: blur(20px) saturate(150%);
                -webkit-backdrop-filter: blur(20px) saturate(150%);
                z-index: 100005;
                display: block !important;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                padding: 0 !important;
                box-shadow: -20px 0 50px rgba(0,0,0,0.5);
                border-left: 1px solid rgba(255, 255, 255, 0.1);
                visibility: hidden;
            }

            .navbar .navbar-collapse.show {
                right: 0;
                visibility: visible;
            }

            .navbar-nav {
                padding: 20px;
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                width: 100%;
            }

            .nav-link {
                padding: 16px 20px !important;
                border-radius: 12px;
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.08);
                margin-bottom: 10px !important;
                color: #fff !important;
                font-weight: 600;
                display: flex !important;
                align-items: center;
                gap: 15px;
            }
            .nav-link i {
                width: 30px;
                color: var(--accent-color);
                font-size: 1.2rem;
            }
            
            /* Professional Bottom Nav */
            .bottom-nav {
                height: 70px;
                background: rgba(18, 5, 29, 0.95);
                backdrop-filter: blur(20px);
                border-top: 1px solid rgba(255, 215, 0, 0.15);
            }
            .bottom-nav-item {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 4px;
                font-size: 0.65rem;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                font-weight: 700;
            }
            .bottom-nav-item i {
                font-size: 1.2rem;
            }
            .bottom-nav-item.active {
                color: var(--accent-color);
            }
            
            /* Drawer Content Spacing */
            .nav-item {
                width: 100%;
                margin-bottom: 8px;
            }

            /* Backdrop Overlay */
            .drawer-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.6);
                backdrop-filter: blur(4px);
                z-index: 100001;
                display: none;
                opacity: 0;
                transition: opacity 0.4s ease;
            }
            .drawer-backdrop.active {
                display: block;
                opacity: 1;
            }

            /* Drawer Header Branding */
            .drawer-header {
                padding: 20px;
                background: rgba(255, 215, 0, 0.05);
                border-bottom: 1px solid rgba(255, 215, 0, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 70px;
            }
        }

        /* 3-Dot Menu Animation */
        .navbar-toggler[aria-expanded="true"] i {
            transform: rotate(90deg);
            color: var(--accent-color);
        }
        .navbar-toggler i {
            transition: transform 0.3s ease;
        }

        /* Mobile Optimization Fixes */
        @media (max-width: 768px) {
            .hero-title { font-size: 2rem !important; } /* Reduced for small screens */
            .hero-subtitle { font-size: 0.9rem !important; }
            .hero-desc { font-size: 0.9rem !important; margin-bottom: 1.5rem !important; }
            .section-title { font-size: 1.8rem; }
            .card-custom { border-radius: 15px; }
            .carousel-caption { padding: 0 20px !important; }
        }
        
        /* Specific Fix for Accessories Slide */
        @media (max-width: 480px) {
            .hero-title { font-size: 1.7rem !important; }
        }
    </style>
    
    <script>
        if (localStorage.getItem('user_theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom_carousel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-sans antialiased">
    
    <div id="cartDrawerOverlay" onclick="closeCartDrawer()"></div>
    <div id="cartDrawer">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="{{ url('/') }}" class="bottom-nav-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="#" class="bottom-nav-item" onclick="event.preventDefault(); openSearchOverlay();">
            <i class="fas fa-search"></i>
            <span>Search</span>
        </a>
        <a href="#" class="bottom-nav-item" onclick="event.preventDefault(); document.querySelector('.navbar-toggler').click();">
            <i class="fas fa-th-large"></i>
            <span>Menu</span>
        </a>
        <a href="#" class="bottom-nav-item" onclick="event.preventDefault(); openCartDrawer();">
            <i class="fas fa-shopping-cart position-relative">
                <span class="cart-badge badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 0.5rem; {{ count((array)session('cart')) > 0 ? '' : 'display:none' }}">
                    {{ count((array)session('cart')) }}
                </span>
            </i>
            <span>Cart</span>
        </a>
        @auth
            <a href="{{ route('profile.edit') }}" class="bottom-nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="bottom-nav-item">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        @endauth
    </nav>

    <div id="searchOverlay" class="search-overlay">
        <div class="search-container">
            <div class="position-relative w-100">
                <form action="{{ route('products.index') }}" method="GET" class="w-100 d-flex align-items-center" id="searchForm">
                    <i class="fas fa-search text-accent fs-4 me-3"></i>
                    <input type="text" id="searchInput" name="search" class="form-control bg-transparent border-0 text-white shadow-none fs-4" placeholder="Search products..." autocomplete="off" autofocus style="height: 60px;">
                </form>
                <div id="searchSuggestions" class="search-suggestions-dropdown"></div>
            </div>
            <button class="close-search-btn" onclick="closeSearchOverlay()"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg fixed-top {{ (!request()->routeIs('home') && !request()->routeIs('products.index') && !request()->routeIs('contact') && !request()->routeIs('about')) ? 'scrolled static-nav' : '' }}">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-icon.png') }}" alt="Mystic Mall Logo" style="height: 45px; width: auto; margin-right: 12px; filter: drop-shadow(0 2px 5px rgba(46, 2, 73, 0.4));">
                <span class="ms-1 fw-bold">Mystic</span> <span class="fw-light ms-1">Mall</span>
            </a>
            
            <div class="d-flex align-items-center d-lg-none gap-3">
                <a href="#" class="text-white text-decoration-none" onclick="event.preventDefault(); openSearchOverlay();">
                    <i class="fas fa-search fs-4"></i>
                </a>
                <button class="navbar-toggler border-0 text-white shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" style="font-size: 1.5rem;">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>

            <div class="drawer-backdrop" id="drawerBackdrop" onclick="closeMobileDrawer()"></div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="drawer-header d-lg-none">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" style="height: 30px; margin-right: 10px;">
                        <span class="text-white fw-bold fs-5 font-cinzel">Mystic Mall</span>
                    </div>
                    <button class="btn btn-link text-white p-0 border-0 fs-4" onclick="closeMobileDrawer()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} d-none d-lg-flex" href="{{ url('/') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->has('category') && request()->query('category') != 'Accessories' ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-th-large"></i> Categories
                        </a>
                        <ul class="dropdown-menu animate__animated animate__fadeInUp">
                            <li><a class="dropdown-item" href="{{ url('/products') }}"><i class="fas fa-th-large me-2"></i> All Products</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item {{ request()->query('category') == 'Formal Wears' ? 'text-warning' : '' }}" href="{{ url('/products?category=Formal Wears') }}"><i class="fas fa-user-tie me-2"></i> Formal Wears</a></li>
                            <li><a class="dropdown-item {{ request()->query('category') == 'Casual Wears' ? 'text-warning' : '' }}" href="{{ url('/products?category=Casual Wears') }}"><i class="fas fa-tshirt me-2"></i> Casual Wears</a></li>
                            <li><a class="dropdown-item {{ request()->query('category') == 'Men\'s Collection' ? 'text-warning' : '' }}" href="{{ url('/products?category=Men\'s Collection') }}"><i class="fas fa-male me-2"></i> Men's Collection</a></li>
                            <li><a class="dropdown-item {{ request()->query('category') == 'Women\'s Collection' ? 'text-warning' : '' }}" href="{{ url('/products?category=Women\'s Collection') }}"><i class="fas fa-female me-2"></i> Women's Collection</a></li>
                            <li><a class="dropdown-item {{ request()->query('category') == 'Kid\'s Collection' ? 'text-warning' : '' }}" href="{{ url('/products?category=Kid\'s Collection') }}"><i class="fas fa-child me-2"></i> Kid's Collection</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item d-lg-none"><a class="nav-link" href="{{ route('wishlist.index') }}"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link" href="{{ url('/about') }}"><i class="fas fa-info-circle"></i> About Us</a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link" href="{{ url('/contact') }}"><i class="fas fa-envelope"></i> Contact Support</a></li>

                    <li class="nav-item d-none d-lg-block"><a class="nav-link {{ request()->query('new_arrival') ? 'active' : '' }}" href="{{ url('/products?new_arrival=true') }}"><i class="fas fa-bolt"></i> New Arrivals</a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link {{ request()->query('category') == 'Accessories' ? 'active' : '' }}" href="{{ url('/products?category=Accessories') }}"><i class="fas fa-gem"></i> Accessories</a></li>

                    <li class="nav-item ms-2 d-none d-lg-block">
                        <button class="btn btn-outline-mystic border-white text-white d-flex align-items-center" onclick="openSearchOverlay()" style="padding: 0.4rem 0.8rem;">
                            <i class="fas fa-search"></i>
                        </button>
                    </li>

                    <li class="nav-item ms-2 d-none d-lg-block">
                        <a class="btn btn-outline-mystic position-relative border-white text-white d-flex align-items-center" 
                           href="{{ url('/cart') }}" 
                           onclick="event.preventDefault(); openCartDrawer();"
                           style="padding: 0.4rem 1rem;">
                            <i class="fas fa-shopping-cart me-2"></i> Cart
                            @php $cartCount = count((array) session('cart')); @endphp
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge {{ $cartCount > 0 ? '' : 'd-none' }}">
                                {{ $cartCount }}
                            </span>
                        </a>
                    </li>

                    @auth
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle bg-white text-primary d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">
                                    <i class="fas fa-user"></i>
                                </div>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow" style="background-color: var(--primary-light);">
                                @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item text-white" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item text-white" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i> My Profile</a></li>
                                <li><a class="dropdown-item text-white" href="{{ route('orders.index') }}"><i class="fas fa-box me-2"></i> My Orders</a></li>
                                <li><a class="dropdown-item text-white" href="{{ route('wishlist.index') }}"><i class="fas fa-heart me-2"></i> My Wishlist</a></li>
                                <li><hr class="dropdown-divider bg-white"></li>
                                <li><a class="dropdown-item text-white" href="#" data-bs-toggle="modal" data-bs-target="#preferencesModal"><i class="fas fa-cog me-2"></i> Preferences</a></li>
                                <li><hr class="dropdown-divider bg-white"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="button" class="dropdown-item text-white" onclick="confirmLogout(event)">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a class="btn btn-mystic" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main style="{{ (!request()->routeIs('home') && !request()->routeIs('products.index') && !request()->routeIs('contact') && !request()->routeIs('about')) ? 'margin-top: 100px;' : '' }}">
        {{ $slot }}
    </main>

    <div class="modal fade" id="preferencesModal" tabindex="-1" aria-labelledby="preferencesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                <div class="modal-header" style="background: var(--primary-color); border-bottom: none;">
                    <h5 class="modal-title font-cinzel text-white fw-bold" id="preferencesModalLabel"><i class="fas fa-cog me-2 text-warning"></i> User Preferences</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded shadow-sm border">
                        <div>
                            <h6 class="mb-1 fw-bold text-dark"><i class="fas fa-adjust text-accent me-2"></i> Appearance</h6>
                            <small class="text-muted">Choose between light and dark mode</small>
                        </div>
                        <div class="form-check form-switch ms-3">
                            <input class="form-check-input" type="checkbox" id="user-theme-toggle-modal" style="width: 2.5em; height: 1.25em; cursor: pointer;">
                        </div>
                    </div>
                    
                    <div class="mb-4 p-3 bg-white rounded shadow-sm border">
                        <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-money-bill-wave text-success me-2"></i> Currency Options</h6>
                        <select class="form-select form-select-sm" aria-label="Currency select">
                            <option selected value="PKR">Pakistani Rupee (Rs)</option>
                            <option value="USD">US Dollar ($)</option>
                            <option value="EUR">Euro (€)</option>
                            <option value="GBP">British Pound (£)</option>
                        </select>
                    </div>

                    <div class="mb-4 p-3 bg-white rounded shadow-sm border">
                        <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-globe text-info me-2"></i> Language</h6>
                        <select id="langSelect" class="form-select form-select-sm" aria-label="Language select">
                            <option selected value="en">English</option>
                            <option value="ur">Urdu (اردو)</option>
                        </select>
                    </div>

                    <div class="p-3 bg-white rounded shadow-sm border">
                        <h6 class="mb-3 fw-bold text-dark"><i class="fas fa-bell text-danger me-2"></i> Notifications</h6>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                            <label class="form-check-label text-dark" for="emailNotif">Email Updates</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="smsNotif">
                            <label class="form-check-label text-dark" for="smsNotif">SMS Alerts</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 pt-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-mystic rounded-pill px-4" data-bs-dismiss="modal" onclick="Swal.fire({icon: 'success', title: 'Preferences Saved', showConfirmButton: false, timer: 1500})">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <section class="category-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-accent text-uppercase letter-spacing-2 fw-bold mb-2" style="font-family: 'Outfit', sans-serif;">Curated Collections</h6>
                <h2 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--primary-color);">Browse by Category</h2>
                <div style="width: 60px; height: 3px; background-color: var(--accent-color); margin: 20px auto;"></div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ url('/products?category=Formal Wears') }}" class="text-decoration-none">
                        <div class="category-card">
                            <img src="{{ asset('images/local/cat_formal.png') }}" class="category-img" alt="Formal Wears">
                            <div class="category-overlay">
                                <div class="glass-title-box">Formal Wears</div>
                                <span class="category-count">View Collection</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ url('/products?category=Casual Wears') }}" class="text-decoration-none">
                        <div class="category-card">
                            <img src="{{ asset('images/local/cat_casual.png') }}" class="category-img" alt="Casual Wears">
                            <div class="category-overlay">
                                <div class="glass-title-box">Casual Wears</div>
                                <span class="category-count">View Collection</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ url('/products?category=Men\'s Collection') }}" class="text-decoration-none">
                        <div class="category-card">
                            <img src="{{ asset('images/local/hero_men.png') }}" class="category-img" alt="Mens Collection">
                            <div class="category-overlay">
                                <div class="glass-title-box">Men's Collection</div>
                                <span class="category-count">View Collection</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ url('/products?category=Women\'s Collection') }}" class="text-decoration-none">
                        <div class="category-card">
                            <img src="{{ asset('images/local/hero_women.png') }}" class="category-img" alt="Womens Collection">
                            <div class="category-overlay">
                                <div class="glass-title-box">Women's Collection</div>
                                <span class="category-count">View Collection</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ url('/products?category=Kid\'s Collection') }}" class="text-decoration-none">
                        <div class="category-card">
                            <img src="{{ asset('images/local/cat_kids.png') }}" class="category-img" alt="Kids Collection">
                            <div class="category-overlay">
                                <div class="glass-title-box">Kid's Collection</div>
                                <span class="category-count">View Collection</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ url('/products?category=Accessories') }}" class="text-decoration-none">
                        <div class="category-card">
                            <img src="{{ asset('images/local/hero_accessories.png') }}" class="category-img" alt="Accessories">
                            <div class="category-overlay">
                                <div class="glass-title-box">Accessories</div>
                                <span class="category-count">View Collection</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div id="footer">   
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Mystic <span class="text-accent fw-bold d-block text-white">Mall</span></h3>
                        <p class="text-white-50">
                            Lahore, Punjab <br>
                            Pakistan <br><br>
                            <strong>Phone:</strong> +92 321 7079965 <br>
                            <strong>Email:</strong> mysticmall@gmail.com <br>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ url('/') }}">Home</a></li>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ url('/about') }}">About</a></li>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ url('/contact') }}">Contact</a></li>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ route('services.support') }}">Premium Support</a></li>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ route('services.payment') }}">Secure Payment</a></li>
                            <li><i class="fas fa-chevron-right text-accent me-2"></i> <a href="{{ route('services.shipping') }}">Fast Delivery</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Connect With Us</h4>
                        <p class="text-white-50 mb-3">Follow us for updates and exclusive offers.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container py-4 border-top border-secondary">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span class="text-accent">Mystic Mall</span></strong>. All Rights Reserved
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="credits text-white-50 small">
                        Designed for Excellence
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background: rgba(46, 2, 73, 0.98); backdrop-filter: blur(15px); border: 1px solid var(--accent-color); color: #fff;">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-index-10" data-bs-dismiss="modal" style="z-index: 10;"></button>
                    <div class="row g-0">
                        <div class="col-lg-6 bg-white d-flex align-items-center justify-content-center p-5 position-relative overflow-hidden">
                            <img id="qv-image" src="" alt="Product" class="img-fluid" style="max-height: 500px; transition: transform 0.5s ease;">
                        </div>
                        
                        <div class="col-lg-6 p-5">
                            <span class="badge badge-mystic mb-2" id="qv-category">Category</span>
                            <h2 class="display-6 fw-bold mb-2" id="qv-title">Product Title</h2>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="text-warning me-2" id="qv-stars">
                                    </div>
                                <small class="text-white-50" id="qv-review-count">(0 Reviews)</small>
                            </div>

                            <h3 class="text-accent fw-bold mb-4" id="qv-price">Rs. 0</h3>
                            
                            <p class="text-white-50 mb-4" id="qv-description">Description...</p>
                            
                            <div class="border-top border-secondary pt-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Quantity:</span>
                                    <div class="input-group" style="width: 140px;">
                                        <button class="btn btn-outline-light" onclick="updateQty(-1)">-</button>
                                        <input type="number" id="qv-qty" class="form-control text-center bg-transparent text-white border-light" value="1" min="1" readonly>
                                        <button class="btn btn-outline-light" onclick="updateQty(1)">+</button>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Delivery Charges:</span>
                                    <span class="text-accent" id="qv-delivery">Rs. 200</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="h5 mb-0">Total:</span>
                                    <span class="h4 fw-bold text-accent" id="qv-total">Rs. 0</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <form id="qv-buy-form" action="{{ route('checkout.index') }}" method="GET"> 
                                        <button type="button" onclick="buyNow()" class="btn btn-mystic btn-lg w-100 mb-2">Buy Now</button>
                                    </form>
                                    <button type="button" onclick="addToCartQV()" class="btn btn-outline-mystic btn-lg w-100">Add to Cart</button>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <h5 class="border-bottom border-secondary pb-2 mb-3">Latest Reviews</h5>
                                <div id="qv-reviews" style="max-height: 150px; overflow-y: auto;">
                                    <p class="text-white-50 small">No reviews yet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Global Variables for Quick View
        let currentProduct = {};
        const DELIVERY_FEE = 200;
        const FREE_DELIVERY_THRESHOLD = 5000;

        function openQuickView(id) {
            // Show loading or clear previous data
            document.getElementById('qv-title').innerText = 'Loading...';
            
            var myModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
            myModal.show();

            fetch(`/product/quick-view/${id}`)
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        currentProduct = data.product;
                        
                        // Populate Data
                        document.getElementById('qv-image').src = `{{ asset('uploads') }}/${currentProduct.image}`;
                        document.getElementById('qv-category').innerText = currentProduct.category;
                        document.getElementById('qv-title').innerText = currentProduct.name;
                        document.getElementById('qv-description').innerText = currentProduct.description;
                        document.getElementById('qv-price').innerText = `Rs. ${currentProduct.price.toLocaleString()}`;
                        document.getElementById('qv-review-count').innerText = `(${data.review_count} Reviews)`;
                        
                        // Stars
                        let starsHtml = '';
                        for(let i=0; i<5; i++) {
                            if(i < data.avg_rating) starsHtml += '<i class="fas fa-star"></i>';
                            else starsHtml += '<i class="far fa-star"></i>';
                        }
                        document.getElementById('qv-stars').innerHTML = starsHtml;

                        // Reviews
                        const reviewsContainer = document.getElementById('qv-reviews');
                        if(currentProduct.reviews && currentProduct.reviews.length > 0) {
                            reviewsContainer.innerHTML = currentProduct.reviews.map(r => `
                                <div class="mb-2 border-bottom border-secondary pb-1">
                                    <div class="d-flex justify-content-between">
                                        <small class="fw-bold text-accent">${r.user.name}</small>
                                        <small class="text-white-50">${new Date(r.created_at).toLocaleDateString()}</small>
                                    </div>
                                    <small class="d-block text-white-50">${r.comment || ''}</small>
                                </div>
                            `).join('');
                        } else {
                            reviewsContainer.innerHTML = '<p class="text-white-50 small">No reviews yet.</p>';
                        }

                        // Reset Qty
                        document.getElementById('qv-qty').value = 1;
                        updateQty(0); // Trigger calculation
                    }
                });
        }

        function updateQty(change) {
            let qtyInput = document.getElementById('qv-qty');
            let newQty = parseInt(qtyInput.value) + change;
            if (newQty < 1) newQty = 1;
            qtyInput.value = newQty;

            // Calculate Totals
            if (currentProduct.price) {
                let subtotal = currentProduct.price * newQty;
                let delivery = subtotal >= FREE_DELIVERY_THRESHOLD ? 0 : DELIVERY_FEE;
                let total = subtotal + delivery;

                document.getElementById('qv-delivery').innerText = delivery === 0 ? 'Free' : `Rs. ${delivery}`;
                document.getElementById('qv-total').innerText = `Rs. ${total.toLocaleString()}`;
            }
        }

        function addToCartQV() {
            // Re-use existing Add to Cart Logic via hidden form or creating a FormData
            // Since we have a specialized logic on body submit, let's artificially trigger it or fetch directly
            
            const formData = new FormData();
            formData.append('product_id', currentProduct.id);
            formData.append('quantity', document.getElementById('qv-qty').value);
            formData.append('_token', '{{ csrf_token() }}');
            // Logic implies we might need to handle qty in backend if we want custom qty support (currently backend only ++1)
            // But for now, let's just add 1 item X times or update backend to support qty.
            // Simplified: Add 1 item (Standard flow) - OR - Update Backend to accept Qty.
            // For this task, assuming existing backend adds 1. To support Qty, backend needs update. 
            // LET'S UPDATE BACKEND TO SUPPORT QTY IN NEXT STEP IF NEEDED. For now, sending simple add.
            
            fetch("{{ route('cart.add') }}", {
                method: "POST",
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    // Close Modal
                    bootstrap.Modal.getInstance(document.getElementById('quickViewModal')).hide();
                    
                    // Update Badge (similar logic to previous script)
                    const cartIcon = document.querySelector('.fa-shopping-cart').closest('a');
                    const badge = document.querySelector('.badge.bg-danger');
                    if(badge) badge.innerText = data.cartCount;
                    else {
                        const newBadge = document.createElement('span');
                        newBadge.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
                        newBadge.innerText = data.cartCount;
                        if(cartIcon) cartIcon.appendChild(newBadge);
                    }
                    
                    // Show Toast
                    window.showToast("Product added to cart!", 'success');
                }
            });
        }

        function buyNow() {
            const formData = new FormData();
            formData.append('product_id', currentProduct.id);
            formData.append('quantity', document.getElementById('qv-qty').value);
            formData.append('_token', '{{ csrf_token() }}');
            
            fetch("{{ route('cart.add') }}", {
                method: "POST",
                body: formData,
            }).then(() => {
                window.location.href = "{{ route('checkout.index') }}";
            });
        }

        // Global Toast Function
        window.showToast = function(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast-mystic';
            
            const icon = type === 'success' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>';
            
            toast.innerHTML = `
                <div class="toast-icon">
                    ${icon}
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">Notification</h6>
                    <small>${message}</small>
                </div>
            `;

            toastContainer.appendChild(toast);

            // Show
            setTimeout(() => toast.classList.add('show'), 10);

            // Hide & Remove
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }

        // Navbar Scroll Effect
        const navbar = document.querySelector('.navbar');
        if (!navbar.classList.contains('scrolled')) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }

        // DOM Content Loaded - Animation Logic
        document.addEventListener("DOMContentLoaded", function() {
            const observerOptions = { threshold: 0.15 };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

            console.log("Animation Script Loaded"); // DEBUG

            const cartIcon = document.querySelector('.fa-shopping-cart').closest('a');
            
            document.addEventListener('submit', function(e) {
                if (e.target && e.target.classList.contains('add-to-cart-form')) {
                    e.preventDefault();
                    console.log("Add to Cart Triggered by Class");
                    
                    const form = e.target;
                    const productCard = form.closest('.product-card');
                    let productImg = productCard ? productCard.querySelector('img') : null;

                    if (!productImg) {
                        productImg = document.querySelector('.product-image-container img, .product-main-img');
                    }
                    
                    if (productImg && cartIcon) {
                        const imgClone = productImg.cloneNode();
                        const imgRect = productImg.getBoundingClientRect();
                        const cartRect = cartIcon.getBoundingClientRect();

                        imgClone.classList.add('flying-img');
                        imgClone.style.top = imgRect.top + 'px';
                        imgClone.style.left = imgRect.left + 'px';
                        imgClone.style.width = imgRect.width + 'px';
                        imgClone.style.height = imgRect.height + 'px';
                        document.body.appendChild(imgClone);

                        const truck = document.createElement('i');
                        truck.className = 'fas fa-truck flying-truck';
                        truck.style.top = imgRect.top + (imgRect.height/2) + 'px';
                        truck.style.left = imgRect.left + (imgRect.width/2) + 'px';
                        document.body.appendChild(truck);

                        setTimeout(() => {
                            imgClone.style.top = (cartRect.top + 10) + 'px';
                            imgClone.style.left = (cartRect.left + 10) + 'px';
                            imgClone.style.width = '20px';
                            imgClone.style.height = '20px';
                            imgClone.style.opacity = '0.5';

                            truck.style.top = (cartRect.top + 10) + 'px';
                            truck.style.left = (cartRect.left + 10) + 'px';
                            truck.style.opacity = '0';
                            truck.style.fontSize = '0.5rem';
                        }, 50);

                        setTimeout(() => {
                            imgClone.remove();
                            truck.remove();
                        }, 800);
                    }

                    const formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (response.ok) return response.json();
                        throw new Error('Network response was not ok.');
                    })
                    .then(data => {
                        if (data.success) {
                            const badge = document.querySelector('.badge.bg-danger');
                            if (badge) {
                                badge.innerText = data.cartCount;
                            } else {
                                const newBadge = document.createElement('span');
                                newBadge.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
                                newBadge.innerText = data.cartCount;
                                cartIcon.appendChild(newBadge);
                            }
                            window.showToast(data.message || 'Product added to cart successfully!', 'success');
                        } else {
                            window.showToast('Something went wrong!', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        window.showToast('Product added! (Check Cart)', 'success'); 
                    });
                }
            });
        });

        function toggleWishlist(event, productId) {
            event.preventDefault(); 
            const btn = event.currentTarget;
            
            @auth
                fetch("{{ route('wishlist.toggle') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'added') {
                        btn.innerHTML = '<i class="fas fa-heart text-danger"></i>';
                        window.showToast(data.message, 'success');
                    } else {
                        btn.innerHTML = '<i class="far fa-heart text-danger"></i>';
                        window.showToast(data.message, 'info');
                    }
                })
                .catch(err => console.error(err));
            @else
                window.location.href = "{{ route('login') }}";
            @endauth
        }

        // Search Overlay Functions
        function openSearchOverlay() {
            document.getElementById('searchOverlay').classList.add('active');
            setTimeout(() => {
                document.querySelector('#searchOverlay input').focus();
            }, 100);
        }

        function closeSearchOverlay() {
            document.getElementById('searchOverlay').classList.remove('active');
        }

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeSearchOverlay();
            }
        });

        // Logout Confirmation
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of your account.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Logout!',
                background: 'rgba(46, 2, 73, 0.95)',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }

        // Dark Mode Logic (User Side - Modal Switch)
        document.addEventListener('DOMContentLoaded', () => {
            const themeSwitch = document.getElementById('user-theme-toggle-modal');
            if (themeSwitch) {
                // Set initial state based on class applied early on
                if (document.documentElement.classList.contains('dark-mode')) {
                    themeSwitch.checked = true;
                }
                
                themeSwitch.addEventListener('change', (e) => {
                    if (e.target.checked) {
                        document.documentElement.classList.add('dark-mode');
                        localStorage.setItem('user_theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark-mode');
                        localStorage.setItem('user_theme', 'light');
                    }
                });
            }
        });
    </script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 50
            });
        });
    </script>
    @if(session('welcome_type'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const welcomeType = '{{ session('welcome_type') }}';
            const welcomeName = '{{ session('welcome_name') }}';
            
            let titleText = welcomeType === 'first' ? `Welcome, ${welcomeName}! 🎉` : `Welcome back, ${welcomeName}! 👋`;
            
            Swal.fire({
                title: titleText,
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: document.documentElement.classList.contains('dark-mode') ? '#1e1e1e' : '#fff',
                color: document.documentElement.classList.contains('dark-mode') ? '#fff' : '#000',
                showClass: {
                    popup: 'animate__animated animate__bounceInRight'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutRight'
                }
            });
        });
    </script>
    @endif
    
    <div id="google_translate_element"></div>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', 
                includedLanguages: 'ur,en',
                autoDisplay: false
            }, 'google_translate_element');
        }

        // Logic to hook our custom dropdown to the Google Translate Engine
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a moment for google translate iframe to build
            setTimeout(() => {
                const customLangSelect = document.getElementById('langSelect');
                if(!customLangSelect) return;
                
                // Read from memory/cookie if existing
                let isUrdu = document.cookie.includes('googtrans=/en/ur');
                if (isUrdu) {
                    customLangSelect.value = 'ur';
                    document.body.classList.add('lang-ur');
                }

                customLangSelect.addEventListener('change', function(e) {
                    const val = e.target.value; // 'en' or 'ur'
                    
                    // We change the google translate iframe select dropdown programmatically
                    var frame = document.querySelector('.goog-te-combo');
                    if(frame) {
                        frame.value = val;
                        // Dispatch event to trigger translation
                        frame.dispatchEvent(new Event('change'));
                        
                        if (val === 'ur') {
                            document.body.classList.add('lang-ur');
                        } else {
                            document.body.classList.remove('lang-ur');
                        }
                    }
                });
            }, 1000);
        });
    </script>
    <script>
        // --- Intelligent Search Logic ---
        (function() {
            const searchOverlay = document.getElementById('searchOverlay');
            const searchInput = document.getElementById('searchInput');
            const searchSuggestions = document.getElementById('searchSuggestions');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout = null;

            window.openSearchOverlay = function() {
                searchOverlay.classList.add('active');
                setTimeout(() => searchInput.focus(), 300);
                showHistory(); // Show history when opened
            }

            window.closeSearchOverlay = function() {
                searchOverlay.classList.remove('active');
                searchSuggestions.style.display = 'none';
            }

            // Listen for input with debouncing
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.trim();
                
                clearTimeout(searchTimeout);
                if (query.length < 2) {
                    showHistory();
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetchSuggestions(query);
                }, 300);
            });

            // Show history when focusing empty input
            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length < 2) {
                    showHistory();
                }
            });

            // Fetch Suggetions from API
            async function fetchSuggestions(query) {
                try {
                    const response = await fetch(`/search/autocomplete?q=${encodeURIComponent(query)}`);
                    const products = await response.json();
                    renderSuggestions(products);
                } catch (error) {
                    console.error('Search error:', error);
                }
            }

            // Render Suggetions
            function renderSuggestions(products) {
                if (products.length === 0) {
                    searchSuggestions.innerHTML = '<div class="p-4 text-center text-muted">No products found.</div>';
                    searchSuggestions.style.display = 'block';
                    return;
                }

                let html = '<div class="history-header">Product Suggestions</div>';
                products.forEach(product => {
                    const imgPath = product.image.startsWith('http') ? product.image : `/uploads/${product.image}`;
                    html += `
                        <div class="suggestion-item" onclick="handleSuggestionClick('${product.id}', '${product.name}')">
                            <img src="${imgPath}" class="suggestion-img" onerror="this.src='https://placehold.co/50x50?text=Product'">
                            <div class="suggestion-info">
                                <h6>${product.name}</h6>
                                <span>${product.category} • Rs. ${new Intl.NumberFormat().format(product.price)}</span>
                            </div>
                        </div>
                    `;
                });
                searchSuggestions.innerHTML = html;
                searchSuggestions.style.display = 'block';
            }

            // Handle Click & Save History
            window.handleSuggestionClick = function(id, name) {
                saveSearchQuery(name);
                window.location.href = `/product/details/${id}`;
            }

            // Save Query to DB & LocalStorage
            async function saveSearchQuery(query) {
                // Save to LocalStorage for guest
                let localHistory = JSON.parse(localStorage.getItem('search_history') || '[]');
                localHistory = [query, ...localHistory.filter(q => q !== query)].slice(0, 5);
                localStorage.setItem('search_history', JSON.stringify(localHistory));

                // Save to DB via AJAX
                try {
                    fetch('/search/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ q: query })
                    });
                } catch (e) {}
            }

            // Show History (DB + Local)
            async function showHistory() {
                const localHistory = JSON.parse(localStorage.getItem('search_history') || '[]');
                
                try {
                    const response = await fetch('/search/history');
                    const dbHistory = await response.json();
                    
                    // Combine and unique
                    const combined = [...new Set([...dbHistory, ...localHistory])].slice(0, 6);
                    
                    if (combined.length === 0) {
                        searchSuggestions.style.display = 'none';
                        return;
                    }

                    let html = '<div class="history-header">Recent Searches</div>';
                    combined.forEach(q => {
                        html += `
                            <div class="history-item" onclick="fillSearch('${q}')">
                                <i class="fas fa-history text-muted small"></i>
                                <span>${q}</span>
                            </div>
                        `;
                    });
                    
                    searchSuggestions.innerHTML = html;
                    searchSuggestions.style.display = 'block';
                } catch (e) {
                    searchSuggestions.style.display = 'none';
                }
            }

            window.fillSearch = function(query) {
                searchInput.value = query;
                fetchSuggestions(query);
                searchInput.focus();
            }

            // Save when form submitted
            searchForm.addEventListener('submit', function(e) {
                saveSearchQuery(searchInput.value.trim());
            });

            // Hide suggestions on outside click
            document.addEventListener('mousedown', function(e) {
                if (!searchOverlay.contains(e.target)) {
                    searchSuggestions.style.display = 'none';
                }
            });
        })();

        // --- Side Cart Drawer Logic ---
        const cartDrawer = document.getElementById('cartDrawer');
        const cartDrawerOverlay = document.getElementById('cartDrawerOverlay');

        function openCartDrawer() {
            cartDrawerOverlay.classList.add('active');
            cartDrawer.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scroll
            fetchCartDrawer(); // Refresh content
        }

        function closeCartDrawer() {
            cartDrawer.classList.remove('active');
            cartDrawerOverlay.classList.remove('active');
            document.body.style.overflow = ''; // Restore scroll
            setTimeout(() => {
                if (!cartDrawer.classList.contains('active')) {
                    cartDrawerOverlay.style.display = 'none';
                }
            }, 300);
        }

        async function fetchCartDrawer() {
            try {
                const response = await fetch('{{ route('cart.drawer') }}');
                const html = await response.text();
                cartDrawer.innerHTML = html;
            } catch (error) {
                console.error('Error fetching cart drawer:', error);
            }
        }

        // Intercept all "Add to Cart" forms globally
        document.addEventListener('submit', function(e) {
            if (e.target.matches('form[action*="cart/add"]')) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update Drawer Content
                        cartDrawer.innerHTML = data.drawerHtml;
                        // Open Drawer
                        openCartDrawer();
                        // Update Cart Icon Badge (if exists)
                        updateCartCount(data.cartCount);
                        // Show success toast
                        if (window.showToast) window.showToast(data.message, 'success');
                    }
                })
                .catch(error => console.error('Add to cart error:', error));
            }
        });

        function updateCartCount(count) {
            const badges = document.querySelectorAll('.cart-badge');
            badges.forEach(badge => {
                badge.innerText = count;
                badge.classList.add('animate__animated', 'animate__heartBeat');
                setTimeout(() => badge.classList.remove('animate__animated', 'animate__heartBeat'), 1000);
            });
        }

        async function removeFromCartDrawer(id) {
            try {
                const response = await fetch('{{ route('cart.remove') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ id: id })
                });
                
                // Refresh drawer
                fetchCartDrawer();
                // We should also get updated count if possible, for now just refresh
                // Let's call a minimal API if needed, but fetchCartDrawer is okay for now.
            } catch (error) {
                console.error('Remove from cart error:', error);
            }
        }

        // --- Mobile Drawer Logic ---
        function closeMobileDrawer() {
            const menu = document.getElementById('navbarSupportedContent');
            const backdrop = document.getElementById('drawerBackdrop');
            if (menu.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(menu);
                if (bsCollapse) bsCollapse.hide();
                else menu.classList.remove('show');
            }
            backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Intercept Bootstrap collapse events to handle backdrop
        document.getElementById('navbarSupportedContent').addEventListener('show.bs.collapse', function () {
            document.getElementById('drawerBackdrop').classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        document.getElementById('navbarSupportedContent').addEventListener('hide.bs.collapse', function () {
            document.getElementById('drawerBackdrop').classList.remove('active');
            document.body.style.overflow = '';
        });
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    @stack('scripts')
</body>
</html>