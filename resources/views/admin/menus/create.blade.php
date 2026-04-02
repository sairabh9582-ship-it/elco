@extends('layouts.admin')

@section('title', 'Add Menu Item')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Add Menu Item</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.menus.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url" required placeholder="e.g., /shop or https://google.com">
                </div>

                <div class="mb-3">
                    <label>Order</label>
                    <input type="number" class="form-control" name="order" value="0">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select class="form-select" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Menu Item</button>
            </form>
        </div>
    </div>
</div>
@endsection
