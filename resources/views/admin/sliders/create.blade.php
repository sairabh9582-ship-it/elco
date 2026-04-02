@extends('layouts.admin')

@section('title', 'Add Slider')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Slider</h4>
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

                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="header" class="form-label">Header (Small Text)</label>
                            <input type="text" class="form-control" id="header" name="header" value="{{ old('header') }}">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title (Main Text)</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>

                         <div class="mb-3">
                            <label for="image" class="form-label">Slider Image (Required)</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="link" class="form-label">Button Link</label>
                            <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Slider</button>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
