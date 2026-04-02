<x-app-layout>
    <div class="container-fluid py-5" style="margin-top: 90px; background: #0f021a; min-height: 100vh;">
        <div class="container">
            <!-- Premium Header -->
            <div class="row mb-5 align-items-center animate__animated animate__fadeIn">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-4">
                        <div class="profile-avatar-large shadow-lg">
                            <span class="initial">{{ substr($user->name, 0, 1) }}</span>
                            <div class="online-indicator"></div>
                        </div>
                        <div>
                            <h1 class="text-white display-5 fw-bold mb-1">Assalam-o-Alaikum, {{ explode(' ', $user->name)[0] }}!</h1>
                            <p class="text-white-50 mb-0"><i class="fas fa-medal text-accent me-2"></i> Premium Mystic Member since {{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <button class="btn btn-mystic btn-lg rounded-pill" onclick="confirmLogout(event)">
                        <i class="fas fa-sign-out-alt me-2"></i> Secure Logout
                    </button>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-gradient"><i class="fas fa-box"></i></div>
                        <div class="stat-info">
                            <h3 class="stat-value">{{ $orders->count() }}</h3>
                            <p class="stat-label">Total Orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-accent-gradient"><i class="fas fa-wallet"></i></div>
                        <div class="stat-info">
                            <h3 class="stat-value">Rs. {{ number_format($orders->sum('total_price')) }}</h3>
                            <p class="stat-label">Total Spent</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-danger-gradient"><i class="fas fa-heart"></i></div>
                        <div class="stat-info">
                            <h3 class="stat-value">{{ $wishlistItems->count() }}</h3>
                            <p class="stat-label">Wishlist Items</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 overflow-hidden">
                <!-- Sidebar Nav -->
                <div class="col-lg-3 animate__animated animate__fadeInLeft">
                    <div class="dashboard-sidebar shadow-lg border">
                        <ul class="nav flex-column dash-nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#overview">
                                    <i class="fas fa-th-large"></i> Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#orders">
                                    <i class="fas fa-shopping-bag"></i> My Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#wishlist">
                                    <i class="fas fa-heart"></i> Wishlist
                                </a>
                            </li>
                            <li class="nav-item border-top mt-3 pt-3">
                                <a class="nav-link" data-bs-toggle="tab" href="#settings">
                                    <i class="fas fa-user-cog"></i> Account Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9 animate__animated animate__fadeInRight">
                    <div class="tab-content dashboard-content-area">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview">
                            <div class="glass-card mb-4">
                                <h4 class="text-white mb-4">Recent Activity</h4>
                                @if($orders->isNotEmpty())
                                    <div class="recent-order-highlight">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge bg-accent text-dark">LATEST ORDER</span>
                                            <span class="text-white-50">#{{ $orders->first()->tid }}</span>
                                        </div>
                                        <h5 class="text-white mb-2">Total Amount: Rs. {{ number_format($orders->first()->total_price) }}</h5>
                                        <p class="text-white-50 small mb-0">Status: <span class="text-accent fw-bold">{{ strtoupper($orders->first()->status) }}</span></p>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-shopping-cart text-white-50 fs-1 mb-3"></i>
                                        <p class="text-white">No active orders yet. Start shopping!</p>
                                        <div class="mt-3">
                                            <a href="{{ url('/products') }}" class="btn btn-mystic rounded-pill px-4">Explore Collections</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Orders Tab -->
                        <div class="tab-pane fade" id="orders">
                            <div class="glass-card p-0 overflow-hidden">
                                <div class="p-4 border-bottom border-secondary">
                                    <h4 class="text-white mb-0">Order History</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover mb-0 custom-dash-table">
                                        <thead>
                                            <tr>
                                                <th>Reference</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $order)
                                            <tr>
                                                <td class="fw-bold text-accent">#{{ $order->tid }}</td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td>Rs. {{ number_format($order->total_price) }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'pending' ? 'bg-warning text-dark' : 'bg-primary') }}">
                                                        {{ strtoupper($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/invoicing/' . $order->id) }}" target="_blank" class="btn btn-sm btn-outline-light rounded-pill">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-white-50">No orders found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist Tab -->
                        <div class="tab-pane fade" id="wishlist">
                            <div class="row g-4">
                                @forelse($wishlistItems as $item)
                                    @if($item->product)
                                    <div class="col-md-4">
                                        <div class="wish-item-card glass-card">
                                            <div class="wish-img-container mb-3">
                                                <img src="{{ Str::startsWith($item->product->image, 'http') ? $item->product->image : asset('uploads/' . $item->product->image) }}" class="img-fluid rounded shadow" alt="{{ $item->product->name }}" onerror="this.src='{{ asset('images/hero (2).jpg') }}'">
                                            </div>
                                            <h6 class="text-white text-truncate">{{ $item->product->name }}</h6>
                                            <p class="text-accent fw-bold small mb-3">Rs. {{ number_format($item->product->price) }}</p>
                                            <div class="d-grid">
                                                <a href="{{ route('product.show', $item->product_id) }}" class="btn btn-mystic btn-sm rounded-pill">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <div class="glass-card">
                                            <i class="fas fa-heart text-danger fs-1 mb-3"></i>
                                            <h5 class="text-white">Your Wishlist is Empty</h5>
                                            <p class="text-white-50 mb-0">Save items you love to find them easily later.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Settings Tab -->
                        <div class="tab-pane fade" id="settings">
                            <div class="glass-card">
                                <h4 class="text-white mb-4">Account Information</h4>
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 rounded-pill px-4 mb-4" role="alert">
                                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label text-white-50 small">FULL NAME</label>
                                            <input type="text" name="name" class="form-control pro-input" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white-50 small">EMAIL ADDRESS</label>
                                            <input type="email" name="email" class="form-control pro-input" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                    </div>

                                    <hr class="my-5 border-secondary opacity-25">
                                    <h4 class="text-white mb-4">Security Settings</h4>
                                    
                                    <div class="mb-4">
                                        <label class="form-label text-white-50 small">CURRENT PASSWORD</label>
                                        <input type="password" name="current_password" class="form-control pro-input" placeholder="Enter strictly if changing password">
                                    </div>
                                    <div class="row g-4 mb-5">
                                        <div class="col-md-6">
                                            <label class="form-label text-white-50 small">NEW PASSWORD</label>
                                            <input type="password" name="password" class="form-control pro-input">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white-50 small">CONFIRM NEW PASSWORD</label>
                                            <input type="password" name="password_confirmation" class="form-control pro-input">
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-mystic btn-lg px-5 rounded-pill shadow-lg border-0">Save Profile Settings</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard CSS -->
    <style>
        /* Avatar & Branding */
        .profile-avatar-large {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ffc800 0%, #ff8c00 100%);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #2e0249;
            font-weight: 800;
            position: relative;
            transform: rotate(-3deg);
            box-shadow: 0 10px 30px rgba(255, 200, 0, 0.3);
        }
        .online-indicator {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 25px;
            height: 25px;
            background: #00ff88;
            border: 4px solid #0f021a;
            border-radius: 50%;
            box-shadow: 0 0 15px #00ff88;
        }

        /* Stats Cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-color);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }
        .bg-primary-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); }
        .bg-accent-gradient { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .bg-danger-gradient { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); }

        .stat-value { font-size: 1.8rem; font-weight: 800; color: #fff; margin-bottom: 0; }
        .stat-label { font-size: 0.85rem; color: #a1a1aa; margin-bottom: 0; text-transform: uppercase; letter-spacing: 1px; }

        /* Sidebar Nav */
        .dashboard-sidebar {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 20px;
        }
        .dash-nav .nav-link {
            color: #d1d1d6;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .dash-nav .nav-link i { font-size: 1.1rem; }
        .dash-nav .nav-link:hover, .dash-nav .nav-link.active {
            background: rgba(255, 200, 0, 0.08);
            color: var(--accent-color);
            transform: translateX(5px);
        }

        /* Glass Cards & Forms */
        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 30px;
        }
        .recent-order-highlight {
            background: rgba(46, 2, 73, 0.4);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255, 200, 0, 0.15);
        }
        .pro-input {
            background: rgba(255,255,255,0.06) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: #fff !important;
            padding: 12px 20px !important;
            border-radius: 12px !important;
            font-weight: 400 !important;
        }
        .pro-input:focus {
            border-color: var(--accent-color) !important;
            background: rgba(255,255,255,0.08) !important;
            box-shadow: 0 0 20px rgba(255, 200, 0, 0.15) !important;
        }

        /* Tables & Lists */
        .custom-dash-table { background: transparent !important; }
        .custom-dash-table th {
            background: rgba(255,255,255,0.05);
            border: none;
            padding: 20px;
            color: #d1d1d6;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        .custom-dash-table td {
            background: transparent;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 22px 20px;
            vertical-align: middle;
            color: #fff;
        }

        .wish-img-container {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #fff;
            border-radius: 18px;
        }
        .wish-img-container img { height: 90%; object-fit: contain; }

        @media (max-width: 991px) {
            .dashboard-sidebar { margin-bottom: 30px; }
            .dash-nav { flex-direction: row !important; overflow-x: auto; flex-wrap: nowrap; gap: 10px; }
            .dash-nav .nav-link { white-space: nowrap; font-size: 0.85rem; padding: 12px 15px; }
        }
    </style>
</x-app-layout>
