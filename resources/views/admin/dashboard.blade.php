@extends('layouts.admin')

@section('title', 'Control Center')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .stat-card {
        background: linear-gradient(135deg, #2e0249 0%, #1a002b 100%);
        border: 1px solid rgba(255, 215, 0, 0.1);
        border-radius: 20px;
        padding: 25px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        color: #fff;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(46, 2, 73, 0.3);
        border-color: rgba(255, 215, 0, 0.3);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05));
        skew-x: -20deg;
    }

    .stat-icon-bg {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5rem;
        color: rgba(255, 215, 0, 0.05); /* Very subtle gold watermark */
        transform: rotate(-15deg);
        transition: all 0.3s;
    }

    .stat-card:hover .stat-icon-bg {
        transform: rotate(0deg) scale(1.1);
        color: rgba(255, 215, 0, 0.1);
    }

    .stat-icon-circle {
        width: 50px;
        height: 50px;
        background: rgba(255, 215, 0, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffc800;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .table-custom th {
        background-color: #f8f9fa;
        color: #666;
        font-weight: 600;
        border-top: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
</style>

<!-- Top Stats Row -->
<div class="row g-4 mb-5">
    <!-- Total Revenue -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-bg"><i class="fas fa-wallet"></i></div>
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-icon-circle"><i class="fas fa-wallet"></i></div>
                    <h5 class="text-white-50 text-uppercase small letter-spacing-1 mb-1">Total Revenue</h5>
                    <h2 class="fw-bold mb-0 text-white">Rs. {{ number_format($totalRevenue) }}</h2>
                </div>
            </div>
            <div class="mt-3 small text-white-50">
                <i class="fas fa-arrow-up text-success me-1"></i> Lifetime Earnings
            </div>
        </div>
    </div>

    <!-- Monthly Earnings -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-bg"><i class="fas fa-calendar-check"></i></div>
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-icon-circle"><i class="fas fa-chart-line"></i></div>
                    <h5 class="text-white-50 text-uppercase small letter-spacing-1 mb-1">This Month</h5>
                    <h2 class="fw-bold mb-0 text-white">Rs. {{ number_format($monthlyEarnings) }}</h2>
                </div>
            </div>
            <div class="mt-3 small text-white-50">
                <i class="fas fa-circle text-warning me-1" style="font-size: 8px;"></i> Current Performance
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-bg"><i class="fas fa-shopping-bag"></i></div>
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-icon-circle"><i class="fas fa-shopping-bag"></i></div>
                    <h5 class="text-white-50 text-uppercase small letter-spacing-1 mb-1">Total Orders</h5>
                    <h2 class="fw-bold mb-0 text-white">{{ number_format($totalOrders) }}</h2>
                </div>
            </div>
            <div class="mt-3 small text-white-50">
                <i class="fas fa-truck text-info me-1"></i> Orders Processed
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-bg"><i class="fas fa-users"></i></div>
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-icon-circle"><i class="fas fa-users"></i></div>
                    <h5 class="text-white-50 text-uppercase small letter-spacing-1 mb-1">Active Users</h5>
                    <h2 class="fw-bold mb-0 text-white">{{ number_format($totalUsers) }}</h2>
                </div>
            </div>
            <div class="mt-3 small text-white-50">
                <i class="fas fa-user-plus text-primary me-1"></i> Registered Clients
            </div>
        </div>
    </div>
</div>

<!-- Low Stock Alert -->
@if($lowStockProducts->count() > 0)
<div class="alert alert-danger d-flex align-items-center mb-5 shadow-sm rounded-3" role="alert">
    <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
    <div>
        <h5 class="alert-heading fw-bold mb-1">Low Stock Alert!</h5>
        <p class="mb-0">
            The following products are running low: 
            @foreach($lowStockProducts as $product)
                <span class="badge bg-white text-danger border border-danger me-1">{{ $product->name }} ({{ $product->stock }})</span>
            @endforeach
            <a href="{{ route('admin.products') }}" class="fw-bold text-danger ms-2">Manage Inventory</a>
        </p>
    </div>
</div>
@endif

<div class="row mb-5">
    <!-- Sales Chart -->
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="card card-custom h-100 shadow-sm border-0">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-4"><i class="fas fa-chart-area me-2 text-primary"></i>Sales Analytics (Last 7 Days)</h5>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-lg-4">
        <div class="card card-custom h-100 shadow-sm border-0">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-4"><i class="fas fa-user-clock me-2 text-info"></i>New Users</h5>
                <div class="list-group list-group-flush">
                    @foreach($recentUsers as $user)
                    <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center">
                        <div class="avatar-circle me-3">{{ substr($user->name, 0, 1) }}</div>
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-light text-primary fw-bold w-100">View All Users</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Orders -->
    <div class="col-lg-12">
        <div class="card card-custom shadow-sm border-0 mb-5">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark mb-0"><i class="fas fa-history me-2 text-warning"></i>Recent Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary-mystic rounded-pill">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-custom mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                <td>{{ $order->full_name }}</td>
                                <td class="fw-bold text-success">Rs. {{ number_format($order->total_price) }}</td>
                                <td>
                                    @if($order->status == 'Pending') <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->status == 'Shipped') <span class="badge bg-info text-dark">Shipped</span>
                                    @elseif($order->status == 'Delivered') <span class="badge bg-success">Delivered</span>
                                    @else <span class="badge bg-secondary">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4 text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-custom bg-white p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                 <div>
                     <h5 class="fw-bold text-dark mb-1">Product Inventory</h5>
                     <p class="text-muted small mb-0">Manage your store's catalog</p>
                 </div>
                 <a href="{{ route('admin.products.create') }}" class="btn btn-primary-mystic rounded-pill px-4 shadow-sm py-2">
                    <i class="fas fa-plus me-2"></i> Add New Product
                </a>
            </div>
           
            <div class="accordion accordion-flush" id="categoryAccordion">
                @forelse($productsByCategory as $category => $products)
                    <div class="accordion-item border mb-3 rounded-3 overflow-hidden shadow-sm">
                        <h2 class="accordion-header" id="heading{{ Str::slug($category) }}">
                            <button class="accordion-button collapsed fw-bold text-dark bg-white py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ Str::slug($category) }}" aria-expanded="false" aria-controls="collapse{{ Str::slug($category) }}">
                                <span class="badge bg-light text-dark border me-3 rounded-pill px-3">{{ count($products) }} Items</span> 
                                <span class="text-uppercase letter-spacing-1">{{ $category }}</span>
                            </button>
                        </h2>
                        <div id="collapse{{ Str::slug($category) }}" class="accordion-collapse collapse" aria-labelledby="heading{{ Str::slug($category) }}" data-bs-parent="#categoryAccordion">
                            <div class="accordion-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-custom table-hover align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-4">Item</th>
                                                <th>Price</th>
                                                <th>Stock Status</th>
                                                <th class="text-end pe-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('uploads/' . $product->image) }}" alt="Product" class="rounded-3 shadow-sm me-3" width="48" height="48" style="object-fit: cover;">
                                                        <div>
                                                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                                                            <div class="text-muted small">ID: #{{ $product->id }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fw-bold" style="color: #2e0249;">Rs. {{ number_format($product->price) }}</td>
                                                <td>
                                                    @if($product->stock > 0)
                                                        <span class="badge bg-success-subtle text-success rounded-pill px-3">In Stock ({{ $product->stock }})</span>
                                                    @else
                                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Out of Stock</span>
                                                    @endif
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light text-primary me-2 rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0; line-height: 32px;" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0; line-height: 32px;" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <img src="{{ asset('images/empty-box.png') }}" alt="Empty" width="100" class="mb-3 opacity-50">
                        <h5 class="text-muted">No products found</h5>
                        <p class="text-muted small">Start by adding your first product to the inventory.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Create Premium Gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(46, 2, 73, 0.4)'); // Deep Mystic Purple
    gradient.addColorStop(1, 'rgba(46, 2, 73, 0.0)'); // Transparent at bottom

    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesData->keys()) !!},
            datasets: [{
                label: 'Daily Sales',
                data: {!! json_encode($salesData->values()) !!},
                borderColor: '#ffc800', /* Gold Line for visibility */
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#2e0249', /* Purple Points */
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4, /* Smooth Curve */
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(46, 2, 73, 0.9)',
                    titleColor: '#ffc800',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 215, 0, 0.3)',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return ' Sales: Rs. ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        color: '#666',
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#666',
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 11
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
