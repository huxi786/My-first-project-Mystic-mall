@extends('layouts.admin')

@section('title', 'Manage Products')

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
        background: linear-gradient(to right, #2e0249, #4a0e69);
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

    .table-premium {
        margin-bottom: 0;
    }

    .table-premium thead th {
        background: #f8f9fa;
        color: #2e0249;
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

    .table-premium tbody tr:hover {
        background-color: rgba(46, 2, 73, 0.02);
    }

    .product-img-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border: 2px solid #fff;
    }

    .badge-lux {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .badge-purple { background: rgba(46, 2, 73, 0.1); color: #2e0249; }
    .badge-gold { background: rgba(212, 175, 55, 0.1); color: #a68a2d; }
    .badge-success-lux { background: rgba(25, 135, 84, 0.1); color: #198754; }
    .badge-danger-lux { background: rgba(220, 53, 69, 0.1); color: #dc3545; }

    .action-btn {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
    }

    .btn-edit-lux { background: rgba(0, 123, 255, 0.1); color: #007bff; }
    .btn-edit-lux:hover { background: #007bff; color: #fff; transform: translateY(-2px); }

    .btn-delete-lux { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .btn-delete-lux:hover { background: #dc3545; color: #fff; transform: translateY(-2px); }

    .price-text {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #2e0249;
    }

    /* Search & Filter Header */
    .controls-wrapper {
        padding: 20px 30px;
        background: #fff;
        border-bottom: 1px solid #f1f1f1;
    }
</style>

<div class="lux-card">
    <div class="lux-table-header d-flex justify-content-between align-items-center">
        <div>
            <h5>Product Collection</h5>
            <p class="small text-white-50 mb-0">Manage your premium inventory items</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-light px-4 fw-bold text-primary shadow-sm" style="border-radius: 12px;">
            <i class="fas fa-plus me-2"></i> Add New Product
        </a>
    </div>

    <div class="controls-wrapper">
        <div class="row g-3">
            <div class="col-md-8">
                <!-- Search bar if needed later -->
            </div>
            <div class="col-md-4 text-end">
                <span class="text-muted small">Total: {{ $products->total() }} Products</span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-premium align-middle">
            <thead>
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Pricing</th>
                    <th>Inventory</th>
                    <th class="text-center pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="ps-4 text-muted fw-bold">#{{ $product->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-img-wrapper me-3">
                                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('uploads/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;">
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $product->name }}</h6>
                                <span class="text-muted extra-small" style="font-size: 0.75rem;">Created: {{ $product->created_at->format('d M, Y') }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge-lux badge-purple text-uppercase">{{ $product->category }}</span>
                    </td>
                    <td>
                        <div class="price-text">Rs. {{ number_format($product->price) }}</div>
                    </td>
                    <td>
                        @if($product->stock > 10)
                            <span class="badge-lux badge-success-lux"><i class="fas fa-check-circle me-1"></i> {{ $product->stock }} In Stock</span>
                        @elseif($product->stock > 0)
                            <span class="badge-lux badge-gold"><i class="fas fa-exclamation-triangle me-1"></i> {{ $product->stock }} Low Stock</span>
                        @else
                            <span class="badge-lux badge-danger-lux"><i class="fas fa-times-circle me-1"></i> Out of Stock</span>
                        @endif
                    </td>
                    <td class="text-center pe-4">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn btn-edit-lux" title="Edit Product">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete-lux" title="Delete Product">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted mb-3"><i class="fas fa-box-open fa-4x opacity-25"></i></div>
                        <h4 class="text-dark fw-bold">No Products Yet</h4>
                        <p class="text-muted">Your luxury collection is empty. Let's add something exquisite.</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary-mystic mt-2">Add First Product</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 d-flex justify-content-center border-top">
        {{ $products->links() }}
    </div>
</div>
@endsection
