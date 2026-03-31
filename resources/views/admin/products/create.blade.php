@extends('layouts.admin')

@section('title', 'Add New Product')

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
        display: none;
    }

    .upload-placeholder {
        text-align: center;
        color: #aaa;
    }

    .upload-placeholder i {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .lux-sidebar-panel {
        background: rgba(46, 2, 73, 0.02);
        padding: 25px;
        border-radius: 20px;
        border: 1px solid rgba(46, 2, 73, 0.05);
    }

    .btn-save-lux {
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

    .btn-save-lux:hover {
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
            <h4>Craft New Product</h4>
            <p class="small text-white-50 mb-0">Define the details of your next luxury item</p>
        </div>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
             <i class="fas fa-arrow-left me-1"></i> Back to Collection
        </a>
    </div>

    <div class="p-4 p-md-5">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="lux-input-group">
                        <label class="lux-label">Product Significance (Name)</label>
                        <input type="text" name="name" class="form-control lux-input @error('name') is-invalid @enderror" 
                               placeholder="e.g. Signature Gold Chronograph" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="lux-input-group">
                        <label class="lux-label">Detailed Narrative (Description)</label>
                        <textarea name="description" class="form-control lux-textarea @error('description') is-invalid @enderror" 
                                  rows="6" placeholder="Bespoke details of the product...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                        <div class="lux-input-group">
                            <label class="lux-label">Product Visual (Main Image)</label>
                            <div class="image-preview-container mb-3" id="imagePreviewContainer">
                                <div class="upload-placeholder" id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="mb-0">Click to upload main image</p>
                                    <span class="small text-muted">WebP, SVG, PNG or JPG (Max. 5MB)</span>
                                </div>
                                <img id="imagePreviewImg" src="#" alt="Preview">
                            </div>
                            <input type="file" name="image" id="productImageInput" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   accept="image/*" required style="display: none;">
                            <button type="button" class="btn btn-outline-dark w-100 py-2 mb-2" onclick="document.getElementById('productImageInput').click()" style="border-radius: 12px; border-style: dashed;">
                                <i class="fas fa-image me-2"></i> Select Main Image
                            </button>
                            @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="lux-input-group">
                            <label class="lux-label">Gallery Images (Optional)</label>
                            <input type="file" name="gallery_images[]" id="galleryImagesInput"
                                   class="form-control lux-input @error('gallery_images.*') is-invalid @enderror" 
                                   accept="image/*" multiple>
                            <span class="small text-muted mt-1 d-block">You can select multiple images for the product gallery.</span>
                            @error('gallery_images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                <!-- Sidebar Panel -->
                <div class="col-lg-4">
                    <div class="lux-sidebar-panel">
                        <div class="lux-input-group">
                            <label class="lux-label">Asset Category</label>
                            <select name="category" class="form-select lux-select @error('category') is-invalid @enderror" required>
                                <option value="">Select Domain</option>
                                <option value="Mens Collection" {{ old('category') == 'Mens Collection' ? 'selected' : '' }}>Men's Collection</option>
                                <option value="Womens Collection" {{ old('category') == 'Womens Collection' ? 'selected' : '' }}>Women's Collection</option>
                                <option value="formal" {{ old('category') == 'formal' ? 'selected' : '' }}>Formal Wears</option>
                                <option value="casual" {{ old('category') == 'casual' ? 'selected' : '' }}>Casual Wears</option>
                                <option value="kids" {{ old('category') == 'kids' ? 'selected' : '' }}>Kid's Collection</option>
                                <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            </select>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="lux-input-group">
                            <label class="lux-label">Premium Pricing (Rs.)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">Rs.</span>
                                <input type="number" name="price" style="border-radius: 0 12px 12px 0;"
                                       class="form-control lux-input border-start-0 @error('price') is-invalid @enderror" 
                                       placeholder="5000" value="{{ old('price') }}" required>
                            </div>
                            @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="lux-input-group">
                            <label class="lux-label">Initial Inventory (Stock)</label>
                            <input type="number" name="stock" class="form-control lux-input @error('stock') is-invalid @enderror" 
                                   placeholder="100" value="{{ old('stock', 10) }}">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-4 pt-3 border-top d-grid gap-2">
                             <button type="submit" class="btn btn-save-lux">
                                 <i class="fas fa-gem me-2"></i> Finalize & Save
                             </button>
                             <a href="{{ route('admin.products') }}" class="btn btn-cancel-lux text-center">
                                 Discard Changes
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
            document.getElementById('imagePreviewImg').style.display = 'block';
            document.getElementById('uploadPlaceholder').style.display = 'none';
        }
    }
</script>
@endsection
