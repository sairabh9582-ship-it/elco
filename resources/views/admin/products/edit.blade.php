@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Product: <span class="text-primary">{{ $product->name }}</span></h4>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="brand_id" class="form-label">Brand</label>
                                            <select class="form-select" id="brand_id" name="brand_id">
                                                <option value="">No Brand</option>
                                                @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="old_price" class="form-label">Old Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" step="0.01" class="form-control" id="old_price" name="old_price" value="{{ old('old_price', $product->old_price) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="label" class="form-label">Product Label</label>
                                    <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $product->label) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border shadow-sm h-100">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Product Image</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="image-preview-container" class="mb-3 text-center border p-2 rounded">
                                            <img id="image-preview" src="{{ $product->image ? asset($product->image) : '#' }}" class="img-fluid rounded border shadow-sm" style="max-height: 250px;">
                                        </div>

                                        <input type="hidden" id="media_image" name="media_image" value="">

                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-secondary btn-sm" id="btn-pick-media">
                                                <i class="fas fa-images me-2"></i>Change from Media
                                            </button>
                                            <div class="text-center my-1">
                                                <small class="text-muted">-- OR UPLOAD NEW --</small>
                                            </div>
                                            <input type="file" class="form-control form-control-sm" id="image" name="image" accept="image/*">
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-white pt-4">
                                        <h6>SEO Settings</h6>
                                        <div class="mb-3">
                                            <label class="form-label small" for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control form-control-sm" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small" for="meta_description">Meta Description</label>
                                            <textarea class="form-control form-control-sm" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Media Picker Modal -->
<div class="modal fade" id="mediaPickerModal" tabindex="-1" aria-labelledby="mediaPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="mediaPickerModalLabel"><i class="fas fa-photo-video me-2"></i>Select Image</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div id="media-picker-gallery" class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                    <!-- Loaded via JS -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
        const gallery = document.getElementById('media-picker-gallery');
        const btnPickMedia = document.getElementById('btn-pick-media');
        const mediaInput = document.getElementById('media_image');
        const imagePreview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('image-preview-container');
        let mediaData = [];

        btnPickMedia.addEventListener('click', function() {
            modal.show();
            if (mediaData.length === 0) {
                fetchMedia();
            }
        });

        function fetchMedia() {
            gallery.innerHTML = '<div class="col-12 text-center py-5"><div class="spinner-border text-primary"></div></div>';
            fetch("{{ route('admin.media.json') }}")
                .then(response => response.json())
                .then(data => {
                    mediaData = data;
                    renderMedia(data);
                });
        }

        function renderMedia(items) {
            gallery.innerHTML = items.map(item => `
                <div class="col">
                    <div class="card h-100 media-select-card border p-1" style="cursor:pointer" data-path="${item.relative_path}" data-url="${item.url}">
                        <div class="ratio ratio-1x1 bg-white overflow-hidden">
                            <img src="${item.url}" class="card-img-top object-fit-contain" alt="${item.name}">
                        </div>
                        <div class="card-body p-1 text-center">
                            <small class="text-truncate d-block" style="font-size:0.7rem">${item.name}</small>
                        </div>
                    </div>
                </div>
            `).join('');

            document.querySelectorAll('.media-select-card').forEach(card => {
                card.addEventListener('click', function() {
                    mediaInput.value = this.dataset.path;
                    imagePreview.src = this.dataset.url;
                    modal.hide();
                    document.getElementById('image').value = '';
                });
            });
        }
    });
</script>
<style>
    .media-select-card:hover { border-color: #0d6efd !important; background-color: #f8f9fa; }
    .object-fit-contain { object-fit: contain; }
</style>
@endsection
