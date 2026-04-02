@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Edit Menu Item</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $menu->title }}" required>
                </div>

                <div class="mb-3">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url" value="{{ $menu->url }}" required>
                </div>

                <div class="mb-3">
                    <label>Order</label>
                    <input type="number" class="form-control" name="order" value="{{ $menu->order }}">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select class="form-select" name="status">
                        <option value="1" {{ $menu->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$menu->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Menu Item</button>
            </form>
        </div>
    </div>
</div>
@endsection
