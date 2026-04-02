@extends('layouts.admin')

@section('content')
<div class="container-fluid content-inner pb-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Shipping Settings (Shiprocket)</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.shipping.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Shiprocket Email</label>
                                <input type="text" name="shiprocket_email" class="form-control" value="{{ $setting->shiprocket_email ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Shiprocket Password</label>
                                <input type="password" name="shiprocket_password" class="form-control" value="{{ $setting->shiprocket_password ?? '' }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
