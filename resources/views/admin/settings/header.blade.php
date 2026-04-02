@extends('layouts.admin')

@section('title', 'Header Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Header Settings</h4>
                </div>
                <div class="card-body">
                    <form id="headerSettingForm" action="{{ route('admin.settings.header.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label>Site Name</label>
                            <input type="text" class="form-control" name="site_name" value="{{ old('site_name', $setting->site_name) }}">
                            <small class="text-muted">The name of your website.</small>
                        </div>

                        <div class="mb-3">
                            <label>Currency Symbol</label>
                            <input type="text" class="form-control" name="currency" value="{{ old('currency', $setting->currency) }}" placeholder="e.g. ₹, $, £">
                            <small class="text-muted">The symbol used for prices across the site.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label>Website Logo</label>
                            <div class="d-flex align-items-center mb-2">
                                <div id="logo_preview_container" class="me-3" style="width: 100px; height: 100px; background: #f8f9fa; border: 1px dashed #ddd; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    @if($setting->logo)
                                        <img src="{{ asset($setting->logo) }}" id="logo_preview_img" alt="Current Logo" style="max-width: 100%; max-height: 100%;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary select-media-btn" data-target="logo_path" data-preview-img="logo_preview_img">
                                        <i class="fas fa-images"></i> Choose Image
                                    </button>
                                    <small class="d-block text-muted mt-1">Select from library or upload new.</small>
                                </div>
                            </div>
                            <!-- Hidden input for path (selected from library) -->
                            <input type="hidden" name="logo_path" id="logo_path" value="{{ $setting->logo }}">
                            <!-- Keep file input hidden/optional or remove it if fully relying on media manager? 
                                 Actually, let's keep it as fallback OR handle everything via modal.
                                 Let's allow standard upload too if user prefers, but hide it to reduce confusion? 
                                 No, user wants "Choose File" -> "Option to upload from system" (Library).
                                 So let's hide the standard file input completely.
                            -->
                        </div>

                        <div class="mb-3">
                            <label>Website Favicon</label>
                            <div class="d-flex align-items-center mb-2">
                                <div id="favicon_preview_container" class="me-3" style="width: 60px; height: 60px; background: #f8f9fa; border: 1px dashed #ddd; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    @if($setting->favicon)
                                        <img src="{{ asset($setting->favicon) }}" id="favicon_preview_img" alt="Current Favicon" style="max-width: 100%; max-height: 100%;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary select-media-btn" data-target="favicon_path" data-preview-img="favicon_preview_img">
                                        <i class="fas fa-images"></i> Choose Image
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="favicon_path" id="favicon_path" value="{{ $setting->favicon }}">
                        </div>

                        <div class="mb-3">
                            <label>Phone Number (Topbar)</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $setting->phone) }}">
                            <small class="text-muted">This number appears in the top bar.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button> 
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Media Selector Modal -->
        <div class="modal fade" id="mediaSelectorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Media Manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <ul class="nav nav-tabs nav-fill" id="mediaTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="select-tab" data-bs-toggle="tab" data-bs-target="#select-media" type="button" role="tab">Select File</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload-media" type="button" role="tab">Upload New</button>
                            </li>
                        </ul>
                        <div class="tab-content p-3" id="mediaTabContent">
                            <!-- Select Media Tab -->
                            <div class="tab-pane fade show active" id="select-media" role="tabpanel">
                                <div id="media-loading" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="mt-2">Loading Library...</div>
                                </div>
                                <div id="media-grid" class="row g-3" style="max-height: 400px; overflow-y: auto;">
                                    <!-- Images loaded via JS -->
                                </div>
                            </div>
                            
                            <!-- Upload Media Tab -->
                            <div class="tab-pane fade" id="upload-media" role="tabpanel">
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                    </div>
                                    <h5>Drag and drop files here</h5>
                                    <p class="text-muted">or</p>
                                    <label class="btn btn-outline-primary">
                                        Browse Files <input type="file" id="modal-upload-input" hidden accept="image/*">
                                    </label>
                                    <div id="upload-progress" class="mt-3 d-none">
                                        <div class="progress" style="height: 5px; width: 50%; margin: 0 auto;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small class="text-muted">Uploading...</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mediaModal = new bootstrap.Modal(document.getElementById('mediaSelectorModal'));
                let currentTargetInput = null;
                let currentPreviewImgId = null;

                // Open Modal
                document.querySelectorAll('.select-media-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        currentTargetInput = document.getElementById(this.dataset.target);
                        currentPreviewImgId = this.dataset.previewImg;
                        loadMedia();
                        mediaModal.show();
                    });
                });

                // Load Images
                function loadMedia() {
                    const grid = document.getElementById('media-grid');
                    const loading = document.getElementById('media-loading');
                    
                    loading.style.display = 'block';
                    grid.innerHTML = '';
                    grid.style.display = 'none';

                    fetch('{{ route("admin.media.json") }}')
                        .then(response => response.json())
                        .then(images => {
                            loading.style.display = 'none';
                            grid.style.display = 'flex';
                            
                            if (images.length === 0) {
                                grid.innerHTML = '<div class="col-12 text-center text-muted py-5">No images found in library. Upload one!</div>';
                                return;
                            }

                            images.forEach(img => {
                                const col = document.createElement('div');
                                col.className = 'col-md-3 col-6';
                                col.innerHTML = `
                                    <div class="card h-100 media-item shadow-sm" style="cursor: pointer; transition: transform 0.2s;">
                                        <div style="height: 120px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #eee;">
                                            <img src="${img.url}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-footer p-2 bg-white text-truncate small" title="${img.name}">${img.name}</div>
                                    </div>
                                `;
                                
                                // Hover effect logic
                                const card = col.querySelector('.media-item');
                                card.onmouseover = () => card.style.transform = 'scale(1.05)';
                                card.onmouseout = () => card.style.transform = 'scale(1)';
                                
                                card.addEventListener('click', function() {
                                    selectImage(img.relative_path, img.url);
                                });
                                grid.appendChild(col);
                            });
                        })
                        .catch(err => {
                            console.error(err);
                            loading.innerHTML = '<div class="text-center text-danger">Error loading images.</div>';
                        });
                }

                // Handle Image Selection
                function selectImage(path, url) {
                    if (currentTargetInput) {
                        currentTargetInput.value = path;
                    }
                    if (currentPreviewImgId) {
                        let img = document.getElementById(currentPreviewImgId);
                        if (!img) {
                             // Create img if it was placeholder text
                             const container = document.getElementById(currentPreviewImgId.replace('_img', '_container'));
                             if(container) {
                                 container.innerHTML = `<img src="${url}" id="${currentPreviewImgId}" style="max-width: 100%; max-height: 100%;">`;
                             }
                        } else {
                            img.src = url;
                        }
                    }
                    mediaModal.hide();
                }

                // Handle Upload
                const uploadInput = document.getElementById('modal-upload-input');
                uploadInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    const progressDiv = document.getElementById('upload-progress');
                    const progressBar = progressDiv.querySelector('.progress-bar');
                    
                    progressDiv.classList.remove('d-none');
                    progressBar.style.width = '50%'; // Mock progress since fetch doesn't support generic progress events easily without xhr

                    fetch('{{ route("admin.media.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' 
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        progressBar.style.width = '100%';
                        setTimeout(() => {
                            progressDiv.classList.add('d-none');
                            progressBar.style.width = '0%';
                            uploadInput.value = ''; // Reset input
                            
                            if (data.success) {
                                // Switch to select tab and reload
                                const selectTabBtn = document.getElementById('select-tab');
                                const tab = new bootstrap.Tab(selectTabBtn);
                                tab.show();
                                loadMedia(); // Reload to see new image
                                
                                // Optional: Auto-select?
                                // selectImage(data.relative_path, data.url); 
                            } else {
                                alert(data.message || 'Upload failed');
                            }
                        }, 500);
                    })
                    .catch(async err => {
                        console.error(err);
                        alert('Upload failed. Check console for details.');
                        progressDiv.classList.add('d-none');
                    });
                });
            });
        </script>
        
        <div class="col-md-12 mt-4">
             <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Menu Management</h4>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#addMenuForm"><i class="fas fa-plus"></i> Add New Menu</button>
                </div>
                <div class="card-body">
                    
                    <div class="collapse mb-4" id="addMenuForm">
                        <div class="card card-body bg-light">
                            <form action="{{ route('admin.menus.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="title" class="form-control" placeholder="Menu Title" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="url" class="form-control" placeholder="Menu URL (e.g., /shop)" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="order" class="form-control" placeholder="Order" value="0">
                                    </div>
                                    <div class="col-md-2">
                                         <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-success w-100">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->order }}</td>
                                    <td>{{ $menu->title }}</td>
                                    <td>{{ $menu->url }}</td>
                                    <td>
                                        @if($menu->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-info me-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3 mb-4">
            <button type="submit" form="headerSettingForm" class="btn btn-primary btn-lg w-100">Update Header Settings</button>
        </div>
@endsection
