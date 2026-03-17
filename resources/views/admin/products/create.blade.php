@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">Product Details</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Luxury Gold Watch" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price (Rs.)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="e.g. 5000" value="{{ old('price') }}" required>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="e.g. 100" value="{{ old('stock', 10) }}">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            <option value="Mens Collection" {{ old('category') == 'Mens Collection' ? 'selected' : '' }}>Men's Collection</option>
                            <option value="Womens Collection" {{ old('category') == 'Womens Collection' ? 'selected' : '' }}>Women's Collection</option>
                            <option value="formal" {{ old('category') == 'formal' ? 'selected' : '' }}>Formal Wears</option>
                            <option value="casual" {{ old('category') == 'casual' ? 'selected' : '' }}>Casual Wears</option>
                            <option value="kids" {{ old('category') == 'kids' ? 'selected' : '' }}>Kid's Collection</option>
                            <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter product details...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Product Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                        <div class="form-text">Supported: JPG, PNG, GIF, WEBP, SVG. Max: 5MB.</div>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.products') }}" class="btn btn-light border">Cancel</a>
                        <button type="submit" class="btn btn-primary-mystic px-4">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
