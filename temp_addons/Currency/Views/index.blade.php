@extends('layouts.admin')

@section('title', 'Currencies')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Currency Manager</h3>
                <a href="{{ route('admin.currency.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Currency</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <p>Manage multiple currencies and set the default currency for your store.</p>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Symbol</th>
                                <th>Exchange Rate</th>
                                <th>Status</th>
                                <th>Default</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currencies as $currency)
                            <tr>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->symbol }}</td>
                                <td>{{ $currency->exchange_rate }}</td>
                                <td>
                                    @if($currency->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($currency->is_default)
                                        <span class="badge bg-primary">Default</span>
                                    @else
                                        <form action="{{ route('admin.currency.default', $currency->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Set Default</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.currency.edit', $currency->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                    @if(!$currency->is_default)
                                    <form action="{{ route('admin.currency.destroy', $currency->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this currency?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No currencies found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
