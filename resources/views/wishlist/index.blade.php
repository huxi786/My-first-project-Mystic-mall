<x-app-layout>
    <div class="container py-5" style="margin-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="display-5 fw-bold text-dark"><i class="fas fa-heart text-danger me-2"></i>My Wishlist</h2>
            <a href="{{ route('home') }}" class="btn btn-outline-mystic">Continue Shopping</a>
        </div>

        <div class="row g-4">
            @forelse($wishlists as $item)
            <div class="col-lg-3 col-md-6">
                <div class="card product-card h-100">
                    <div class="product-image-container">
                        <img src="{{ asset('uploads/' . $item->product->image) }}" alt="{{ $item->product->name }}" 
                             onerror="this.src='{{ asset('images/hero (2).jpg') }}'">
                        
                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light rounded-circle shadow-sm text-danger" style="width: 32px; height: 32px; padding: 0; line-height: 32px;" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">{{ $item->product->name }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($item->product->description, 40) }}</p>
                        
                        <div class="mt-auto">
                            <h5 class="product-price mb-3">Rs. {{ number_format($item->product->price) }}</h5>
                            
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <button type="submit" class="btn btn-mystic w-100">
                                    <i class="fas fa-shopping-cart me-2"></i> Move to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-light shadow-sm py-5">
                    <i class="far fa-heart fa-4x text-muted mb-3 opacity-50"></i>
                    <h4 class="text-muted">Your wishlist is empty</h4>
                    <p class="text-muted mb-4">Save items you love to buy later.</p>
                    <a href="{{ route('home') }}" class="btn btn-mystic">Start Browsing</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
