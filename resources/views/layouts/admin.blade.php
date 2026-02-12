<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Mystic Mall</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-sidebar-bg: linear-gradient(180deg, #1a0033 0%, #0d001a 100%);
            --admin-accent: #FFD700;
            --admin-text: #e0e0e0;
            --admin-hover: rgba(255, 215, 0, 0.1);
            --content-bg: #f3f4f6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--content-bg);
            color: #333;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--admin-sidebar-bg);
            color: var(--admin-text);
            padding-top: 2rem;
            box-shadow: 4px 0 20px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--admin-accent);
            text-align: center;
            margin-bottom: 2.5rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        .sidebar-brand i {
            color: var(--admin-accent);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            font-size: 0.95rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background: var(--admin-hover);
            color: var(--admin-accent);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transform: translateX(5px);
        }

        .sidebar-menu li a i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* --- HEADER --- */
        .header {
            background: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            margin-bottom: 2rem;
            border-radius: 16px;
        }

        .header h4 {
            font-family: 'Cinzel', serif;
            color: #2e0249;
            font-weight: 700;
            margin: 0;
        }

        .user-profile {
            cursor: pointer;
            padding: 5px 15px;
            border-radius: 50px;
            transition: 0.3s;
            background: rgba(46, 2, 73, 0.05);
        }
        
        .user-profile:hover {
            background: rgba(46, 2, 73, 0.1);
        }

        /* --- UTILS --- */
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .sidebar { width: 0; margin-left: -260px; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-crown me-2"></i> Mystic Admin
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-bag"></i> Orders
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i> Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i> Reviews
                </a>
            </li>
            <li class="mt-4 border-top border-secondary pt-3">
                 <a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Visit Store
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h4>@yield('title', 'Dashboard')</h4>
            
            <div class="dropdown">
                <div class="user-profile d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center text-warning me-2" style="width: 35px; height: 35px;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <span class="d-block fw-bold text-dark small">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="d-block text-muted" style="font-size: 0.75rem;">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down ms-3 text-muted small"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 rounded-3 overflow-hidden">
                    <li><a class="dropdown-item py-2" href="{{ route('home') }}"><i class="fas fa-store me-2 text-primary"></i> View Store</a></li>
                    <li><hr class="dropdown-divider my-0"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item py-2 text-danger" type="submit"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> 
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const message = "{{ session('success') }}";
                    showToast(message, 'success');
                });
            </script>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0 show mb-2`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i> ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>
