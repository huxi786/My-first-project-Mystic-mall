@extends('layouts.admin')

@section('title', 'Manage Flash Deals')

@section('content')
<style>
    .lux-card {
        background: #fff;
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .lux-table-header {
        background: linear-gradient(to right, #2e0249, #a68a2d);
        color: #fff;
        padding: 25px 30px;
        border: none;
    }

    .lux-table-header h5 {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0;
    }

    .lux-table-header p {
        margin: 0;
        opacity: 0.8;
    }

    .table-premium thead th {
        background: #f8f9fa !important;
        color: #2e0249 !important;
        font-family: 'Cinzel', serif;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        padding: 20px 15px;
        border-bottom: 2px solid #eee;
    }

    .table-premium tbody td {
        padding: 18px 15px;
        vertical-align: middle;
        color: #555;
        border-bottom: 1px solid #f1f1f1;
    }

    .badge-flash {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .timer-text {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        color: #2e0249;
    }

    .btn-remove-flash {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: none;
        padding: 8px 15px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-remove-flash:hover {
        background: #dc3545;
        color: #fff;
        transform: translateY(-2px);
    }
</style>

<div class="lux-card">
    <div class="lux-table-header d-flex justify-content-between align-items-center">
        <div>
            <h5>Active Flash Deals ⚡</h5>
            <p class="small text-white-50 mb-0">High-impact limited time offers</p>
        </div>
        <a href="{{ route('admin.products') }}" class="btn btn-light px-4 fw-bold text-dark shadow-sm" style="border-radius: 12px;">
            <i class="fas fa-plus me-2"></i> Add From Inventory
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-premium align-middle">
            <thead>
                <tr>
                    <th class="ps-4">Product</th>
                    <th>Orig. Price</th>
                    <th>Disc. Price</th>
                    <th>Ends At</th>
                    <th class="text-center pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flashDeals as $product)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('uploads/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 width="50" height="50" class="rounded me-3" style="object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $product->name }}</h6>
                                <span class="badge-flash">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-muted text-decoration-line-through">Rs. {{ number_format($product->price) }}</td>
                    <td class="fw-bold text-danger">Rs. {{ number_format($product->discount_price) }}</td>
                    <td>
                        <div class="timer-text">
                            <i class="far fa-clock me-1"></i> {{ $product->flash_deal_end }}
                        </div>
                    </td>
                    <td class="text-center pe-4">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; display: flex; align-items: center; justify-content: center; padding: 8px 12px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.flash-sales.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove Flash Sale status from this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove-flash">
                                    <i class="fas fa-trash-alt me-1"></i> Remove
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted mb-3"><i class="fas fa-bolt fa-4x opacity-25"></i></div>
                        <h4 class="text-dark fw-bold">No Active Flash Sales</h4>
                        <p class="text-muted">High value deals will appear here once activated from the products section.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 d-flex justify-content-center border-top">
        {{ $flashDeals->links() }}
    </div>
</div>
@endsection
