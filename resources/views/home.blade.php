<x-app-layout>
    <!-- Hero Banner -->
    <!-- Dynamic Hero Section -->
    @if(request()->has('new_arrival'))
        <div class="mystic-hero text-center reveal" style="background: linear-gradient(rgba(46, 2, 73, 0.7), rgba(46, 2, 73, 0.7)), url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; padding: 150px 0 100px;">
            <div class="container">
                <h5 class="text-warning text-uppercase letter-spacing-2 fw-bold mb-3 animate__animated animate__fadeInDown">Just Landed</h5>
                <h1 class="display-2 fw-bold text-white mb-4 animate__animated animate__zoomIn" style="font-family: 'Cinzel', serif; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">New Arrivals</h1>
                <p class="lead text-light opacity-75 mb-0 animate__animated animate__fadeInUp" style="max-width: 600px; margin: 0 auto;">Explore the latest additions to our premium collection. Be the first to own the trend.</p>
                <div style="width: 80px; height: 4px; background-color: var(--accent-color); margin: 30px auto;" class="animate__animated animate__fadeInUp"></div>
            </div>
        </div>
    @elseif(request()->query('category') == 'Accessories')
        <div class="mystic-hero text-center reveal" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1576053139778-7e32f2ae3cfd?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; padding: 150px 0 100px;">
            <div class="container">
                <h5 class="text-warning text-uppercase letter-spacing-2 fw-bold mb-3 animate__animated animate__fadeInDown">The Finishing Touch</h5>
                <h1 class="display-2 fw-bold text-white mb-4 animate__animated animate__fadeInUp" style="font-family: 'Cinzel', serif; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Premium Accessories</h1>
                <p class="lead text-light opacity-75 mb-0 animate__animated animate__fadeInUp" style="max-width: 600px; margin: 0 auto;">Elevate your style with our exquisite range of watches, jewelry, and more.</p>
                <div style="width: 80px; height: 4px; background-color: var(--accent-color); margin: 30px auto;" class="animate__animated animate__fadeInUp"></div>
            </div>
        </div>
    @elseif(request()->query('category'))
        <div class="mystic-hero text-center reveal" style="background: linear-gradient(rgba(46, 2, 73, 0.8), rgba(46, 2, 73, 0.8)); padding: 150px 0 100px;">
             <div class="container">
                <h1 class="display-3 fw-bold text-white mb-3 animate__animated animate__fadeInDown" style="font-family: 'Cinzel', serif;">{{ $category }}</h1>
                <p class="lead text-light opacity-75 animate__animated animate__fadeInUp">Curated just for you.</p>
            </div>
        </div>
    @else
        <!-- Original Hero Carousel (Only on Home) -->
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <!-- Slide 1: Men's Collection -->
                <div class="carousel-item active">
                    <picture>
                        <source media="(min-width: 768px)" srcset="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1920&auto=format&fit=crop">
                        <img src="https://images.unsplash.com/photo-1617127365659-c47fa864d8bc?q=80&w=1080&auto=format&fit=crop" class="d-block w-100 hero-img" alt="Men's Fashion">
                    </picture>
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start h-100 container">
                        <h5 class="hero-subtitle text-uppercase text-warning animate__animated animate__fadeInDown">New Season</h5>
                        <h1 class="hero-title display-3 fw-bold animate__animated animate__fadeInLeft" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Men's Exclusive</h1>
                        <p class="hero-desc lead mb-4 animate__animated animate__fadeInUp d-none d-md-block">Upgrade your wardrobe with our premium selection of suits and casual wear.</p>
                        <a href="{{ url('/products?category=Mens Collection') }}" class="btn btn-mystic btn-lg animate__animated animate__fadeInUp">Shop Men</a>
                    </div>
                </div>

                <!-- Slide 2: Women's Collection -->
                <div class="carousel-item">
                    <picture>
                        <source media="(min-width: 768px)" srcset="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=1920&auto=format&fit=crop">
                        <img src="https://images.unsplash.com/photo-1581044777550-4cfa60707c03?q=80&w=1080&auto=format&fit=crop" class="d-block w-100 hero-img" alt="Women's Fashion">
                    </picture>
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100 container">
                        <h5 class="hero-subtitle text-uppercase text-warning animate__animated animate__fadeInDown">Elegance Redefined</h5>
                        <h1 class="hero-title display-3 fw-bold animate__animated animate__zoomIn" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Women's Luxury</h1>
                        <p class="hero-desc lead mb-4 animate__animated animate__fadeInUp d-none d-md-block">Discover the latest trends in high-end fashion and evening wear.</p>
                        <a href="{{ url('/products?category=Womens Collection') }}" class="btn btn-mystic btn-lg animate__animated animate__fadeInUp">Shop Women</a>
                    </div>
                </div>

                <!-- Slide 3: Accessories -->
                <div class="carousel-item">
                    <picture>
                        <source media="(min-width: 768px)" srcset="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=1920&auto=format&fit=crop">
                        <img src="https://images.unsplash.com/photo-1617038220319-33fc2a84fb53?q=80&w=1080&auto=format&fit=crop" class="d-block w-100 hero-img" alt="Accessories">
                    </picture>
                    <div class="hero-overlay"></div>
                    <!-- Changed to center alignment to fix off-screen issue -->
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100 container">
                        <h5 class="hero-subtitle text-uppercase text-warning animate__animated animate__fadeInDown">Finest Details</h5>
                        <h1 class="hero-title display-3 fw-bold animate__animated animate__fadeInUp" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Premium Accessories</h1>
                        <p class="hero-desc lead mb-4 animate__animated animate__fadeInUp d-none d-md-block">Complete your look with our curated collection of watches and jewelry.</p>
                        <a href="{{ url('/products?category=Accessories') }}" class="btn btn-mystic btn-lg animate__animated animate__fadeInUp">Shop Accessories</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    <!-- Products Section -->
    <div class="container py-5" id="product-cards">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold" style="color: var(--primary-color);">
                @if(isset($category) && $category)
                    {{ $category }}
                @else
                    Featured Products
                @endif
            </h2>
            <div style="width: 60px; height: 3px; background-color: var(--accent-color); margin: 10px auto;"></div>
        </div>
        
        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card product-card">
                    <div class="badge badge-mystic position-absolute" style="top: 15px; left: 15px;">{{ $product->category }}</div>
                    <div class="product-image-container">
                        <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" 
                             onerror="this.src='{{ asset('images/hero (2).jpg') }}'">
                        
                        <!-- Wishlist Button -->
                        <button class="btn btn-wishlist position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" 
                                style="background: rgba(255,255,255,0.9); width: 35px; height: 35px; line-height: 35px; padding: 0; border: none; z-index: 5;"
                                onclick="toggleWishlist(event, {{ $product->id }})">
                            <i class="{{ in_array($product->id, $wishlistProductIds ?? []) ? 'fas' : 'far' }} fa-heart text-danger"></i>
                        </button>

                        <!-- View Details Button (Bottom Right) -->
                        <button class="btn btn-details-overlay" onclick="openQuickView({{ $product->id }})">
                            View Details
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                             <span class="badge bg-light text-dark border">Stock: {{ $product->stock }}</span>
                             <div class="text-warning small">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                             </div>
                        </div>
                        <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-3" style="min-height: 40px;">{{ Str::limit($product->description, 50) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="product-price mb-0">Rs. {{ number_format($product->price, 0) }}</h5>
                            
                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-mystic">
                                    <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-light shadow-sm">
                    <i class="fas fa-info-circle me-2 text-primary"></i> No products found.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
