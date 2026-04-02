<div class="cart-drawer-header p-4 d-flex justify-content-between align-items-center border-bottom bg-mystic-dark text-white">
    <h5 class="mb-0 fw-bold"><i class="fas fa-shopping-bag me-2 text-accent"></i> Your Bag</h5>
    <button type="button" class="btn-close btn-close-white" onclick="closeCartDrawer()"></button>
</div>

<div class="cart-drawer-body flex-grow-1 overflow-auto p-4">
    @php $cart = session('cart'); $total = 0; @endphp
    @if($cart && count($cart) > 0)
        @foreach($cart as $id => $details)
            @php $total += $details['price'] * $details['quantity'] @endphp
            <div class="cart-drawer-item mb-4 d-flex align-items-start gap-3 animate__animated animate__fadeInRight">
                <div class="cart-item-img-wrapper shadow-sm rounded overflow-hidden">
                    @if(isset($details['image']))
                        <img src="{{ Str::startsWith($details['image'], 'http') ? $details['image'] : asset('uploads/' . $details['image']) }}" 
                             alt="{{ $details['name'] }}" 
                             class="img-fluid" 
                             style="width: 70px; height: 70px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="fas fa-box text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="cart-item-info flex-grow-1">
                    <h6 class="mb-1 fw-bold text-mystic-dark" style="font-size: 0.9rem;">{{ $details['name'] }}</h6>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="text-accent fw-bold small">Rs. {{ number_format($details['price']) }}</span>
                        <div class="quantity-controls d-flex align-items-center bg-light rounded px-2">
                            <span class="small text-muted me-2">Qty:</span>
                            <span class="fw-bold small">{{ $details['quantity'] }}</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-link text-danger p-0 ms-2" onclick="removeFromCartDrawer('{{ $id }}')" title="Remove Item">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
        @endforeach
    @else
        <div class="text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fas fa-shopping-cart fa-4x opacity-25"></i>
            </div>
            <h5 class="text-muted">Your cart is empty</h5>
            <p class="small text-muted mb-4">Start adding items to your bag!</p>
            <a href="{{ url('/products') }}" class="btn btn-mystic btn-sm rounded-pill px-4" onclick="closeCartDrawer()">Shop Now</a>
        </div>
    @endif
</div>

@if($cart && count($cart) > 0)
    <div class="cart-drawer-footer p-4 border-top bg-light">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold text-muted text-uppercase small">Subtotal</span>
            <span class="fw-bold text-mystic-dark fs-5">Rs. {{ number_format($total) }}</span>
        </div>
        <div class="d-grid gap-2">
            <a href="{{ route('checkout.index') }}" class="btn btn-mystic btn-lg rounded-pill fw-bold" style="font-size: 0.95rem;">
                <i class="fas fa-lock me-2"></i> Secure Checkout
            </a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-mystic btn-sm rounded-pill">
                View Full Cart
            </a>
        </div>
        <p class="text-center mt-3 text-muted" style="font-size: 0.7rem;">
            <i class="fas fa-truck-moving me-1"></i> Free shipping on orders over Rs. 5,000
        </p>
    </div>
@endif
