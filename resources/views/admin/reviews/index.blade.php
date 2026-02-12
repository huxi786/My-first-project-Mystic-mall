@extends('layouts.admin')

@section('title', 'Review Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom bg-white shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark mb-0"><i class="fas fa-star me-2 text-warning"></i>User Reviews</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($review->product)
                                            <img src="{{ asset('uploads/' . $review->product->image) }}" alt="Img" class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $review->product->name }}</div>
                                                <small class="text-muted">ID: #{{ $review->product_id }}</small>
                                            </div>
                                        @else
                                            <span class="text-danger">Product Deleted</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; font-weight: bold; color: var(--primary-color);">
                                            {{ substr($review->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span>{{ $review->user->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted opacity-25' }} small"></i>
                                    @endfor
                                </td>
                                <td style="max-width: 300px;">
                                    <p class="mb-0 text-muted small text-truncate" title="{{ $review->comment }}">
                                        {{ $review->comment }}
                                    </p>
                                </td>
                                <td class="text-muted small">
                                    {{ $review->created_at->format('d M Y') }}
                                </td>
                                <td class="text-end pe-4">
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0; line-height: 32px;" title="Delete Review">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted opacity-50 mb-2"><i class="far fa-comment-dots fa-3x"></i></div>
                                    <h6 class="text-muted">No reviews found</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center pt-4">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
