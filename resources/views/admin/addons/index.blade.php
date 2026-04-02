@extends('layouts.admin')

@section('title', 'Addons')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                 <h3>Addons Manager</h3>
                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadAddonModal"><i class="fas fa-upload"></i> Upload Addon</button>
            </div>
            
            @if($addons->count() > 0)
                <div class="row">
                    @foreach($addons as $addon)
                    <div class="col-md-4">
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $addon->name }}</h5>
                                    <span class="badge bg-{{ $addon->status ? 'success' : 'secondary' }}">{{ $addon->status ? 'Active' : 'Inactive' }}</span>
                                </div>
                                <h6 class="card-subtitle mb-2 text-muted">v{{ $addon->version }}</h6>
                                <p class="card-text">{{ $addon->description }}</p>
                                <div class="d-flex justify-content-end">
                                     <form action="{{ route('admin.addons.destroy', $addon->id) }}" method="POST" onsubmit="return confirm('Delete this addon? This will remove all associated files and data.');">
                                         @csrf
                                         @method('DELETE')
                                         <!-- Delete logic not technically supported by Rest Controller resource default without 'admin.' prefix if route defined that way
                                              Wait, I defined Route::get('addons') manually, not resource.
                                              I need to add DELETE route.
                                          -->
                                         <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Uninstall</button>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-puzzle-piece fa-4x text-muted mb-3"></i>
                        <h4>No Addons Installed</h4>
                        <p class="text-muted">You can manage your extra features and addons here.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadAddonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.addons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Addon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Addon Zip File</label>
                        <input type="file" name="addon_file" class="form-control" accept=".zip" required>
                        <small class="text-muted">Upload the .zip package provided by the developer.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Purchase Code</label>
                        <input type="text" name="purchase_code" class="form-control" placeholder="Enter your purchase code" required>
                        <small class="text-muted">Purchase code is required to verify the authenticity of the addon.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Install Addon</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
