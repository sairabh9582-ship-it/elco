@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Add New Product</h4>
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

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter product name">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="brand_id" class="form-label">Brand</label>
                                            <select class="form-select" id="brand_id" name="brand_id">
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="old_price" class="form-label">Old Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" step="0.01" class="form-control" id="old_price" name="old_price" value="{{ old('old_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter detailed product description">{{ old('description') }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="label" class="form-label">Product Label (e.g., New, Hot, Sale)</label>
                                    <input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}" placeholder="Featured">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Product Image</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="image-preview-container" class="mb-3 text-center border p-2 rounded @if(!old('media_image')) d-none @endif">
                                            <img id="image-preview" src="{{ old('media_image') ? asset(old('media_image')) : '#' }}" class="img-fluid rounded border shadow-sm" style="max-height: 200px;">
                                        </div>
                                        
                                        <input type="hidden" id="media_image" name="media_image" value="{{ old('media_image') }}">
                                        
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-secondary btn-sm" id="btn-pick-media">
                                                <i class="fas fa-images me-2"></i>Pick from Media
                                            </button>
                                            <div class="text-center my-1">
                                                <small class="text-muted">-- OR --</small>
                                            </div>
                                            <input type="file" class="form-control form-control-sm" id="image" name="image" accept="image/*">
                                        </div>
                                        <div class="form-text mt-2 small text-danger">Selecting a direct file will override the media picker selection.</div>
                                    </div>
                                </div>

                                <div class="card border shadow-sm mt-4">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">SEO Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control form-control-sm" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="meta_description">Meta Description</label>
                                            <textarea class="form-control form-control-sm" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                            <input type="text" class="form-control form-control-sm" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-light px-4 border">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Save Product</button>
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
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" id="media-search" class="form-control" placeholder="Search by filename...">
                    </div>
                </div>
                <div id="media-picker-gallery" class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        const searchInput = document.getElementById('media-search');
        let mediaData = [];

        btnPickMedia.addEventListener('click', function() {
            modal.show();
            if (mediaData.length === 0) {
                fetchMedia();
            }
        });

        function fetchMedia() {
            fetch("{{ route('admin.media.json') }}")
                .then(response => response.json())
                .then(data => {
                    mediaData = data;
                    renderMedia(data);
                })
                .catch(error => {
                    gallery.innerHTML = '<div class="col-12 text-center text-danger py-5">Failed to load media.</div>';
                });
        }

        function renderMedia(items) {
            if (items.length === 0) {
                gallery.innerHTML = '<div class="col-12 text-center py-5">No images found.</div>';
                return;
            }

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

            // Add click events
            document.querySelectorAll('.media-select-card').forEach(card => {
                card.addEventListener('click', function() {
                    const path = this.dataset.path;
                    const url = this.dataset.url;
                    
                    mediaInput.value = path;
                    imagePreview.src = url;
                    previewContainer.classList.remove('d-none');
                    
                    modal.hide();
                    
                    // Clear file input if used
                    document.getElementById('image').value = '';
                });
            });
        }

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const filtered = mediaData.filter(item => item.name.toLowerCase().includes(query));
            renderMedia(filtered);
        });

        // Clear media if file input is used
        document.getElementById('image').addEventListener('change', function() {
            if (this.value) {
                mediaInput.value = '';
                // previewContainer.classList.add('d-none'); // Optionally hide preview if file input doesn't provide easy preview yet
            }
        });
    });
</script>
<style>
    .media-select-card:hover {
        border-color: #0d6efd !important;
        background-color: #e9ecef;
    }
    .object-fit-contain {
        object-fit: contain;
    }
</style>
@endsection
