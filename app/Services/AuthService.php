<?php

namespace App\Services;

use App\Models\User;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    /**
     * Handle user registration.
     */
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle user login logic.
     */
    public function attemptLogin(array $credentials, Request $request): bool
    {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $this->logActivity($request);
            $this->setWelcomeFlash($request);
            return true;
        }

        return false;
    }

    /**
     * Log user login activity.
     */
    private function logActivity(Request $request): void
    {
        LoginActivity::create([
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /**
     * Set welcome flash messages based on login count.
     */
    private function setWelcomeFlash(Request $request): void
    {
        $loginCount = LoginActivity::where('user_id', Auth::id())->count();
        $type = ($loginCount == 1) ? 'first' : 'returning';
        
        $request->session()->flash('welcome_type', $type);
        $request->session()->flash('welcome_name', Auth::user()->name);
    }

    /**
     * Handle user logout and log the exit time.
     */
    public function logout(Request $request): void
    {
        if (Auth::check()) {
            $activity = LoginActivity::where('user_id', Auth::id())
                        ->whereNull('logout_at')
                        ->latest('login_at')
                        ->first();
            
            if ($activity) {
                $activity->update(['logout_at' => now()]);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
