@extends('layouts.admin')

@section('title', 'Create Coupon')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create New Coupon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" name="code" class="form-control text-uppercase" placeholder="e.g. SUMMER2024" required>
                            <div class="form-text">Unique code for customers to enter.</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Discount Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="fixed">Fixed Amount ($)</option>
                                    <option value="percent">Percentage (%)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Discount Value</label>
                                <input type="number" name="value" class="form-control" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Minimum Spend</label>
                                <input type="number" name="min_spend" class="form-control" step="0.01" min="0" placeholder="0.00">
                                <div class="form-text">Optional: Minimum cart subtotal required.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usage Limit</label>
                                <input type="number" name="usage_limit" class="form-control" min="1" placeholder="Unlimited">
                                <div class="form-text">Optional: Total number of times this coupon can be used.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
