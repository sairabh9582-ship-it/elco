@extends('layouts.admin')

@section('title', 'Appearance Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Appearance Settings</h4>
                </div>
                <div class="card-body">
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

                    <form action="{{ route('admin.settings.appearance.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Primary Color</label>
                            <input type="color" class="form-control form-control-color" name="primary_color" value="{{ old('primary_color', $setting->primary_color ?? '#D10024') }}" title="Choose your color">
                            <small class="text-muted">Main theme color (Buttons, Highlights).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Secondary Color</label>
                            <input type="color" class="form-control form-control-color" name="secondary_color" value="{{ old('secondary_color', $setting->secondary_color ?? '#333333') }}" title="Choose your color">
                            <small class="text-muted">Secondary theme color (Footer, Headers).</small>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Home Page SEO</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="home_meta_title" value="{{ old('home_meta_title', $setting->home_meta_title) }}" placeholder="e.g. Electro - Best Electronics Store">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" name="home_meta_description" rows="3" placeholder="e.g. Shop the latest electronics...">{{ old('home_meta_description', $setting->home_meta_description) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" name="home_meta_keywords" value="{{ old('home_meta_keywords', $setting->home_meta_keywords) }}" placeholder="e.g. electronics, phones, laptops">
                            <small class="text-muted">Comma separated keywords.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Image (Social Share)</label>
                            <input type="file" class="form-control" name="home_meta_image">
                            <small class="text-muted">Image shown when sharing on Facebook/Twitter. Recommended size: 1200x630px.</small>
                            @if($setting->home_meta_image)
                                <div class="mt-2">
                                    <img src="{{ asset($setting->home_meta_image) }}" alt="Current Meta Image" style="max-height: 150px; border: 1px solid #ccc;">
                                </div>
                            @endif
                        </div>
                        
                        <!-- Add more appearance options here later like font selection, layout width etc. -->
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Preview</h5>
                </div>
                <div class="card-body">
                    <div class="p-3 border rounded text-center">
                        <button class="btn text-white" style="background-color: {{ $setting->primary_color ?? '#D10024' }}">Primary Button</button>
                        <button class="btn text-white" style="background-color: {{ $setting->secondary_color ?? '#333333' }}">Secondary Button</button>
                        <h3 style="color: {{ $setting->primary_color ?? '#D10024' }}; margin-top: 10px;">Primary Heading</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
