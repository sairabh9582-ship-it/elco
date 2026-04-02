@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Service</h1>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon (FontAwesome Class) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="icon" value="{{ old('icon', 'fas fa-star') }}" required>
                    <small class="text-muted">Example: <code>fas fa-shipping-fast</code>, <code>fas fa-check-circle</code></small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', '1') ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Save Service</button>
            </form>
        </div>
    </div>
</div>
@endsection
