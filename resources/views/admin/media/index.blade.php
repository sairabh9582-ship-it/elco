@extends('layouts.admin')

@section('title', 'Media Manager')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-0">Media Manager</h2>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#uploadCollapse">
                <i class="fas fa-upload me-2"></i>Upload Images
            </button>
        </div>
    </div>

    <!-- Upload Section (Collapsed by default) -->
    <div class="collapse mb-4" id="uploadCollapse">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-white">Bulk Upload</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="row align-items-end">
                    @csrf
                    <div class="col-md-8">
                        <label for="images" class="form-label">Select Images (Multiple allowed)</label>
                        <input class="form-control" type="file" id="images" name="images[]" multiple required>
                        <div class="form-text">Supported: JPEG, PNG, JPG, GIF, SVG, WEBP. Max size per image: 10MB</div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success w-100 mt-2">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Start Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="card">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Media Library</h5>
            <small class="text-muted">{{ count($images) }} total items</small>
        </div>
        <div class="card-body">
            @if(count($images) > 0)
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                    @foreach($images as $image)
                        <div class="col">
                            <div class="card h-100 border shadow-sm media-item" data-url="{{ $image['url'] }}" data-path="{{ $image['relative_path'] }}">
                                <div class="ratio ratio-1x1 bg-light text-center border-bottom overflow-hidden position-relative">
                                    <img src="{{ $image['url'] }}" class="card-img-top object-fit-contain p-2" alt="{{ $image['name'] }}" style="object-fit: contain; width: 100%; height: 100%;">
                                    <div class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white p-1" style="font-size: 0.7rem;">
                                        {{ number_format($image['size'] / 1024, 1) }} KB
                                    </div>
                                </div>
                                <div class="card-body p-2 d-flex flex-column justify-content-between">
                                    <p class="text-truncate d-block mb-2 small fw-bold" title="{{ $image['name'] }}">{{ $image['name'] }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="btn-group w-100">
                                            <a href="{{ $image['url'] }}" target="_blank" class="btn btn-sm btn-outline-info" title="View Large"><i class="fas fa-external-link-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-outline-dark copy-path-btn" data-path="{{ $image['relative_path'] }}" title="Copy Path"><i class="fas fa-copy"></i></button>
                                            <form action="{{ route('admin.media.destroy', $image['relative_path']) }}" method="POST" onsubmit="return confirm('Delete this image?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-0 rounded-end" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-light" value="{{ $image['relative_path'] }}" readonly style="font-size: 0.65rem;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-images fa-4x text-light mb-3"></i>
                    <p class="text-muted">Your media library is empty.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Copy Path
        document.querySelectorAll('.copy-path-btn').forEach(button => {
            button.addEventListener('click', function() {
                const path = this.dataset.path;
                navigator.clipboard.writeText(path).then(() => {
                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    this.classList.remove('btn-outline-dark');
                    this.classList.add('btn-success');
                    
                    setTimeout(() => {
                        this.innerHTML = originalHtml;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-dark');
                    }, 1500);
                });
            });
        });
    });
</script>
@endsection
@endsection
