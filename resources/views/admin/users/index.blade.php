@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom bg-white p-4">
            <h5 class="fw-bold text-dark mb-4">Registered Users & Activity</h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Last Logout</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @php
                                $lastActivity = $user->loginActivities->sortByDesc('login_at')->first();
                                $isOnline = $lastActivity && is_null($lastActivity->logout_at) && $lastActivity->login_at->diffInMinutes(now()) < 120; // Assume offline if login > 2 hours ago without logout, or adjust logic
                                // Better logic: if logout_at is null, they might be online. But sessions expire.
                                // Let's just show "Active Session" if logout_at is null.
                                $status = $lastActivity && is_null($lastActivity->logout_at) ? 'online' : 'offline';
                            @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-3" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        @if($user->is_admin)
                                            <span class="badge bg-warning text-dark" style="font-size: 0.7rem;">Admin</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($status === 'online')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        <i class="fas fa-circle me-1 small"></i> Online
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">
                                        <i class="fas fa-circle me-1 small"></i> Offline
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($lastActivity)
                                    {{ $lastActivity->login_at->format('M d, Y h:i A') }}
                                    <div class="small text-muted">{{ $lastActivity->login_at->diffForHumans() }}</div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($lastActivity && $lastActivity->logout_at)
                                    {{ $lastActivity->logout_at->format('M d, Y h:i A') }}
                                @elseif($lastActivity && is_null($lastActivity->logout_at))
                                    <span class="text-success small fw-bold">Active Session</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ $lastActivity->ip_address ?? '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
