@extends('layouts.admin')

@section('title', 'Edit Coupon')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Coupon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" name="code" class="form-control text-uppercase" value="{{ $coupon->code }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Discount Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                    <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Discount Value</label>
                                <input type="number" name="value" class="form-control" step="0.01" min="0" value="{{ $coupon->value }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Minimum Spend</label>
                                <input type="number" name="min_spend" class="form-control" step="0.01" min="0" value="{{ $coupon->min_spend }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usage Limit</label>
                                <input type="number" name="usage_limit" class="form-control" min="1" value="{{ $coupon->usage_limit }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" value="{{ $coupon->expiry_date ? $coupon->expiry_date->format('Y-m-d') : '' }}">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ $coupon->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
