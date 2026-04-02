@extends('layouts.admin')

@section('title', 'Footer Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Footer Settings</h4>
                </div>
                <div class="card-body">
                    <form id="footerSettingsForm" action="{{ route('admin.settings.footer.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Contact Information</h5>
                                <div class="mb-3">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email', $setting->email) }}">
                                </div>
                                <div class="mb-3">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" rows="2">{{ old('address', $setting->address) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Footer Phone</label>
                                    <input type="text" class="form-control" name="footer_phone" value="{{ old('footer_phone', $setting->footer_phone) }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Content</h5>
                                <div class="mb-3">
                                    <label>Footer Description</label>
                                    <textarea class="form-control" name="footer_description" rows="4">{{ old('footer_description', $setting->footer_description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Copyright Text</label>
                                    <input type="text" class="form-control" name="copyright_text" value="{{ old('copyright_text', $setting->copyright_text) }}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3 text-primary">Social Media Links</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Facebook Link</label>
                                    <input type="text" class="form-control" name="facebook_link" value="{{ old('facebook_link', $setting->facebook_link) }}">
                                </div>
                                <div class="mb-3">
                                    <label>Twitter Link</label>
                                    <input type="text" class="form-control" name="twitter_link" value="{{ old('twitter_link', $setting->twitter_link) }}">
                                </div>
                                <div class="mb-3">
                                    <label>WhatsApp Link</label>
                                    <input type="text" class="form-control" name="whatsapp_link" value="{{ old('whatsapp_link', $setting->whatsapp_link) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Instagram Link</label>
                                    <input type="text" class="form-control" name="instagram_link" value="{{ old('instagram_link', $setting->instagram_link) }}">
                                </div>
                                <div class="mb-3">
                                    <label>LinkedIn Link</label>
                                    <input type="text" class="form-control" name="linkedin_link" value="{{ old('linkedin_link', $setting->linkedin_link) }}">
                                </div>
                                <div class="mb-3">
                                    <label>YouTube Link</label>
                                    <input type="text" class="form-control" name="youtube_link" value="{{ old('youtube_link', $setting->youtube_link) }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Menu Management -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Footer Menu Management</h4>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#addFooterMenuForm"><i class="fas fa-plus"></i> Add New Menu</button>
                </div>
                <div class="card-body">
                    
                    <div class="collapse mb-4" id="addFooterMenuForm">
                        <div class="card card-body bg-light">
                                <form action="{{ route('admin.menus.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="footer">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="title" class="form-control" placeholder="Menu Title" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="url" class="form-control" placeholder="Menu URL (e.g., /about)" required>
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

            <div class="d-grid gap-2 mt-4 mb-5">
                <button type="submit" form="footerSettingsForm" class="btn btn-primary btn-lg">Update Footer Settings</button>
            </div>
        </div>
    </div>
</div>
@endsection
