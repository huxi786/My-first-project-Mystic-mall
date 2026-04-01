@props(['products'])

@if($products && $products->count() > 0)
<div class="flash-sales-wrapper py-4" style="background: #fafafa;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <h2 class="section-title-lux mb-0" style="font-family: 'Cinzel', serif; font-weight: 700; color: #2e0249;">
                    <i class="fas fa-bolt text-warning me-2"></i> Flash Deals
                </h2>
                <div class="countdown-container d-flex align-items-center gap-2 ms-4">
                    <span class="text-muted small fw-bold text-uppercase">Ending In:</span>
                    <div id="flash-countdown" class="d-flex gap-2">
                        <div class="timer-box"><span id="days">00</span></div>
                        <div class="timer-box"><span id="hours">00</span></div>
                        <div class="timer-box"><span id="minutes">00</span></div>
                        <div class="timer-box"><span id="seconds">00</span></div>
                    </div>
                </div>
            </div>
            <a href="{{ route('products.index', ['flash_sale' => 1]) }}" class="btn btn-link text-decoration-none fw-bold" style="color: #2e0249;">
                SHOP ALL <i class="fas fa-chevron-right ms-1 small"></i>
            </a>
        </div>

        <div class="row gx-2 gy-3 d-flex align-items-stretch">
            @foreach($products as $product)
                <div class="col-4 col-md-3 col-lg-3 d-flex">
                    <div class="product-card-lux flash-deal-card flex-fill d-flex flex-column">
                        <div class="badge-flash-wrapper">
                            <div class="badge-flash">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF</div>
                        </div>
                        <div class="product-img-wrapper">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('uploads/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop'">
                            <div class="product-actions-lux-v2">
                                <button onclick="quickView({{ $product->id }})" class="action-btn-lux-v2" title="Quick View">
                                    <i class="fas fa-eye"></i> <span>VIEW</span>
                                </button>
                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="action-btn-lux-v2 cart-btn" title="Add to Cart">
                                        <i class="fas fa-shopping-cart"></i> <span>SHOP</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="product-info-lux p-3 text-center flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="product-name-lux mb-2">{{ $product->name }}</h3>
                                <div class="price-wrapper mb-3 d-flex align-items-center justify-content-center gap-2">
                                    <span class="new-price-lux">Rs. {{ number_format($product->discount_price) }}</span>
                                    <span class="old-price-lux text-muted text-decoration-line-through small">Rs. {{ number_format($product->price) }}</span>
                                </div>
                            </div>
                            <div class="stock-progress mt-auto p-2" style="background: rgba(46, 2, 73, 0.03); border-radius: 12px;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small text-muted fw-bold">Limited Stock</span>
                                    <span class="small fw-bold text-danger">{{ rand(5, 15) }} LEFT</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 10px; background: rgba(0,0,0,0.05);">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{ rand(75, 95) }}%; border-radius: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .timer-box {
        background: #2e0249;
        color: #fff;
        padding: 5px 10px;
        border-radius: 6px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        min-width: 35px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(46, 2, 73, 0.2);
    }

    .badge-flash-wrapper {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
    }

    .badge-flash {
        background: #ff4d4d;
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.8rem;
        box-shadow: 0 4px 15px rgba(255, 77, 77, 0.4);
        animation: pulseFlash 2s infinite;
    }

    @keyframes pulseFlash {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .flash-deal-card {
        border-radius: 20px;
        border: 1px solid rgba(255, 77, 77, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: #fff;
    }

    .flash-deal-card:hover {
        border-color: #ff4d4d;
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(46, 2, 73, 0.15);
    }

    .product-img-wrapper {
        width: 100%;
        height: 160px; /* Adjusted slightly */
        overflow: hidden;
        border-radius: 12px 12px 0 0;
        position: relative;
        background: #fff; /* White background for 'contain' look */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Prevents distortion and cropping */
        padding: 5px;
        transition: transform 0.5s ease;
    }

    .product-actions-lux-v2 {
        position: absolute;
        bottom: -60px; /* Hidden initially */
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 15px;
        background: linear-gradient(to top, rgba(46, 2, 73, 0.8), transparent);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 5;
    }

    .product-img-wrapper:hover .product-actions-lux-v2 {
        bottom: 0;
    }

    .action-btn-lux-v2 {
        background: #fff;
        color: #2e0249;
        border: none;
        padding: 8px 15px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .product-card-lux {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .new-price-lux {
        color: #ff4d4d;
        font-weight: 800;
        font-size: 1.1rem; /* Balanced size */
    }

    .product-name-lux {
        font-family: 'Poppins', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: #2e0249;
        margin-bottom: 8px;
    }

    .action-btn-lux-v2 span {
        display: none;
    }

    .action-btn-lux-v2:hover {
        background: #ffc800;
        transform: scale(1.1);
        color: #2e0249;
    }

    .action-btn-lux-v2:hover span {
        display: inline;
    }

    .cart-btn:hover {
        background: #ff4d4d !important;
        color: #fff !important;
    }

    @media (max-width: 768px) {
        .product-actions-lux-v2 {
            bottom: 0;
            background: none;
            padding: 10px;
        }
        .action-btn-lux-v2 {
            padding: 6px 12px;
        }
        .countdown-container {
            display: none !important;
        }
        .product-img-wrapper {
            height: 120px; /* Very small for 3-col mobile view */
        }
        .section-title-lux {
            font-size: 1.2rem;
        }
        .product-name-lux {
            font-size: 0.75rem;
        }
        .badge-flash {
            font-size: 0.6rem;
            padding: 4px 8px;
        }
    }
</style>

<script>
    (function() {
        @php
            $latestEnd = $products->sortByDesc('flash_deal_end')->first();
            $timestamp = $latestEnd ? $latestEnd->flash_deal_end->format('U') * 1000 : 0;
        @endphp
        
        const endTime = {{ $timestamp }};

        if (endTime === 0) return;

        const updateTimer = () => {
            const now = new Date().getTime();
            const distance = endTime - now;

            const daysSpan = document.getElementById("days");
            const hoursSpan = document.getElementById("hours");
            const minutesSpan = document.getElementById("minutes");
            const secondsSpan = document.getElementById("seconds");

            if (distance < 0) {
                const countdownEl = document.getElementById("flash-countdown");
                if (countdownEl) countdownEl.innerHTML = "<span class='text-danger fw-bold'>EXPIRED</span>";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if(daysSpan) daysSpan.innerText = days.toString().padStart(2, '0');
            if(hoursSpan) hoursSpan.innerText = hours.toString().padStart(2, '0');
            if(minutesSpan) minutesSpan.innerText = minutes.toString().padStart(2, '0');
            if(secondsSpan) secondsSpan.innerText = seconds.toString().padStart(2, '0');
        };

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
    })();
</script>
@endif
