@extends('layouts.admin')

@section('title', 'Coupons')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Coupons</h3>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Coupon</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <p>Manage discount coupons for your store.</p>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Usage</th>
                                <th>Expiry</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $coupon)
                            <tr>
                                <td><span class="badge bg-secondary text-uppercase">{{ $coupon->code }}</span></td>
                                <td>{{ ucfirst($coupon->type) }}</td>
                                <td>{{ $coupon->type == 'fixed' ? '$'.$coupon->value : $coupon->value.'%' }}</td>
                                <td>{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</td>
                                <td>
                                    @if($coupon->expiry_date)
                                        {{ $coupon->expiry_date->format('Y-m-d') }}
                                        @if($coupon->expiry_date->isPast())
                                            <span class="badge bg-danger">Expired</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No Expiry</span>
                                    @endif
                                </td>
                                <td>
                                    @if($coupon->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this coupon?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No coupons created yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
