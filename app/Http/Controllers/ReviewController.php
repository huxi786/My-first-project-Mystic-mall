<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ReviewRequest;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(ReviewRequest $request, Product $product)
    {
        $result = $this->reviewService->storeReview($product, $request->validated());

        if ($result['status'] == 'error') {
            return back()->with('error', $result['message']);
        }

        return back()->with('success', $result['message']);
    }
}
