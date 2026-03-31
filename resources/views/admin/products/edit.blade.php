@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<style>
    .lux-form-card {
        background: #fff;
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .form-header-lux {
        background: linear-gradient(to right, #2e0249, #4a0e69);
        color: #fff;
        padding: 30px;
    }

    .form-header-lux h4 {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        margin: 0;
        letter-spacing: 1px;
    }

    .lux-input-group {
        margin-bottom: 25px;
    }

    .lux-label {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        color: #1a0033;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .lux-label::before {
        content: "";
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #D4AF37; /* Gold Dot */
        border-radius: 50%;
        box-shadow: 0 0 8px rgba(212, 175, 55, 0.6);
    }

    .lux-input, .lux-select, .lux-textarea {
        border-radius: 12px;
        border: 1px solid #eee;
        padding: 12px 18px;
        background: #fdfdfd;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .lux-input:focus, .lux-select:focus, .lux-textarea:focus {
        border-color: #2e0249;
        background: #fff;
        box-shadow: 0 5px 15px rgba(46, 2, 73, 0.05);
        outline: none;
    }

    .image-preview-container {
        width: 100%;
        height: 250px;
        border: 2px dashed #ddd;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f9f9f9;
        position: relative;
        transition: all 0.3s ease;
    }

    .image-preview-container:hover {
        border-color: #2e0249;
    }

    .image-preview-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .lux-sidebar-panel {
        background: rgba(46, 2, 73, 0.02);
        padding: 25px;
        border-radius: 20px;
        border: 1px solid rgba(46, 2, 73, 0.05);
    }

    .btn-update-lux {
        background: #2e0249;
        color: #fff;
        border: none;
        padding: 14px 40px;
        border-radius: 12px;
        font-family: 'Cinzel', serif;
        font-weight: 700;
        transition: all 0.3s ease;
        letter-spacing: 1px;
    }

    .btn-update-lux:hover {
        background: #4a0e69;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(46, 2, 73, 0.2);
    }

    .btn-cancel-lux {
        background: #f8f9fa;
        color: #666;
        padding: 14px 30px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
</style>

<div class="lux-form-card">
    <div class="form-header-lux d-flex justify-content-between align-items-center">
        <div>
            <h4>Refine Masterpiece</h4>
            <p class="small text-white-50 mb-0">Enhancing: {{ $product->name }}</p>
        </div>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
             <i class="fas fa-arrow-left me-1"></i> Back to Collection
        </a>
    </div>

    <div class="p-4 p-md-5">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="lux-input-group">
                        <label class="lux-label">Product Significance (Name)</label>
                        <input type="text" name="name" class="form-control lux-input" value="{{ $product->name }}" required>
                    </div>

                    <div class="lux-input-group">
                        <label class="lux-label">Detailed Narrative (Description)</label>
                        <textarea name="description" class="form-control lux-textarea" rows="6">{{ $product->description }}</textarea>
                    </div>

                    <div class="lux-input-group">
                        <label class="lux-label">Product Visual (Main Image)</label>
                        <div class="image-preview-container mb-3" id="imagePreviewContainer">
                            <img id="imagePreviewImg" 
                                 src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('uploads/' . $product->image) }}" 
                                 alt="Current Image">
                        </div>
                        <input type="file" name="image" id="productImageInput" 
                               class="form-control" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-outline-dark w-100 py-2 mb-2" onclick="document.getElementById('productImageInput').click()" style="border-radius: 12px; border-style: dashed;">
                            <i class="fas fa-sync-alt me-2"></i> Replace Main Image
                        </button>
                    </div>

                    <div class="lux-input-group">
                        <label class="lux-label">Add to Gallery (Optional)</label>
                        <input type="file" name="gallery_images[]" id="galleryImagesInput"
                               class="form-control lux-input @error('gallery_images.*') is-invalid @enderror" 
                               accept="image/*" multiple>
                        <span class="small text-muted mt-1 d-block">Upload additional images to the product's gallery.</span>
                        @error('gallery_images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        @if($product->productImages && $product->productImages->count() > 0)
                            <div class="mt-3">
                                <span class="small fw-bold">Current Gallery Images:</span>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($product->productImages as $galleryImg)
                                        <div style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; border: 1px solid #ddd;">
                                            <img src="{{ asset('uploads/' . $galleryImg->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Panel -->
                <div class="col-lg-4">
                    <div class="lux-sidebar-panel">
                        <div class="lux-input-group">
                            <label class="lux-label">Asset Category</label>
                            <select name="category" class="form-select lux-select" required>
                                <option value="Mens Collection" {{ $product->category == 'Mens Collection' ? 'selected' : '' }}>Men's Collection</option>
                                <option value="Womens Collection" {{ $product->category == 'Womens Collection' ? 'selected' : '' }}>Women's Collection</option>
                                <option value="formal" {{ $product->category == 'formal' ? 'selected' : '' }}>Formal Wears</option>
                                <option value="casual" {{ $product->category == 'casual' ? 'selected' : '' }}>Casual Wears</option>
                                <option value="kids" {{ $product->category == 'kids' ? 'selected' : '' }}>Kid's Collection</option>
                                <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            </select>
                        </div>

                        <div class="lux-input-group">
                            <label class="lux-label">Premium Pricing (Rs.)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">Rs.</span>
                                <input type="number" name="price" style="border-radius: 0 12px 12px 0;"
                                       class="form-control lux-input border-start-0" value="{{ $product->price }}" required>
                            </div>
                        </div>

                        <div class="lux-input-group">
                            <label class="lux-label">Initial Inventory (Stock)</label>
                            <input type="number" name="stock" class="form-control lux-input" value="{{ $product->stock }}">
                        </div>

                        <div class="mt-4 pt-3 border-top d-grid gap-2">
                             <button type="submit" class="btn btn-update-lux">
                                 <i class="fas fa-save me-2"></i> Update Masterpiece
                             </button>
                             <a href="{{ route('admin.products') }}" class="btn btn-cancel-lux text-center">
                                 Discard Adjustments
                             </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('productImageInput').onchange = function (evt) {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('imagePreviewImg').src = URL.createObjectURL(file);
        }
    }
</script>
@endsection
