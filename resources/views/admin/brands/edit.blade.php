@extends('layouts.admin')

@section('content')
<div class="container-fluid content-inner pb-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Brand: {{ $brand->name }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
                        @csrf
                        @method('PUT')
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="name">Brand Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
                            </div>
                            </div>
                        </div>

                        <hr>
                        <h5>SEO Settings</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $brand->meta_title }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ $brand->meta_description }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $brand->meta_keywords }}" placeholder="Comma separated keywords">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
