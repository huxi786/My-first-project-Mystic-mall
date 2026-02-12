<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Mystic Mall</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand-primary: #2e0249; /* Deep Purple text */
            --brand-secondary: #570a57;
            --accent-gold: #FFD700;
            --text-dark: #333;
            --text-muted: #666;
            --bg-light: #ffffff;
            --input-border: #e0e0e0;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            overflow-x: hidden;
        }

        .split-screen {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* --- LEFT SIDE: FORM (Light & Clean) --- */
        .left-pane {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            position: relative;
            z-index: 2;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }

        .brand-logo-mobile {
            display: none; /* Only show on mobile if needed */
            margin-bottom: 2rem;
            text-align: center;
        }

        h2.auth-heading {
            font-family: 'Cinzel', serif;
            color: var(--brand-primary);
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 2.5rem;
        }

        p.auth-subtext {
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }

        /* Modern Inputs */
        .form-floating > .form-control {
            border: 2px solid var(--input-border);
            border-radius: 12px;
            background: #f9f9f9;
            color: var(--text-dark);
            font-weight: 500;
        }
        
        .form-floating > .form-control:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(46, 2, 73, 0.1);
            background: #fff;
        }

        .form-floating > label {
            color: #999;
        }

        .icon-absolute {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
            z-index: 5;
        }

        .btn-premium-dark {
            background: var(--brand-primary);
            color: #fff;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            width: 100%;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(46, 2, 73, 0.15);
        }

        .btn-premium-dark:hover {
            background: var(--brand-secondary);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(46, 2, 73, 0.25);
            color: #fff;
        }

        .btn-outline-custom {
            border: 2px solid var(--input-border);
            color: var(--text-dark);
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-outline-custom:hover {
            border-color: var(--brand-primary);
            color: var(--brand-primary);
            background: #fff;
        }

        /* --- RIGHT SIDE: BRAND (Dark & Mystical) --- */
        .right-pane {
            flex: 1;
            background: radial-gradient(circle at center, #3a025c 0%, #120024 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            color: #fff;
            text-align: center;
        }

        .brand-content {
            z-index: 10;
            position: relative;
        }

        .brand-huge-text {
            font-family: 'Cinzel', serif;
            font-size: 5rem;
            font-weight: 900;
            color: var(--accent-gold);
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .brand-tagline {
            font-size: 1.2rem;
            letter-spacing: 2px;
            opacity: 0.8;
            font-weight: 300;
        }

        /* Floating Orb Animation */
        .floating-orb {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 6s infinite alternate;
        }

        @keyframes pulse { 0% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; } 100% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; } }

        /* Responsive */
        @media (max-width: 768px) {
            .right-pane { display: none; }
            .brand-logo-mobile { display: block; }
        }

    </style>
</head>
<body>

<div class="split-screen">
    <!-- LEFT SIDE: LOGIN FORM -->
    <div class="left-pane">
        <div class="auth-container">
            <div class="brand-logo-mobile">
                <img src="{{ asset('images/logo.png') }}" alt="Mystic Mall" width="60" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
            </div>

            <h2 class="auth-heading">Welcome Back</h2>
            <p class="auth-subtext">Please enter your details to sign in.</p>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                
                @if (session('success'))
                    <div class="alert alert-success py-2 small mb-4 rounded-3 border-0 bg-success-subtle text-success">
                       <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger py-2 small mb-4 rounded-3 border-0 bg-danger-subtle text-danger">
                       <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <div class="form-floating mb-3 position-relative">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Email address</label>
                    <i class="fas fa-envelope icon-absolute"></i>
                </div>

                <div class="form-floating mb-4 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    <i class="fas fa-eye icon-absolute" id="togglePassword" style="cursor: pointer;"></i>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const togglePassword = document.querySelector('#togglePassword');
                        const password = document.querySelector('#password');

                        togglePassword.addEventListener('click', function (e) {
                            // toggle the type attribute
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            // toggle the eye slash icon
                            this.classList.toggle('fa-eye-slash');
                            this.classList.toggle('fa-eye');
                        });
                    });
                </script>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-muted small" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="text-decoration-none small fw-semibold" style="color: var(--brand-primary);">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-premium-dark mb-3">
                    Sign In
                </button>

                <div class="text-center">
                    <p class="text-muted small mb-3">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-custom">
                        Create Account
                    </a>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none small">
                        <i class="fas fa-arrow-left me-1"></i> Back to Home
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- RIGHT SIDE: BRANDING -->
    <div class="right-pane">
        <div class="floating-orb"></div>
        <div class="brand-content">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="120" class="mb-4" style="filter: drop-shadow(0 0 20px rgba(255,215,0,0.4));">
            <div class="brand-huge-text">MYSTIC<br>MALL</div>
            <p class="brand-tagline">Experience the Extraordinary</p>
        </div>
    </div>
</div>

</body>
</html>
