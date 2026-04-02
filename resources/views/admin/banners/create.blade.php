@extends('layouts.admin')

@section('title', 'Add Banner')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Banner</h4>
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

                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="mb-3">
                            <label for="offer_text" class="form-label">Offer Text (e.g., 50% Off)</label>
                            <input type="text" class="form-control" id="offer_text" name="offer_text" value="{{ old('offer_text') }}">
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select class="form-control" id="position" name="position" required>
                                <option value="">Select Position</option>
                                <option value="product-offer-left">Product Offer Left</option>
                                <option value="product-offer-right">Product Offer Right</option>
                                <option value="bottom-left">Bottom Banner Left</option>
                                <option value="bottom-right">Bottom Banner Right</option>
                            </select>
                        </div>

                         <div class="mb-3">
                            <label for="image" class="form-label">Banner Image (Required)</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="link" class="form-label">Link URL</label>
                            <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Banner</button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
