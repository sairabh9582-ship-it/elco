@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Banner</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $banner->title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="offer_text" class="form-label">Offer Text (e.g., 50% Off)</label>
                            <input type="text" class="form-control" id="offer_text" name="offer_text" value="{{ old('offer_text', $banner->offer_text) }}">
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                             <select class="form-control" id="position" name="position" required>
                                <option value="">Select Position</option>
                                <option value="product-offer-left" {{ $banner->position == 'product-offer-left' ? 'selected' : '' }}>Product Offer Left</option>
                                <option value="product-offer-right" {{ $banner->position == 'product-offer-right' ? 'selected' : '' }}>Product Offer Right</option>
                                <option value="bottom-left" {{ $banner->position == 'bottom-left' ? 'selected' : '' }}>Bottom Banner Left</option>
                                <option value="bottom-right" {{ $banner->position == 'bottom-right' ? 'selected' : '' }}>Bottom Banner Right</option>
                            </select>
                        </div>

                         <div class="mb-3">
                            <label for="image" class="form-label">Banner Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($banner->image)
                                <div class="mt-2">
                                    <img src="{{ asset($banner->image) }}" alt="Current Image" width="100">
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label for="link" class="form-label">Link URL</label>
                            <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $banner->link) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Banner</button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
