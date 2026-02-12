<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-5 fw-bold text-center animate__animated animate__fadeInDown">Your Shopping Cart</h2>
        
        <div class="row justify-content-center animate__animated animate__fadeInUp">
            <div class="col-lg-10">
                <div class="card card-custom shadow-sm border-0">
                    <div class="card-body p-4">
                        @if(session('cart'))
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 40%">Product</th>
                                            <th style="width: 15%">Price</th>
                                            <th style="width: 20%">Quantity</th>
                                            <th style="width: 15%" class="text-end">Subtotal</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0 @endphp
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            <tr data-id="{{ $id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-light rounded p-2 me-3 text-muted">
                                                            @if(isset($details['image']))
                                                                <img src="{{ asset('uploads/' . $details['image']) }}" alt="{{ $details['name'] }}" width="50" height="50" class="rounded" style="object-fit:cover;">
                                                            @else
                                                                <i class="fas fa-box fa-2x"></i>
                                                            @endif
                                                        </div>
                                                        <span class="fw-bold">{{ $details['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td>Rs. {{ number_format($details['price']) }}</td>
                                                <td>
                                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" style="width: 80px;" min="1">
                                                </td>
                                                <td class="text-end fw-bold cart-subtotal">
                                                    Rs. {{ number_format($details['price'] * $details['quantity']) }}
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('cart.remove') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $id }}">
                                                        <button class="btn btn-sm btn-outline-danger cart-remove"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="border-top">
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold fs-5">Total</td>
                                            <td class="text-end fw-bold text-primary fs-4 cart-total">Rs. {{ number_format($total) }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url('/products') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                                </a>
                                <a href="{{ route('checkout.index') }}" class="btn btn-mystic btn-lg">
                                    Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>

                        @else
                            <div class="text-center py-5">
                                <div class="mb-3 text-muted">
                                    <i class="fas fa-shopping-cart fa-4x"></i>
                                </div>
                                <h4>Your cart is empty!</h4>
                                <p class="text-muted">Browse our categories and discover our best deals!</p>
                                <a href="{{ url('/products') }}" class="btn btn-mystic mt-3">Start Shopping</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            console.log("Cart Script Loaded");

            $(".update-cart").change(function (e) {
                e.preventDefault();
                var ele = $(this);
                var tr = ele.parents("tr");
                
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
                            // Update Subtotal
                            tr.find(".cart-subtotal").text('Rs. ' + new Intl.NumberFormat().format(response.subtotal));
                            // Update Total
                            $(".cart-total").text('Rs. ' + new Intl.NumberFormat().format(response.total));
                            // Show Toast
                            if(window.showToast) window.showToast("Cart updated!", 'success');
                        }
                    }
                });
            });

            $(".cart-remove").click(function (e) {
                e.preventDefault(); // Stop form from submitting immediately
                var form = $(this).closest("form");
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Review this action properly!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc800',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    background: '#2e0249',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form if confirmed
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
