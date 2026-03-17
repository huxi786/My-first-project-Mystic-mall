<x-app-layout>
    <div class="container py-5 mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                <div class="image-zoom-container" style="position: sticky; top: 100px; background-color: #fff; border: 1px solid rgba(0,0,0,0.05); border-radius: 8px;">
                    <div class="img-zoom-lens"></div>
                    <img id="myimage" src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 12px; width: 100%; height: 100%;"
                         onerror="this.src='{{ asset('images/hero (2).jpg') }}'">
                </div>
                <!-- Zoom Result Container (Hidden by default, shown on hover) -->
                <div id="myresult" class="img-zoom-result shadow-lg rounded"></div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <!-- Badge & Stock -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge badge-mystic px-3 py-2" style="font-size: 0.9rem;">{{ $product->category }}</span>
                    <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                        {{ $product->stock > 0 ? 'In Stock: ' . $product->stock : 'Out of Stock' }}
                    </span>
                </div>

                <!-- Title & Rating -->
                <h1 class="display-5 fw-bold mb-2 text-mystic">{{ $product->name }}</h1>
                
                <div class="mb-4 d-flex align-items-center">
                    <div class="text-warning me-2 fs-5">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $avgRating)
                                <i class="fas fa-star"></i>
                            @elseif($i - 0.5 <= $avgRating)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-muted">({{ number_format($avgRating, 1) }} / 5 from {{ $product->reviews->count() }} reviews)</span>
                </div>

                <!-- Price -->
                <h2 class="fw-bold mb-4" style="color: var(--primary-color);">Rs. {{ number_format($product->price, 0) }}</h2>

                <!-- Description -->
                <div class="mb-4 text-muted" style="line-height: 1.8;">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <!-- Actions -->
                <div class="d-flex gap-3 mb-5">
                    <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-mystic btn-lg w-100 shadow-sm" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart me-2"></i> {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                        </button>
                    </form>
                    
                    @auth
                        <button class="btn btn-outline-danger btn-lg px-4 shadow-sm" onclick="toggleWishlist(event, {{ $product->id }})">
                            <i class="{{ auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'fas' : 'far' }} fa-heart"></i>
                        </button>
                    @endauth
                </div>

                <hr class="my-5">

                <!-- Reviews Section -->
                <h3 class="fw-bold mb-4 text-mystic">Customer Reviews</h3>

                <!-- Review Form -->
                @auth
                    @if(!$userReview)
                        <div class="card border-0 shadow-sm mb-5 p-4" style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
                            <h5 class="mb-3">Write a Review</h5>
                            <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-muted">Rating</label>
                                    <div class="rating-input outline-mystic d-inline-block p-2 rounded">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" value="{{ $i }}" name="rating" id="star{{ $i }}" required>
                                            <label for="star{{ $i }}" class="h4 mb-0 text-warning" style="cursor: pointer;"><i class="fas fa-star"></i></label>
                                        @endfor
                                    </div>
                                    <style>
                                        .rating-input { direction: rtl; }
                                        .rating-input input { display: none; }
                                        .rating-input label { color: #ddd !important; }
                                        .rating-input label:hover, .rating-input label:hover ~ label, .rating-input input:checked ~ label { color: #ffc107 !important; }
                                    </style>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label text-muted">Your Review (Optional)</label>
                                    <textarea name="comment" id="comment" rows="3" class="form-control" placeholder="What did you think about this product?"></textarea>
                                </div>
                                <button type="submit" class="btn btn-mystic">Submit Review</button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-mystic mb-5" style="background-color: var(--accent-light); color: var(--primary-color);">
                            <i class="fas fa-check-circle me-2"></i> You have already reviewed this product.
                        </div>
                    @endif
                @else
                    <div class="alert alert-light border mb-5">
                        Please <a href="{{ route('login') }}" class="fw-bold text-mystic">login</a> to leave a review.
                    </div>
                @endauth

                <!-- Reviews List -->
                <div class="reviews-list">
                    @forelse($product->reviews as $review)
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>{{ $review->user->name }}</strong>
                                    <span class="text-muted small">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-warning mb-2 small">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                                @if($review->comment)
                                    <p class="mb-0 text-muted">{{ $review->comment }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-muted fst-italic">No reviews yet. Be the first to review this product!</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <!-- Image Zoom Styles and Scripts -->
    <style>
        .image-zoom-container {
            position: relative;
            cursor: crosshair;
        }
        
        .img-zoom-lens {
            position: absolute;
            border: 1px solid #d4d4d4;
            /* set the size of the lens: */
            width: 150px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.4);
            visibility: hidden;
            pointer-events: none; /* Let the mouse events pass through to the image */
        }
        
        .img-zoom-result {
            border: 1px solid #d4d4d4;
            /* set the size of the result div: */
            width: 500px;
            height: 500px;
            position: absolute;
            top: 100px;
            left: calc(50% + 20px); /* Position to the right of the image */
            z-index: 1000;
            background-color: #fff;
            visibility: hidden;
            pointer-events: none;
            /* Center the background image appropriately */
            background-repeat: no-repeat;
        }
    </style>

    <script>
        function imageZoom(imgID, resultID) {
            var img, lens, result, cx, cy;
            img = document.getElementById(imgID);
            result = document.getElementById(resultID);
            lens = document.querySelector(".img-zoom-lens");
            
            // Wait for image to load to get correct dimensions
            img.onload = function() {
                setupZoom();
            }
            
            // If image is already loaded (from cache), run setup immediately
            if(img.complete) {
                setupZoom();
            }
            
            function setupZoom() {
                /* Calculate the ratio between result DIV and lens: */
                cx = result.offsetWidth / lens.offsetWidth;
                cy = result.offsetHeight / lens.offsetHeight;
                
                /* Set background properties for the result DIV */
                result.style.backgroundImage = "url('" + img.src + "')";
                result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
                
                /* Execute a function when someone moves the cursor over the image, or the lens: */
                img.addEventListener("mousemove", moveLens);
                lens.addEventListener("mousemove", moveLens);
                img.addEventListener("mouseenter", showZoom);
                img.addEventListener("mouseleave", hideZoom);
                
                /* And also for touch screens: */
                img.addEventListener("touchmove", moveLens);
                img.addEventListener("touchstart", showZoom);
                img.addEventListener("touchend", hideZoom);
            }
            
            function showZoom() {
                lens.style.visibility = "visible";
                result.style.visibility = "visible";
            }
            
            function hideZoom() {
                lens.style.visibility = "hidden";
                result.style.visibility = "hidden";
            }
            
            function moveLens(e) {
                var pos, x, y;
                /* Prevent any other actions that may occur when moving over the image */
                e.preventDefault();
                /* Get the cursor's x and y positions: */
                pos = getCursorPos(e);
                /* Calculate the position of the lens: */
                x = pos.x - (lens.offsetWidth / 2);
                y = pos.y - (lens.offsetHeight / 2);
                
                /* Prevent the lens from being positioned outside the image: */
                if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
                if (x < 0) {x = 0;}
                if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
                if (y < 0) {y = 0;}
                
                /* Set the position of the lens: */
                lens.style.left = x + "px";
                lens.style.top = y + "px";
                
                /* Display what the lens "sees": */
                result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
            }
            
            function getCursorPos(e) {
                var a, x = 0, y = 0;
                e = e || window.event;
                /* Get the x and y positions of the image: */
                a = img.getBoundingClientRect();
                /* Calculate the cursor's x and y coordinates, relative to the image: */
                x = e.pageX - a.left;
                y = e.pageY - a.top;
                /* Consider any page scrolling: */
                x = x - window.pageXOffset;
                y = y - window.pageYOffset;
                return {x : x, y : y};
            }
        }
        
        // Initialize the zoom function when the DOM is fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            imageZoom("myimage", "myresult");
        });
    </script>
</x-app-layout>
