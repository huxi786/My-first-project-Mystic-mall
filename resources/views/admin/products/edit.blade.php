@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">Edit Product: {{ $product->name }}</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price (Rs.)</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="Mens Collection" {{ $product->category == 'Mens Collection' ? 'selected' : '' }}>Men's Collection</option>
                            <option value="Womens Collection" {{ $product->category == 'Womens Collection' ? 'selected' : '' }}>Women's Collection</option>
                            <option value="formal" {{ $product->category == 'formal' ? 'selected' : '' }}>Formal Wears</option>
                            <option value="casual" {{ $product->category == 'casual' ? 'selected' : '' }}>Casual Wears</option>
                            <option value="kids" {{ $product->category == 'kids' ? 'selected' : '' }}>Kid's Collection</option>
                            <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Current Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('uploads/' . $product->image) }}" alt="Current Image" class="rounded border" width="100">
                        </div>
                        <label class="form-label fw-bold text-muted small">Change Image (Optional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.products') }}" class="btn btn-light border">Cancel</a>
                        <button type="submit" class="btn btn-primary-mystic px-4">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
