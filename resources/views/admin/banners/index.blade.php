@extends('layouts.admin')

@section('title', 'Banners')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Banners</h2>
                <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Add New Banner</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Offer Text</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>
                                    @if($banner->image)
                                    <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" width="80">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->offer_text }}</td>
                                <td>{{ $banner->position }}</td>
                                <td>
                                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
