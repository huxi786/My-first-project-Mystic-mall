<x-app-layout>
    <div class="container py-5" style="margin-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-mystic p-4 text-center">
                        <div class="avatar-circle bg-white text-primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem; line-height: 80px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <h3 class="text-white mb-0">Profile Settings</h3>
                        <p class="text-white-50 mb-0">Manage your account information</p>
                    </div>
                    
                    <div class="card-body p-5">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <h5 class="text-primary mb-4"><i class="fas fa-user-circle me-2"></i>Personal Information</h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <hr class="my-5 opacity-10">

                            <h5 class="text-primary mb-4"><i class="fas fa-lock me-2"></i>Change Password <small class="text-muted fw-normal">(Optional)</small></h5>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase">Current Password</label>
                                <input type="password" name="current_password" class="form-control form-control-lg" placeholder="Enter strictly if changing password">
                            </div>

                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">New Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('home') }}" class="btn btn-light btn-lg me-3">Cancel</a>
                                <button type="submit" class="btn btn-mystic btn-lg px-5">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .bg-gradient-mystic {
            background: linear-gradient(135deg, #2e0249 0%, #5a0441 100%);
        }
        .form-control-lg {
            border-radius: 10px;
            font-size: 1rem;
            padding: 0.8rem 1.2rem;
        }
        .form-control:focus {
            border-color: #ffc800;
            box-shadow: 0 0 0 0.25rem rgba(255, 200, 0, 0.1);
        }
    </style>
</x-app-layout>
