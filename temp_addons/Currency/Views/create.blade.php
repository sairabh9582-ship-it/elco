@extends('layouts.admin')

@section('title', 'Create Currency')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Add New Currency</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.currency.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Currency Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. US Dollar" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Code (ISO)</label>
                                <input type="text" name="code" class="form-control text-uppercase" placeholder="e.g. USD" maxlength="3" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Symbol</label>
                                <input type="text" name="symbol" class="form-control" placeholder="e.g. $" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Exchange Rate (1 Default Currency = ?)</label>
                            <input type="number" name="exchange_rate" class="form-control" step="0.0001" value="1.0000" min="0">
                            <div class="form-text">Set relative to your main currency.</div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.currency.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Currency</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
