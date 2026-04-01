<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * Display a listing of all reviews.
     */
    public function index()
    {
        $reviews = $this->reviewService->getAllReviews();
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        if ($this->reviewService->deleteReview($id)) {
            return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
        }

        return redirect()->route('admin.reviews.index')->with('error', 'Review not found.');
    }
}
