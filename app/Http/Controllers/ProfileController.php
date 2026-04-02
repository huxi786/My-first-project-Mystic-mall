<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display the user's profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();
        $wishlistItems = $user->wishlists()->with('product')->latest()->get();
        
        return view('profile.edit', compact('user', 'orders', 'wishlistItems'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $this->profileService->updateProfile($request->user(), $request->validated());

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
