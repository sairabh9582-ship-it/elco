@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Sliders</h2>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Add New Slider</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Header</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>
                                    @if($slider->image)
                                    <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" width="100">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->header }}</td>
                                <td>{{ Str::limit($slider->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline">
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
