<x-app-layout>
    <div class="container py-5" style="margin-top: 50px;">
        <h2 class="mb-4 fw-bold animate__animated animate__fadeInDown" style="color: var(--primary-color);">Shopping Cart</h2>
        
        @if(session('cart'))
            <div class="row g-4 animate__animated animate__fadeInUp">
                <!-- Cart Items List (Column 8) -->
                <div class="col-lg-8">
                    <div class="card card-custom shadow-sm border-0">
                        <div class="card-body p-0">
                            <!-- Desktop Headers -->
                            <div class="d-none d-md-flex px-4 py-3 bg-light border-bottom text-muted fw-bold small text-uppercase">
                                <div style="width: 50%;">Product Details</div>
                                <div style="width: 20%;" class="text-center">Quantity</div>
                                <div style="width: 20%;" class="text-end">Price</div>
                                <div style="width: 10%;"></div>
                            </div>
                            
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <div class="cart-item-row p-4 border-bottom position-relative" data-id="{{ $id }}">
                                    <div class="d-flex flex-column flex-md-row align-items-md-center">
                                        <!-- Product Info -->
                                        <div class="d-flex align-items-center mb-3 mb-md-0" style="width: 100%; md-width: 50%;">
                                            <div class="cart-item-img-wrap me-3">
                                                @if(isset($details['image']))
                                                    <img src="{{ Str::startsWith($details['image'], 'http') ? $details['image'] : asset('uploads/' . $details['image']) }}" alt="{{ $details['name'] }}">
                                                @else
                                                    <i class="fas fa-image text-muted fa-2x d-flex align-items-center justify-content-center w-100 h-100 bg-light"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1 text-truncate" style="max-width: 200px;">{{ $details['name'] }}</h6>
                                                @if(isset($details['is_flash']) && $details['is_flash'])
                                                    <span class="badge bg-danger rounded-pill" style="font-size: 0.65rem;">FLASH DEAL</span>
                                                @else
                                                    <span class="text-muted small">Standard Item</span>
                                                @endif
                                                <div class="d-block d-md-none text-primary fw-bold mt-1">Rs. {{ number_format($details['price']) }}</div>
                                            </div>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="d-flex align-items-center justify-content-between mb-3 mb-md-0" style="width: 100%; md-width: 20%;">
                                            <span class="d-md-none text-muted small fw-bold">Qty:</span>
                                            <div class="quantity-wrapper mx-md-auto">
                                                <button type="button" class="qty-btn btn-minus"><i class="fas fa-minus"></i></button>
                                                <input type="number" value="{{ $details['quantity'] }}" class="quantity-input update-cart" min="1">
                                                <button type="button" class="qty-btn btn-plus"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="d-none d-md-block text-end fw-bold cart-subtotal" style="width: 20%; color: var(--primary-color);">
                                            Rs. {{ number_format($details['price'] * $details['quantity']) }}
                                        </div>

                                        <!-- Action -->
                                        <div class="text-end text-md-center mt-2 mt-md-0 position-absolute position-md-static" style="top: 15px; right: 20px; width: auto; md-width: 10%;">
                                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button class="btn btn-link text-danger p-0 cart-remove hint-tooltip" title="Remove Item"><i class="fas fa-times fs-5"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="d-md-none text-end w-100 fw-bold border-top pt-2 mt-2 cart-subtotal" style="color: var(--primary-color);">
                                        Subtotal: Rs. {{ number_format($details['price'] * $details['quantity']) }}
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="p-4 bg-light text-start border-top rounded-bottom">
                                <a href="{{ url('/products') }}" class="btn btn-outline-mystic rounded-pill">
                                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary (Column 4 Sticky) -->
                <div class="col-lg-4">
                    <div class="card card-custom shadow-sm border-0 sticky-top" style="top: 100px; z-index: 10;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-3">Order Summary</h5>
                            
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Subtotal</span>
                                <span class="fw-bold text-dark cart-total-summary">Rs. {{ number_format($total) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Shipping Estimate</span>
                                <span class="fw-bold text-dark">Calculated at checkout</span>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total Amount</span>
                                <span class="fw-bold fs-4 cart-total" style="color: var(--accent-color); text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Rs. {{ number_format($total) }}</span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="btn btn-luxury-cart w-100 rounded-pill mb-3">
                                <span>Checkout securely</span>
                                <i class="fas fa-lock btn-icon"></i>
                            </a>
                            
                            <div class="text-center text-muted small">
                                <i class="fas fa-shield-alt me-1 text-success"></i> Secure, encrypted checkout.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <div class="card card-custom border-0 shadow-sm py-5">
                        <div class="mb-4">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-shopping-bag fa-3x text-muted opacity-50"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-mystic mb-3">Your Cart is Empty</h3>
                        <p class="text-muted mb-4 px-4">Looks like you haven't added anything to your cart yet. Discover our premium collections and find something you love.</p>
                        <a href="{{ url('/products') }}" class="btn btn-mystic btn-lg rounded-pill px-5 shadow-sm">Start Shopping</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Custom increment/decrement logic
            $('.btn-plus').click(function() {
                let input = $(this).siblings('.quantity-input');
                let val = parseInt(input.val()) + 1;
                input.val(val).trigger('change');
            });

            $('.btn-minus').click(function() {
                let input = $(this).siblings('.quantity-input');
                let val = parseInt(input.val()) - 1;
                if(val >= 1) {
                    input.val(val).trigger('change');
                }
            });

            $(".update-cart").change(function (e) {
                e.preventDefault();
                var ele = $(this);
                clearTimeout(ele.data('timer')); // Debounce
                ele.data('timer', setTimeout(function(){
                    var tr = ele.closest(".cart-item-row");
                    
                    $.ajax({
                        url: '{{ route('cart.update') }}',
                        method: "patch",
                        data: {
                            _token: '{{ csrf_token() }}', 
                            id: tr.attr("data-id"), 
                            quantity: ele.val()
                        },
                        success: function (response) {
                            if(response.success) {
                                let subFormatted = 'Rs. ' + new Intl.NumberFormat().format(response.subtotal);
                                let totFormatted = 'Rs. ' + new Intl.NumberFormat().format(response.total);
                                
                                // Update Subtotals (desktop and mobile view)
                                tr.find(".cart-subtotal").text(subFormatted);
                                // Mobile subtotal text correction
                                if(window.innerWidth < 768) {
                                     tr.find(".d-md-none.cart-subtotal").text("Subtotal: " + subFormatted);
                                }
                                
                                // Update Totals
                                $(".cart-total").text(totFormatted);
                                $(".cart-total-summary").text(totFormatted);
                                
                                if(window.showToast) window.showToast("Cart updated successfully!", 'success');
                            }
                        }
                    });
                }, 300));
            });

            $(".cart-remove").click(function (e) {
                e.preventDefault(); // Stop form from submitting immediately
                var form = $(this).closest("form");
                
                Swal.fire({
                    title: 'Remove Item?',
                    text: "Are you sure you want to remove this item from your cart?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc800',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it',
                    background: '#ffffff',
                    color: '#2e0249',
                    borderRadius: '15px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
