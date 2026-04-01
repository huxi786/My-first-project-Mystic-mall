<x-app-layout>
    <!-- Hero Banner -->
    @php
        $categoryConfig = [
            'Formal Wears' => ['img' => 'images/local/cat_formal.png', 'sub' => 'Elegance & Style'],
            'Casual Wears' => ['img' => 'images/local/cat_casual.png', 'sub' => 'Everyday Comfort'],
            'Men\'s Collection' => ['img' => 'images/local/hero_men.png', 'sub' => 'Gents Exclusive'],
            'Women\'s Collection' => ['img' => 'images/local/hero_women.png', 'sub' => 'Grace & Glamour'],
            'Kid\'s Collection' => ['img' => 'images/local/cat_kids.png', 'sub' => 'Playful Fashion'],
            'Accessories' => ['img' => 'images/local/hero_accessories.png', 'sub' => 'The Finishing Touch'],
            'New Arrivals' => ['img' => 'images/local/cat_new.png', 'sub' => 'Just Landed']
        ];
        
        $currentCat = request()->query('category');
        if (request()->has('new_arrival')) $currentCat = 'New Arrivals';
        
        $config = $categoryConfig[$currentCat] ?? null;
    @endphp

    <!-- Dynamic Hero Section -->
    @if($config)
        <div class="mystic-hero-static active">
            <div class="hero-ken-burns" style="background-image: url('{{ asset($config['img']) }}');"></div>
            <div class="hero-glass-overlay"></div>
            <div class="container d-flex justify-content-center">
                <div class="category-header-content">
                    <p class="mb-2">{{ $config['sub'] }}</p>
                    <h1 class="display-2">{{ $currentCat == 'New Arrivals' ? 'New Arrivals' : ($category ?? $currentCat) }}</h1>
                    <div style="width: 100px; height: 4px; background-color: var(--accent-color); margin: 0 auto;"></div>
                </div>
            </div>
        </div>
    @elseif(request()->query('category'))
        <div class="mystic-hero text-center reveal" style="background: linear-gradient(rgba(46, 2, 73, 0.8), rgba(46, 2, 73, 0.8)); padding: 150px 0 100px;">
             <div class="container">
                <h1 class="display-3 fw-bold text-white mb-3" style="font-family: 'Playfair Display', serif;">{{ $category }}</h1>
                <p class="lead text-light opacity-75" style="font-family: 'Outfit', sans-serif;">Curated just for you.</p>
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
                        <source media="(min-width: 768px)" srcset="{{ asset('images/local/home_hero_men.png') }}">
                        <img src="{{ asset('images/local/home_hero_men.png') }}" class="d-block w-100 hero-img" alt="Men's Fashion">
                    </picture>
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start h-100 container">
                        <h5 class="hero-subtitle text-uppercase text-warning animate__animated animate__fadeInDown">New Season</h5>
                        <h1 class="hero-title display-3 fw-bold animate__animated animate__fadeInLeft" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Men's Exclusive</h1>
                        <p class="hero-desc lead mb-4 animate__animated animate__fadeInUp d-none d-md-block">Upgrade your wardrobe with our premium selection of suits and casual wear.</p>
                        <a href="{{ url('/products?category=Men\'s Collection') }}" class="btn btn-mystic btn-lg animate__animated animate__fadeInUp">Shop Men</a>
                    </div>
                </div>

                <!-- Slide 2: Women's Collection -->
                <div class="carousel-item">
                    <picture>
                        <source media="(min-width: 768px)" srcset="{{ asset('images/local/home_hero_women.png') }}">
                        <img src="{{ asset('images/local/home_hero_women.png') }}" class="d-block w-100 hero-img" alt="Women's Fashion">
                    </picture>
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center h-100 container">
                        <h5 class="hero-subtitle text-uppercase text-warning animate__animated animate__fadeInDown">Elegance Redefined</h5>
                        <h1 class="hero-title display-3 fw-bold animate__animated animate__zoomIn" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Women's Luxury</h1>
                        <p class="hero-desc lead mb-4 animate__animated animate__fadeInUp d-none d-md-block">Discover the latest trends in high-end fashion and evening wear.</p>
                        <a href="{{ url('/products?category=Women\'s Collection') }}" class="btn btn-mystic btn-lg animate__animated animate__fadeInUp">Shop Women</a>
                    </div>
                </div>

                <!-- Slide 3: Accessories -->
                <div class="carousel-item">
                    <picture>
                        <source media="(min-width: 768px)" srcset="{{ asset('images/local/home_hero_acc.png') }}">
                        <img src="{{ asset('images/local/home_hero_acc.png') }}" class="d-block w-100 hero-img" alt="Accessories">
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

    <!-- Flash Sales Section -->
    <x-flash-sales :products="$flashSaleProducts" />

    <!-- Products Section with Watermarks -->
    <div class="category-watermark-container">
        @if($config)
            <img src="{{ asset($config['img']) }}" class="category-watermark" alt="">
            <img src="{{ asset($config['img']) }}" class="category-watermark-left" alt="">
        @endif

        <div class="container py-5" id="product-cards">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">
                    @if(isset($category) && $category)
                        {{ $category }}
                    @else
                        Featured Products
                    @endif
                </h2>
                <div style="width: 60px; height: 3px; background-color: var(--accent-color); margin: 10px auto;"></div>
            </div>
            
            <div class="row g-4 product-grid-animated">
                @forelse($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 150 }}">
                    <div class="card product-card">
                        <div class="badge badge-mystic position-absolute" style="top: 15px; left: 15px;">{{ $product->category }}</div>
                        <div class="product-image-container">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" 
                                 onerror="this.src='{{ asset('images/hero (2).jpg') }}'">
                            
                            <!-- Wishlist Button -->
                            <button class="btn btn-wishlist position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" 
                                    style="background: rgba(255,255,255,0.9); width: 35px; height: 35px; line-height: 35px; padding: 0; border: none; z-index: 5;"
                                    onclick="toggleWishlist(event, {{ $product->id }})">
                                <i class="{{ in_array($product->id, $wishlistProductIds ?? []) ? 'fas' : 'far' }} fa-heart text-danger"></i>
                            </button>
    
                            <!-- View Details Button (Bottom Right) -->
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-details-overlay" style="text-decoration: none;">
                                View Details
                            </a>
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
                            <h5 class="card-title text-truncate" style="font-family: 'Outfit', sans-serif; font-weight: 600;">{{ $product->name }}</h5>
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
    
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
