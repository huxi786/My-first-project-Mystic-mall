@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">All Products</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary-mystic">
            <i class="fas fa-plus me-1"></i> Add Product
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Image</th>
                        <th width="25%">Name</th>
                        <th width="15%">Category</th>
                        <th width="15%">Price</th>
                        <th width="10%">Stock</th>
                        <th width="20%" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="rounded shadow-sm" width="50" height="50" style="object-fit: cover;">
                        </td>
                        <td class="fw-bold">{{ $product->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $product->category }}</span></td>
                        <td class="text-primary fw-bold">Rs. {{ number_format($product->price) }}</td>
                        <td>
                            @if($product->stock > 0)
                                <span class="badge bg-success">In Stock ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted mb-3"><i class="fas fa-box-open fa-3x"></i></div>
                            <h5>No products found</h5>
                            <p class="text-muted">Start by adding a new product to your store.</p>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary-mystic mt-2">Add First Product</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
