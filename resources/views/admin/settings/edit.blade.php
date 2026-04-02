@extends('layouts.admin')

@section('title', 'Header & Footer Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Header & Footer Management</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Contact Information (Header/Footer)</h5>
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $setting->phone) }}">
                                </div>
                                <div class="mb-3">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email', $setting->email) }}">
                                </div>
                                <div class="mb-3">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" rows="2">{{ old('address', $setting->address) }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Footer Content</h5>
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
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
